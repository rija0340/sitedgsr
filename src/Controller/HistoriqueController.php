<?php

namespace App\Controller;

use App\Repository\DGRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
      /**
     * @Route("/historique", name="historique")
     */
    public function historique(DGRepository $repo)
    {
        $directors = $repo->findAll(); 
        return $this->render('pages/historique/historique.html.twig', [
            'directors' => $directors
        ]);
    }  
}
