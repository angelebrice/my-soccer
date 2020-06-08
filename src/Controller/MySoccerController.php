<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MySoccerController extends AbstractController
{
    /**
     * @Route("/accueil", name="home")
     */
    public function index()
    {
        return $this->render('my_soccer/index.html.twig', [
            'controller_name' => 'MySoccerController',
        ]);
    }
}
