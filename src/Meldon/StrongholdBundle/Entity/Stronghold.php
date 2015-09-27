<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 20/07/2015
 * Time: 23:37
 */

namespace Meldon\StrongholdBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Meldon\AuditBundle\Entity\Auditable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Meldon\StrongholdBundle\Repositories\StrongholdRepository")
 * @ORM\Table(name="game", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class Stronghold implements Auditable {
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var Phase
     *
     * @ORM\ManyToOne(targetEntity="Phase")
     */
    private $phase;
    /**
     * @var Side
     * @ORM\ManyToOne(targetEntity="Side")
     */
    private $currentSide;
    /**
     * @var ActionStack
     * @ORM\OneToOne(targetEntity="ActionStack", inversedBy="game")
     */
    private $actionStack;
//    /**
//     * @var Collection
//     *
//     * @ORM\OneToMany(targetEntity="ActionCard", mappedBy="game")
//     */
//    private $actionCards;
    /**
     * @var integer
     *
     * @Assert\Range(
     *  min = 0,
     *  max = 12
     * )
     * @ORM\Column(type="integer")
     */
    private $hourglasses = 0;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $resources = 5;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $invaderGlory = 10;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $defenderGlory = 0;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $forcedLabour = false;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $shamefulNegotiations = false;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $desperateMeasures = false;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $openTheDungeons = false;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $honourGuard = true;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $turn = 1;

    public function setHourglasses($hg)
    {
        $this->hourglasses = $hg;
    }
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
     * Set phase
     *
     * @param Phase $phase
     * @return Stronghold
     */
    public function setPhase(Phase $phase = null)
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * @return int
     */
    public function getHourglasses()
    {
        return $this->hourglasses;
    }

    /**
     * Get phase
     *
     * @return Phase
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * Move to the next phase and return the new phase
     *
     * @return Phase
     */
    public function nextPhase()
    {
        $this->setPhase($this->getPhase()->getNextPhase());
        return $this->getPhase();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actionCards = new ArrayCollection();
    }

    /**
     * Add actionCards
     *
     * @param ActionCard $actionCards
     * @return Stronghold
     */
    public function addActionCard(ActionCard $actionCards)
    {
        $this->actionCards[] = $actionCards;

        return $this;
    }

    /**
     * Remove actionCards
     *
     * @param ActionCard $actionCards
     */
    public function removeActionCard(ActionCard $actionCards)
    {
        $this->actionCards->removeElement($actionCards);
    }

    /**
     * Get actionCards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActionCards()
    {
        return $this->actionCards;
    }

    /**
     * Set resources
     *
     * @param integer $resources
     *
     * @return Stronghold
     */
    public function setResources($resources)
    {
        $this->resources = $resources;

        return $this;
    }

    /**
     * Get resources
     *
     * @return integer
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Set invaderGlory
     *
     * @param integer $invaderGlory
     *
     * @return Stronghold
     */
    public function setInvaderGlory($invaderGlory)
    {
        $this->invaderGlory = $invaderGlory;

        return $this;
    }

    /**
     * Get invaderGlory
     *
     * @return integer
     */
    public function getInvaderGlory()
    {
        return $this->invaderGlory;
    }

    /**
     * Set defenderGlory
     *
     * @param integer $defenderGlory
     *
     * @return Stronghold
     */
    public function setDefenderGlory($defenderGlory)
    {
        $this->defenderGlory = $defenderGlory;

        return $this;
    }

    /**
     * Get defenderGlory
     *
     * @return integer
     */
    public function getDefenderGlory()
    {
        
        return $this->defenderGlory;
    }

    /**
     * Set forcedLabour
     *
     * @param boolean $forcedLabour
     *
     * @return Stronghold
     */
    public function setForcedLabour($forcedLabour)
    {
        $this->forcedLabour = $forcedLabour;

        return $this;
    }

    /**
     * Get forcedLabour
     *
     * @return boolean
     */
    public function getForcedLabour()
    {
        return $this->forcedLabour;
    }

    /**
     * Set shamefulNegotiations
     *
     * @param boolean $shamefulNegotiations
     *
     * @return Stronghold
     */
    public function setShamefulNegotiations($shamefulNegotiations)
    {
        $this->shamefulNegotiations = $shamefulNegotiations;

        return $this;
    }

    /**
     * Get shamefulNegotiations
     *
     * @return boolean
     */
    public function getShamefulNegotiations()
    {
        return $this->shamefulNegotiations;
    }

    /**
     * Set desperateMeasures
     *
     * @param boolean $desperateMeasures
     *
     * @return Stronghold
     */
    public function setDesperateMeasures($desperateMeasures)
    {
        $this->desperateMeasures = $desperateMeasures;

        return $this;
    }

    /**
     * Get desperateMeasures
     *
     * @return boolean
     */
    public function getDesperateMeasures()
    {
        return $this->desperateMeasures;
    }

    /**
     * Set openTheDungeons
     *
     * @param boolean $openTheDungeons
     *
     * @return Stronghold
     */
    public function setOpenTheDungeons($openTheDungeons)
    {
        $this->openTheDungeons = $openTheDungeons;

        return $this;
    }

    /**
     * Get openTheDungeons
     *
     * @return boolean
     */
    public function getOpenTheDungeons()
    {
        return $this->openTheDungeons;
    }

    /**
     * Set honourGuard
     *
     * @param boolean $honourGuard
     *
     * @return Stronghold
     */
    public function setHonourGuard($honourGuard)
    {
        $this->honourGuard = $honourGuard;

        return $this;
    }

    /**
     * Get honourGuard
     *
     * @return boolean
     */
    public function getHonourGuard()
    {
        return $this->honourGuard;
    }

    /**
     * Set turn
     *
     * @param integer $turn
     *
     * @return Stronghold
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Get turn
     *
     * @return integer
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @return Side
     */
    public function getCurrentSide()
    {
        return $this->currentSide;
    }

    /**
     * @param Side $currentSide
     */
    public function setCurrentSide($currentSide)
    {
        $this->currentSide = $currentSide;
    }

    /**
     * @return ActionStack
     */
    public function getActionStack()
    {
        return $this->actionStack;
    }

    /**
     * @param ActionStack $actionStack
     */
    public function setActionStack($actionStack)
    {
        $this->actionStack = $actionStack;
    }


}
