<?php

namespace App\Controller;

use App\Repository\DGRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MissionsController extends AbstractController
{

    /**
     * @Route("/missions", name="missions")
     */
    public function missions()
    {
        return $this->render('pages/missions/missions.html.twig');
    }   
     
}
