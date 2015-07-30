<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 20/07/2015
 * Time: 23:37
 */

namespace Meldon\StrongholdBundle\Entity;


use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToOne(targetEntity="Phase")
     */
    private $phase;
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
     */
    private $hourglasses;

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
        $this->actionCards = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add actionCards
     *
     * @param \Meldon\StrongholdBundle\Entity\ActionCard $actionCards
     * @return Stronghold
     */
    public function addActionCard(\Meldon\StrongholdBundle\Entity\ActionCard $actionCards)
    {
        $this->actionCards[] = $actionCards;

        return $this;
    }

    /**
     * Remove actionCards
     *
     * @param \Meldon\StrongholdBundle\Entity\ActionCard $actionCards
     */
    public function removeActionCard(\Meldon\StrongholdBundle\Entity\ActionCard $actionCards)
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
}
