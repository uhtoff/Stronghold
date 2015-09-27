<?php
namespace Meldon\StrongholdBundle\Repositories;

use Doctrine\ORM\EntityRepository;
use Meldon\StrongholdBundle\Entity\Stronghold;
use Meldon\StrongholdBundle\Entity\StrongholdLogItem;

class StrongholdLogItemRepository extends EntityRepository
{
    public function save(StrongholdLogItem $log)
    {
        $this->_em->persist($log);
        $this->_em->flush();
    }

    /**
     * @param Stronghold $game
     * @return mixed
     */
    public function getLogsByGame(Stronghold $game)
    {
        return $this->findByGame($game,
            array('id' => 'DESC'));
    }
}