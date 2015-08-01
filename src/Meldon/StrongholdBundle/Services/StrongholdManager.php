<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 25/07/2015
 * Time: 11:40
 */

namespace Meldon\StrongholdBundle\Services;

use Meldon\AuditBundle\Services\LogManager;
use Meldon\StrongholdBundle\Entity\Stronghold;
use Meldon\StrongholdBundle\Repositories\StrongholdRepository;

class StrongholdManager
{
    /**
     * @var Stronghold
     */
    private $game;
    /**
     * @var LogManager
     */
    private $log;
    /**
     * @var StrongholdRepository
     */
    private $repository;
//    public function __construct(Stronghold $game, LogManager $log)
//    {
//        $this->setGame($game);
//        $this->setLogger($log);
//    }
    public function setRepository(StrongholdRepository $repository)
    {
        $this->repository = $repository;
    }
    public function setLogger(LogManager $log)
    {
        $this->log = $log;
    }
    public function setGame($id)
    {
        $this->game = $this->repository->find($id);
        if (!$this->game instanceof Stronghold){
            throw new GameNotFoundException;
        }
        return $this;
    }
    public function getGame()
    {
        return $this->game;
    }
    public function nextPhase()
    {
        $this->game->nextPhase();
        $this->log->addText('Next phase');
    }
    public function addHourglass($number = 1)
    {
        $this->game->setHourglasses($this->game->getHourglasses() + $number);
    }

}