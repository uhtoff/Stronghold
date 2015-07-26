<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 21/07/2015
 * Time: 15:28
 */

namespace Meldon\StrongholdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Acl\Model\SecurityIdentityInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="unit", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class Unit  {
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var Side
     *
     * @ORM\ManyToOne(targetEntity="Side")
     */
    private $side;


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
     * Set side
     *
     * @param \Meldon\StrongholdBundle\Entity\Side $side
     * @return Unit
     */
    public function setSide(\Meldon\StrongholdBundle\Entity\Side $side = null)
    {
        $this->side = $side;

        return $this;
    }

    /**
     * Get side
     *
     * @return \Meldon\StrongholdBundle\Entity\Side 
     */
    public function getSide()
    {
        return $this->side;
    }
}
