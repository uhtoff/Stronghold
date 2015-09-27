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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $turn;

    /**
     * @var Stronghold
     * @ORM\ManyToOne(targetEntity="Stronghold")
     */
    private $game;

    /**
     * @var Side
     * @ORM\ManyToOne(targetEntity="Side")
     */
    private $side;

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
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param Stronghold $game
     */
    public function setGame(Stronghold $game)
    {
        $this->game = $game;
        $this->setTurn($game->getTurn());
        $this->setSide($game->getCurrentSide());
    }

    /**
     * @return Side
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * @param Side $side
     */
    public function setSide($side)
    {
        $this->side = $side;
    }
}