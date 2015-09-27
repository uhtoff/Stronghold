<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 26/09/2015
 * Time: 11:54
 */

namespace Meldon\StrongholdBundle\Events;


use Meldon\AuditBundle\Entity\LogItem;
use Symfony\Component\EventDispatcher\Event;

class LogFileEvent extends Event
{
    /**
     * @var LogItem
     */
    private $logItem;

    public function __construct(LogItem $log)
    {
        $this->setLog($log);
    }

    /**
     * @param LogItem $log
     */
    public function setLog(LogItem $log)
    {
        $this->logItem = $log;
    }

    /**
     * @return LogItem
     */
    public function getLog()
    {
        return $this->logItem;
    }
}