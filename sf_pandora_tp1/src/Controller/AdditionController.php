<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdditionController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function Accueil()
    {
        #retourne la vue
        return $this->render('accueil/index.html.twig', []);
    }

    /**
     * @Route("/addition/{xmin<\d+>}/{xmax<\d+>}/{ymin<\d+>}/{ymax<\d+>}", name="addition")
     */
    public function AdditionAction($xmin, $xmax, $ymin, $ymax, SessionInterface $session)
    {
        #stocke les paramètres en session
        $session->set('xmin', $xmin);
        $session->set('xmax', $xmax);
        $session->set('ymin', $ymin);
        $session->set('ymax', $ymax);

        #retourne la vue
        return $this->render('addition/index.html.twig', [
            'xmin' => $xmin,
            'xmax' => $xmax,
            'ymin' => $ymin,
            'ymax' => $ymax
        ]);
    }

    /**
     * @Route("/addition", name="voir-addition")
     */
    public function ShowAddition(SessionInterface $session)
    {
        #verifie si la session a les donnees xmin, xmax, ymi, ymax
        if ($session->has("xmin") && $session->has("xmax") && $session->has("ymin") && $session->has("ymax")) {
            #retourne la vue avec les données de la session
            return $this->render('addition/index.html.twig', [
                'xmin' => $session->get('xmin'),
                'xmax' => $session->get('xmax'),
                'ymin' => $session->get('ymin'),
                'ymax' => $session->get('ymax')
            ]);
        } else {
            #retourne les valeurs par defaut
            return $this->render('addition/index.html.twig', [
                'xmin' => 0,
                'xmax' => 10,
                'ymin' => 0,
                'ymax' => 10
            ]);
        }
    }
}

