<?php

namespace Library\Classes\Tasks;


class SecondSampleTask extends BaseTask
{
    protected $name = "Second Sample Task";

    public function process()
    {
        $this->setStatus(STATUS_IN_PROGRESS);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"http://google.com");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        file_put_contents('google_page.html', $server_output);
        $this->setStatus(STATUS_DONE);
    }
}