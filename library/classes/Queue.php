<?php

namespace Library\Classes;

use Library\Classes\Tasks\SampleTask;
use Library\Classes\Tasks\SecondSampleTask;

class Queue
{
    private static $queue = [
        SampleTask::class,
        SecondSampleTask::class
    ];

    public static function setup()
    {
        if(file_exists(QUEUE_SERVER_INPUT))
            if(!unlink(QUEUE_SERVER_INPUT))
                die('unable to remove stale file');

        umask(0);

        if(!posix_mkfifo(QUEUE_SERVER_INPUT, 0666))
            die('unable to create named pipe');

        $pipe = fopen(QUEUE_SERVER_INPUT,'r+');

        if(!$pipe) die('unable to open the named pipe');


        if (empty(self::$queue)) die('No jobs');

        foreach (self::$queue as $key => $item)
        {
            self::$queue[$key] = new $item;
        }
        fclose($pipe);

        self::start();
    }

    public static function start()
    {
        $pipe = fopen(QUEUE_SERVER_INPUT,'r+');

        stream_set_blocking($pipe, false);
        while(1){
            trim(fgets($pipe));
            $job = current(self::$queue);
            $jobkey = key(self::$queue);

            if($job){
                echo 'processing job ', $job->getName(), PHP_EOL;
                $job->process();
                next(self::$queue);
            }else{
                echo 'no jobs to do - waiting...', PHP_EOL;
                stream_set_blocking($pipe, true);
            }
        }

    }

    public static function getTasks()
    {
        echo "TASK | STATUS" . PHP_EOL;
        foreach (self::$queue as $key => $item)
        {

            echo "$key | " . STATUSES[$item->getStatus()] . PHP_EOL;
        }
    }
}