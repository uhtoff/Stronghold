<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 27/09/2015
 * Time: 22:14
 */

namespace Meldon\StrongholdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="action_details", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
 
class ActionDetails  {
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * Name to display on log when action completed
     * @var string
     * @ORM\Column(length=100, nullable=true)
     */
    private $name;
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
     * @var ActionDetails
     * @ORM\ManyToOne(targetEntity="ActionDetails")
     */
    private $nextAction;
    /**
     * @var string
     * @ORM\Column(length=10)
     */
    private $side;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return ActionDetails
     */
    public function getNextAction()
    {
        return $this->nextAction;
    }

    /**
     * @param ActionDetails $nextAction
     */
    public function setNextAction($nextAction)
    {
        $this->nextAction = $nextAction;
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

}