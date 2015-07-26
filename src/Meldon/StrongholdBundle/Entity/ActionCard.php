<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 21/07/2015
 * Time: 10:15
 */

namespace Meldon\StrongholdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="action_card", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class ActionCard extends ActionCardMaster {
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var Stronghold
     *
     * @ORM\ManyToOne(targetEntity="Stronghold", inversedBy="actionCards")
     */
    private $game;
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $faceUp;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set faceUp
     *
     * @param boolean $faceUp
     * @return ActionCard
     */
    public function setFaceUp($faceUp)
    {
        $this->faceUp = $faceUp;

        return $this;
    }

    /**
     * Get faceUp
     *
     * @return boolean 
     */
    public function getFaceUp()
    {
        return $this->faceUp;
    }

    /**
     * Set game
     *
     * @param \Meldon\StrongholdBundle\Entity\Stronghold $game
     * @return ActionCard
     */
    public function setGame(\Meldon\StrongholdBundle\Entity\Stronghold $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \Meldon\StrongholdBundle\Entity\Stronghold 
     */
    public function getGame()
    {
        return $this->game;
    }
}
