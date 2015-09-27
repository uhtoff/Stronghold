<?php
namespace Meldon\StrongholdBundle\Repositories;

use Doctrine\ORM\EntityRepository;
use Meldon\StrongholdBundle\Entity\StrongholdLogItem;

class StrongholdLogItemRepository extends EntityRepository
{
    public function save(StrongholdLogItem $log)
    {
        $this->_em->persist($log);
        $this->_em->flush();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLogsByID($id)
    {
        return $this->findByGameID($id,
            array('id' => 'DESC'));
    }
}