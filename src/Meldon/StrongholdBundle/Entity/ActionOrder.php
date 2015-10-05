<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 05/10/2015
 * Time: 12:50
 */

namespace Meldon\StrongholdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="action_order", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class ActionOrder  {
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var MasterAction
     * @ORM\ManyToOne(targetEntity="MasterAction", inversedBy="actionOrder")
     */
    private $masterAction;
    /**
     * @var ActionDetails
     * @ORM\ManyToOne(targetEntity="ActionDetails")
     */
    private $actionDetails;
    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $order;

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
     * Set order
     *
     * @param integer $order
     *
     * @return ActionOrder
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set masterAction
     *
     * @param MasterAction $masterAction
     *
     * @return ActionOrder
     */
    public function setMasterAction(MasterAction $masterAction = null)
    {
        $this->masterAction = $masterAction;

        return $this;
    }

    /**
     * Get masterAction
     *
     * @return MasterAction
     */
    public function getMasterAction()
    {
        return $this->masterAction;
    }

    /**
     * Set actionDetails
     *
     * @param ActionDetails $actionDetails
     *
     * @return ActionOrder
     */
    public function setActionDetails(ActionDetails $actionDetails = null)
    {
        $this->actionDetails = $actionDetails;

        return $this;
    }

    /**
     * Get actionDetails
     *
     * @return ActionDetails
     */
    public function getActionDetails()
    {
        return $this->actionDetails;
    }
}
