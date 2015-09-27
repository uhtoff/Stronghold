<?php
namespace Meldon\StrongholdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Russ
 * @ORM\Entity
 * @ORM\Table(name="action_stack")
 */
class ActionStack {
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var Stronghold
     * @ORM\OneToOne(targetEntity="Stronghold", mappedBy="actionStack")
     */
    private $game;
    /**
     * @var Decision[]
     * @ORM\OneToMany(targetEntity="Decision", mappedBy="stack", indexBy="position")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $actions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actions = new ArrayCollection();
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
     * Set game
     *
     * @param Stronghold $game
     * @return ActionStack
     */
    public function setGame(Stronghold $game = null)
    {
        $this->game = $game;
        $game->setActionStack($this);
        return $this;
    }

    /**
     * Get game
     *
     * @return Stronghold
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Add actions
     *
     * @param Decision $actions
     * @return ActionStack
     */
    public function addAction(Decision $actions)
    {
        $this->actions[] = $actions;

        return $this;
    }

    /**
     * Remove actions
     *
     * @param Decision $actions
     */
    public function removeAction(Decision $actions)
    {
        $this->actions->removeElement($actions);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }
    /**
     * Return number of decisions on the stack
     * @return integer
     */
    public function numOnStack()
    {
        return count( $this->getActions() );
    }

    /**
     * Map through array collection getting positions of all decisions
     * @return integer[]
     */
    public function getPositions()
    {
        return $this->getActions()
            ->map(function($d){return $d->getPosition();})->toArray();
    }
    /**
     * @return Decision
     */
    public function getCurrentAction()
    {
        if ( $this->getActions()->count() > 0 ) {
            $topPos = min($this->getPositions());
            return $this->getActions()->filter(
                function ($e) use ($topPos) {
                    return $e->getPosition() === $topPos;
                }
            )->first();
        } else {
            return null;
        }

    }
    /**
     * Returns the top decision from the array
     * @return Decision|boolean
     */
    public function takeFromTop()
    {
        $d = $this->getCurrentAction();
        if ( $d !== false )
        {
            $this->removeAction($d);
            return $d;
        } else
        {
            return false;
        }
    }
    /**
     * Returns the bottom decision from the array
     * @return Decision|boolean
     */
    public function takeFromBottom()
    {
        $d = $this->getActions()->last();
        if ( $d !== false )
        {
            $this->removeAction($d);
            return $d;
        } else {
            return false;
        }
    }

    /**
     * Adds a decision to the top of the stack, shuffles down the positions if necessary
     * @param Decision $d
     * @return Decision $d
     */
    public function addToTop(Decision $d)
    {
        $pos = $this->getPositions();
        // If card group is empty
        if ( count($pos) != 0 ) {
            $topPos = min($this->getPositions());
            if ( $topPos == 1 ) {
                $this->getActions()
                    ->map(function($d){$d->setPosition($d->getPosition() + 1);});
            }
        }
        $d->setPosition(1);
        $d->setStack($this);
        return $d;
    }

    /**
     * Adds a decision to the bottom of the stack
     * @param Decision $d
     * @return Decision
     */
    public function addToBottom(Decision $d) {
        $pos = $this->getPositions();
        if ( count($pos) == 0 )
        {
            $bottomPos = 0;
        } else
        {
            $bottomPos = max($pos);
        }
        $d->setPosition($bottomPos + 1);
        $d->setStack($this);
        return $d;
    }

    /**
     * Sort stack by position order
     */
    protected function sortStack() {
        $iterator = $this->getActions()->getIterator();
        $iterator->uasort(function ($a, $b) {
            return ($a->getPosition() < $b->getPosition()) ? -1 : 1;
        });
        $array = iterator_to_array($iterator);
        $this->actions = new ArrayCollection(iterator_to_array($iterator));
    }

    public function removeActionByID($a)
    {
        foreach( $this->getActions() as $action ) {
            if ( $action->getID() === $a->getID() ) {
                $this->removeAction($action);
                break;
            }
        }
        $a->unsetStack();
    }
}