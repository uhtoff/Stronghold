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
    public function __construct()
    {
    }
    public function setLogger(LogManager $log)
    {
        $this->log = $log;
    }
    public function setGame(Stronghold $game)
    {
        $this->game = $game;
    }
    public function nextPhase()
    {
        $this->game->nextPhase();
        $this->log->addText('Next phase');
    }
}