<?php

namespace Meldon\StrongholdBundle\Controller;

use Doctrine\Common\Util\Debug;
use Doctrine\ORM\Events;
use Meldon\AuditBundle\Services\LogManager;
use Meldon\AuditBundle\Subscriber\UpdateAuditSubscriber;
use Meldon\StrongholdBundle\Entity\ActionCard;
use Meldon\StrongholdBundle\Entity\Stronghold;
use Meldon\StrongholdBundle\Events\LogFileEvent;
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
        $sm = $this->get('stronghold.stronghold_manager')->setGame($id);
        $sm->nextPhase();
        $sm->addHourglass();
        $sm->saveGame();
        return $this->render('MeldonStrongholdBundle:Default:index.html.twig',
            array('game' => $sm->getGame(),
                'log' => $sm->getLog()));
    }

    /**
     * @Route("/new/{scenario}",defaults={"scenario"=1})
     */
    public function newGame($scenario)
    {
        $sm = $this->get('stronghold.stronghold_manager');
        $sm->createGame($scenario);
        $sm->saveGame();
        return $this->redirectToRoute('meldon_stronghold_default_index',
            array('id' => $sm->getGame()->getId()));

    }
}
