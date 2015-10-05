<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 05/10/2015
 * Time: 12:41
 */

namespace Meldon\StrongholdBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="master_action", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class MasterAction  {
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
     * @ORM\Column(length=250)
     */
    private $name;
    /**
     * @var ActionOrder
     * @ORM\OneToMany(targetEntity="ActionOrder", mappedBy="masterAction")
     */
    private $actionOrder;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actionOrder = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return MasterAction
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
     * Add actionOrder
     *
     * @param ActionOrder $actionOrder
     *
     * @return MasterAction
     */
    public function addActionOrder(ActionOrder $actionOrder)
    {
        $this->actionOrder[] = $actionOrder;

        return $this;
    }

    /**
     * Remove actionOrder
     *
     * @param ActionOrder $actionOrder
     */
    public function removeActionOrder(ActionOrder $actionOrder)
    {
        $this->actionOrder->removeElement($actionOrder);
    }

    /**
     * Get actionOrder
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActionOrder()
    {
        return $this->actionOrder;
    }
}
