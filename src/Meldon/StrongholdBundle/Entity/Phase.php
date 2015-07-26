<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 20/07/2015
 * Time: 23:27
 */

namespace Meldon\StrongholdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="phase", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class Phase  {
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
     *
     * @ORM\Column(length=50)
     */
    private $name;
    /**
     * @var Phase
     *
     * @ORM\OneToOne(targetEntity="Phase")
     */
    private $nextPhase;

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
     * Set name
     *
     * @param string $name
     * @return Phase
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nextPhase
     *
     * @param Phase $nextPhase
     * @return Phase
     */
    public function setNextPhase(Phase $nextPhase = null)
    {
        $this->nextPhase = $nextPhase;

        return $this;
    }

    /**
     * Get nextPhase
     *
     * @return Phase
     */
    public function getNextPhase()
    {
        return $this->nextPhase;
    }
}
