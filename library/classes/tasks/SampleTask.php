<?php

namespace Library\Classes\Tasks;

class SampleTask extends BaseTask
{
    protected $name = "Sample Task";
    public function process()
    {
        $this->setStatus(STATUS_IN_PROGRESS);
        file_put_contents('index.txt', "I am the sample task");
        $this->setStatus(STATUS_DONE);
    }
}