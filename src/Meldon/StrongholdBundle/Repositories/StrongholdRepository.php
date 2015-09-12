<?php
/**
 * Created by PhpStorm.
 * User: Russ
 * Date: 25/07/2015
 * Time: 21:25
 */

namespace Meldon\StrongholdBundle\Repositories;

use Doctrine\ORM\EntityRepository;
use Meldon\StrongholdBundle\Entity\Stronghold;

class StrongholdRepository extends EntityRepository
{
    public function getGameByID($id)
    {
        return $this->find($id);
    }
    public function save(Stronghold $entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
    public function remove(Stronghold $entity)
    {
        $this->_em->remove($entity);
    }
}