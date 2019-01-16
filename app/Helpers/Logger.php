<?php

namespace App\Helpers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as BaseLogger;

class Logger
{
    private $logName;
    private $data;

    /**
     * Logger constructor.
     * @param $logName
     */
    public function __construct($logName, $data)
    {
        $this->logName = $logName;
        $this->data = $data;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function writeLog()
    {
        $orderLog = new BaseLogger($this->logName);
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/fill.log')), BaseLogger::INFO);
        return $orderLog->info($this->logName . ' message - ', $this->data);
    }
}
