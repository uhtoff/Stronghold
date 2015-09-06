<?php

namespace Meldon\StrongholdBundle\Controller;

use Doctrine\ORM\Events;
use Meldon\AuditBundle\Services\LogManager;
use Meldon\AuditBundle\Subscriber\UpdateAuditSubscriber;
use Meldon\StrongholdBundle\Entity\ActionCard;
use Meldon\StrongholdBundle\Entity\Stronghold;
use Meldon\StrongholdBundle\Services\StrongholdManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("stronghold")
 * Class DefaultController
 * @package Meldon\StrongholdBundle\Controller
 */

class DefaultController extends Controller
{
    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function indexAction($id)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $ae = $em->getRepository("MeldonAuditBundle:AuditEntry")->find(41);
        $am = $this->get('audit.audit_manager');
        $sm = $this->get('stronghold.stronghold_manager')->setGame($id);
        $sm->deleteGame();
//        $sm->nextPhase();
//        $sm->addHourglass();
        $em->flush();
        return $this->render('MeldonStrongholdBundle:Default:index.html.twig',
            array('game' => $sm->getGame()));
    }

    /**
     * @Route("/new/{scenario}",defaults={"scenario"=1})
     */
    public function newGame($scenario)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $pr = $em->getRepository("MeldonStrongholdBundle:Phase");
        $p1 = $pr->getStartingPhase($scenario);
        $sh = new Stronghold();
        $sh->setPhase($p1);
        $em->persist($sh);
        $em->flush();
        return $this->redirectToRoute('meldon_stronghold_default_index',
            array('id' => $sh->getId()));

    }
}
