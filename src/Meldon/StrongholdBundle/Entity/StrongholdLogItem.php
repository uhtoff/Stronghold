<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 24/09/2015
 * Time: 22:16
 */

namespace Meldon\StrongholdBundle\Entity;

use Meldon\AuditBundle\Entity\LogItem;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class StrongholdLogItem
 * @package Meldon\StrongholdBundle\Entity
 * @ORM\Entity(repositoryClass="Meldon\StrongholdBundle\Repositories\StrongholdLogItemRepository")
 * @ORM\Table(name="log_item", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class StrongholdLogItem extends LogItem
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $turn;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $gameID;

    /**
     * @return int
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @param int $turn
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;
    }
    /**
     * @return int
     */
    public function getGameID()
    {
        return $this->gameID;
    }

    /**
     * @param int $gameID
     */
    public function setGameID($gameID)
    {
        $this->gameID = $gameID;
    }
}