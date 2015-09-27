<?php
namespace Meldon\StrongholdBundle\Repositories;

use Doctrine\ORM\EntityRepository;
use Meldon\StrongholdBundle\Entity\Side;

class SideRepository extends EntityRepository
{
    /**
     * @param $abb
     * @return Side
     */
    public function getSideByAbbreviation($abb)
    {
        return $this->findOneByAbbreviation($abb);
    }
}