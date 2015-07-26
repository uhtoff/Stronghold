<?php

namespace Meldon\StrongholdBundle\Controller;

use Doctrine\ORM\Events;
use Meldon\AuditBundle\Subscriber\UpdateAuditSubscriber;
use Meldon\StrongholdBundle\Entity\ActionCard;
use Meldon\StrongholdBundle\Entity\Stronghold;
use Meldon\StrongholdBundle\Services\StrongholdManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $s = $em->getRepository('MeldonStrongholdBundle:Stronghold')->find(1);
        $s->setHourglasses(15);
        $em->flush();
        return array('name' => $name);
    }
}
