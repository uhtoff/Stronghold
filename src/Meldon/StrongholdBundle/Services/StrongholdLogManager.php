<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 24/09/2015
 * Time: 22:13
 */

namespace Meldon\StrongholdBundle\Services;

use Meldon\AuditBundle\Services\LogManager;
use Meldon\StrongholdBundle\Entity\Stronghold;
use Meldon\StrongholdBundle\Entity\StrongholdLogItem;

class StrongholdLogManager extends LogManager
{
    public function __construct()
    {
        $this->logItem = new StrongholdLogItem();
    }
    public function setGame(Stronghold $game)
    {
        $this->logItem->setTurn($game->getTurn());
        $this->logItem->setGameID($game->getID());
    }
}