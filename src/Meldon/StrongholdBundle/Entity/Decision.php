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
 * @ORM\Table(name="Decision", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class Decision  {
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
     * @ORM\Column(targetEntity="ActionStack")
     */
    private $stack;
    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $position;
    /**
     * @var string
     * @ORM\Column(length=50, nullable=true)
     */
    private $form;
    /**
     * @var string
     * @ORM\Column(length=50)
     */
    private $method;
    /**
     * @var Side
     * @ORM\ManyToOne(targetEntity="Side")
     */
    private $side;
    /**
     * @var Action
     * @ORM\ManyToOne(targetEntity="Action")
     */
    private $nextAction;

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
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param string $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
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
     * @return Action
     */
    public function getNextAction()
    {
        return $this->nextAction;
    }

    /**
     * @param Action $nextAction
     */
    public function setNextAction($nextAction)
    {
        $this->nextAction = $nextAction;
    }

}