<?php

namespace App\Controller;

use App\Repository\DGRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TarifsController extends AbstractController
{



    /**
     * @Route("/tarif_visite", name="tarif_visite")
     */
    public function tarif_visite()
    {
        return $this->render('pages/tarifs/tarif_visite/tarif_visite.html.twig');

    }
    /**
     * @Route("/tarif_reception", name="tarif_reception")
     */
    public function tarif_reception()
    {
        return $this->render('pages/tarifs/tarif_reception/tarif_reception.html.twig');

    }  
     /**
     * @Route("/tarif_consta", name="tarif_consta")
     */
     public function tarif_consta()
     {
        return $this->render('pages/tarifs/tarif_consta/tarif_consta.html.twig');

    }    
    
}
