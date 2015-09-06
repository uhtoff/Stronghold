<?php
namespace Meldon\StrongholdBundle\Repositories;

use Doctrine\ORM\EntityRepository;
use Meldon\StrongholdBundle\Entity\Phase;

class PhaseRepository extends EntityRepository
{
    /**
     * Get starting phase taking scenario as an option
     * @return Phase
     */
    public function getStartingPhase($scenario)
    {
        return $this->find(1);
    }
}