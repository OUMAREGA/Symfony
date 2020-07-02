<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MultiplyController extends AbstractController
{
    /**
     * @Route("/multiply/{xmin<\d+>}/{xmax<\d+>}/{ymin<\d+>}/{ymax<\d+>} ", name="multiply")
     *
     * @param $xmin
     * @param $xmax
     * @param $ymin
     * @param $ymax
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function multiplyAction($xmin, $xmax, $ymin, $ymax,  SessionInterface $session)
    {

        #stocke les paramètres en session
        $session->set('xmin', $xmin);
        $session->set('xmax', $xmax);
        $session->set('ymin', $ymin);
        $session->set('ymax', $ymax);


        return $this->render('multiply/index.html.twig', [
            'xmin' => $xmin,
            'xmax' => $xmax,
            'ymin' => $ymin,
            'ymax' => $ymax,
        ]);
    }

    /**
     * @Route("/sessionmultiply", name="sessionmultiply")
     */
    public function sessionmultiply(SessionInterface $session)
    {
        #verifie si la session a les donnees xmin, xmax, ymi, ymax
        if($session->has("xmin") && $session->has("xmax") && $session->has("ymin") && $session->has("ymax")) {
            #retourne la vue avec les données de la session
            return $this->render('multiply/index.html.twig', [
                'xmin' => $session->get('xmin'),
                'xmax' => $session->get('xmax'),
                'ymin' => $session->get('ymin'),
                'ymax' => $session->get('ymax')
            ]);
        } else {
            #retourne les valeurs par defaut
            return $this->render('multiply/index.html.twig', [
                'xmin' => 0,
                'xmax' => 10,
                'ymin' => 0,
                'ymax' => 10
            ]);
        }
    }
}
