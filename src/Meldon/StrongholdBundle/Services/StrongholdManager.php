<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 25/07/2015
 * Time: 11:40
 */

namespace Meldon\StrongholdBundle\Services;

use Meldon\StrongholdBundle\Entity\ActionStack;
use Meldon\StrongholdBundle\Entity\Stronghold;
use Meldon\StrongholdBundle\Repositories\PhaseRepository;
use Meldon\StrongholdBundle\Repositories\SideRepository;
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
    /**
     * @var SideRepository
     */
    private $sideRepository;

    public function __construct(StrongholdRepository $shr,
        PhaseRepository $pr,
        SideRepository $sr,
        StrongholdLogManager $lm)
    {
        $this->repository = $shr;
        $this->phaseRepository = $pr;
        $this->sideRepository = $sr;
        $this->log = $lm;
    }

    public function getLog()
    {
        return $this->log->getAllLogs();
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
        $sh->setCurrentSide($this->sideRepository->getSideByAbbreviation('INV'));
        $stack = new ActionStack();
        $sh->setActionStack($stack);
        $this->game = $sh;
        $this->saveGame();
        $this->log->addText('Game created - ID = ' . $sh->getID());
    }

    /**
     * Flush game to database - includes call to persist
     */
    public function saveGame()
    {
        $this->repository->save($this->game);
    }

    /**
     * Delete game from database
     */
    public function deleteGame()
    {
        $this->repository->remove($this->game);
        $this->log->addText('Delete game');
    }

    /**
     * Move to next phase
     */
    public function nextPhase()
    {
        $nextPhase = $this->game->nextPhase();
        $this->log->addText("Next phase begun - {$nextPhase}");
    }

    /**
     * Add hourglasses to the defender depending on number sent
     * @param int $number
     */
    public function addHourglass($number = 1)
    {
        $this->game->setHourglasses($this->game->getHourglasses() + $number);
        $this->log->addText("You have gained {$number} hourglasses.");
        $this->log->addText("You now have {$this->game->getHourglasses()} hourglasses.");
    }

    /**
     * @param string $abb
     * @return Side
     */
    public function getSide($abb)
    {
        return $this->sideRepository->getSideByAbbreviation($abb);
    }
}