<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 21/07/2015
 * Time: 10:09
 */

namespace Meldon\StrongholdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="action_card_master", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class ActionCardMaster  {
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     */
    private $actions;
    /**
     * @var Phase
     *
     * @ORM\OneToOne(targetEntity="Phase")
     */
    private $phase;

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
     * @param \Meldon\StrongholdBundle\Entity\Phase $phase
     * @return ActionCardMaster
     */
    public function setPhase(\Meldon\StrongholdBundle\Entity\Phase $phase = null)
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * Get phase
     *
     * @return \Meldon\StrongholdBundle\Entity\Phase 
     */
    public function getPhase()
    {
        return $this->phase;
    }
}
