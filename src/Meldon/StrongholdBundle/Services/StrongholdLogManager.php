<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 24/09/2015
 * Time: 22:13
 */

namespace Meldon\StrongholdBundle\Services;

use Doctrine\ORM\EntityRepository;
use Meldon\AuditBundle\Services\LogManager;
use Meldon\StrongholdBundle\Entity\Stronghold;
use Meldon\StrongholdBundle\Entity\StrongholdLogItem;
use Meldon\StrongholdBundle\Events\LogFileEvent;
use Meldon\StrongholdBundle\Repositories\StrongholdLogItemRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class StrongholdLogManager implements LogManager
{
    /**
     * @var StrongholdLogItem
     */
    protected $logItem;
    /**
     * @var StrongholdLogItemRepository
     */
    protected $repository;
    /**
     * @var Stronghold
     */
    private $game;
    public function __construct(EntityRepository $logItemRepository, EventDispatcherInterface $dispatcher)
    {
        $this->logItem = new StrongholdLogItem();
        $this->repository = $logItemRepository;
        $this->repository->save($this->logItem);
        $dispatcher->dispatch('log.file.creation',new LogFileEvent($this->logItem));
    }
    public function addText($text)
    {
        $this->logItem->setText($text);
    }
    public function getLog()
    {
        return $this->logItem;
    }
    public function setGame(Stronghold $game)
    {
        $this->game = $game;
        $this->logItem->setTurn($game->getTurn());
        $this->logItem->setGameID($game->getID());
    }
    public function getAllLogs()
    {
        return $this->repository->getLogsByID($this->game->getID());
    }
}