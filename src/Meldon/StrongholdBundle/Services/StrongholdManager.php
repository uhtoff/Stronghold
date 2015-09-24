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
use Meldon\StrongholdBundle\Repositories\PhaseRepository;
use Meldon\StrongholdBundle\Repositories\StrongholdRepository;

class StrongholdManager
{
    /**
     * @var Stronghold
     */
    private $game;
    /**
     * @var StrongholdLogManager
     */
    private $log;
    /**
     * @var StrongholdRepository
     */
    private $repository;
    /**
     * @var PhaseRepository
     */
    private $phaseRepository;
//    public function __construct(Stronghold $game, LogManager $log)
//    {
//        $this->setGame($game);
//        $this->setLogger($log);
//    }
    /**
     * Called by service at instantiation, mandatory otherwise service will not work correctly
     * @param StrongholdRepository $repository
     */
    public function setGameRepository(StrongholdRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Called by service at instantiation, mandatory
     * @param PhaseRepository $repository
     */
    public function setPhaseRepository(PhaseRepository $repository)
    {
        $this->phaseRepository = $repository;
    }

    /**
     * Called by service at instantiation
     * Inserts log manager, deals with general log issues, log entry will likely be specific to the game
     * @param StrongholdLogManager $log
     */
    public function setLogger(StrongholdLogManager $log)
    {
        $this->log = $log;
    }

    /**
     * Retrieves game as per id sent, throws Exception to be gracefully handled (eventually)
     * @TODO Graceful handle (and define) Exception
     * @param $id
     * @return $this
     * @throws GameNotFoundException
     */
    public function setGame($id)
    {
        $this->game = $this->repository->find($id);
        if (!$this->game instanceof Stronghold){
            throw new GameNotFoundException;
        }
        $this->log->setGame($this->game);
        return $this;
    }

    /**
     * To return the game object, primarily for passing to template
     * @return Stronghold
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Create a new game, and persist relevant entities to the database
     * @param int $scenario
     */
    public function createGame($scenario = 1)
    {
        $sh = new Stronghold();
        $p1 = $this->phaseRepository->getStartingPhase($scenario);
        $sh->setPhase($p1);
        $this->game = $sh;
        $this->repository->save($sh);
        $this->log->addText('Game created - ID = ' . $sh->getID());
    }
    public function deleteGame()
    {
        $this->repository->remove($this->game);
        $this->log->addText('Delete game');
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