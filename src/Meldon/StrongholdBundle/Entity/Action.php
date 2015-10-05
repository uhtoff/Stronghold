<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 27/09/2015
 * Time: 22:16
 */

namespace Meldon\StrongholdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="action", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class Action  {
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var ActionStack
     * @ORM\ManyToOne(targetEntity="ActionStack")
     */
    private $stack;
    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @var Side
     * @ORM\ManyToOne(targetEntity="Side")
     */
    private $side;

    /**
     * @var ActionDetails
     * @ORM\ManyToOne(targetEntity="ActionDetails")
     */
    private $actionDetails;

    /**
     * @var MasterAction
     * @ORM\ManyToOne(targetEntity="MasterAction")
     */
    private $masterAction;

    /**
     * @var array
     * @ORM\Column(type="array", nullable=true)
     */
    private $data;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ActionStack
     */
    public function getStack()
    {
        return $this->stack;
    }

    /**
     * @param ActionStack $stack
     */
    public function setStack($stack)
    {
        $this->stack = $stack;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
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

    /**
     * @return ActionDetails
     */
    public function getActionDetails()
    {
        return $this->actionDetails;
    }

    /**
     * @param ActionDetails $actionDetails
     */
    public function setActionDetails($actionDetails)
    {
        $this->actionDetails = $actionDetails;
    }

    /**
     * @return MasterAction
     */
    public function getMasterAction()
    {
        return $this->masterAction;
    }

    /**
     * @param MasterAction $masterAction
     */
    public function setMasterAction($masterAction)
    {
        $this->masterAction = $masterAction;
    }


    /**
     * Set data
     *
     * @param array $data
     *
     * @return Action
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Add data to the Action object - merging the array if already in place
     * @param array $data
     * @return Action
     */
    public function addData($data)
    {
        if ( !is_array($this->getData()) ) {
            $this->setData($data);
        } else {
            $this->data = array_merge_recursive($this->data, $data);
        }
        return $this;
    }
}
