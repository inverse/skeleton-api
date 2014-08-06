<?php

namespace Api\Event;

use Monolog\Logger;

class LogEvent
{
    /**
     * Constructor
     *
     * @param \Monolog\Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Debug
     *
     * @param  string $message
     * @return void
     */
    public function debug($message)
    {
        $this->logger->addDebug($message);
    }

    /**
     * Info
     *
     * @param  string $message
     * @return void
     */
    public function info($message)
    {
        $this->logger->addInfo($message);
    }

    /**
     * Notice
     *
     * @param  string $message
     * @return void
     */
    public function notice($message)
    {
        $this->logger->addNotice($message);
    }

    /**
     * Error
     *
     * @param  string $message
     * @return void
     */
    public function error($message)
    {
        $this->logger->addError($message);
    }

    /**
     * Critical
     *
     * @param  string $message
     * @return void
     */
    public function critical($message)
    {
        $this->logger->addCritical($message);
    }

    /**
     * Alert
     *
     * @param  string $message
     * @return void
     */
    public function alert($message)
    {
        $this->logger->addAlert($message);
    }

    /**
     * Emergency
     *
     * @param  string $message
     * @return void
     */
    public function emergency($message)
    {
        $this->logger->addEmergency($message);
    }
}
