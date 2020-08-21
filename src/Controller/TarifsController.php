<?php

namespace App\Controller;

use App\Repository\DGRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TarifsController extends AbstractController
{


    /**
     * @Route("/tarifs", name="tarifs")
     */
    public function tarifs()
    {
        return $this->render('pages/tarifs/tarifs.html.twig');

    }
    /**
     * @Route("/visite_site_apte", name="visite_site_apte")
     */
    public function visite_site_apte()
    {
        return $this->render('pages/tarifs/tarif_visite/visite_site_apte.html.twig');

    }
    /**
     * @Route("/visite_site_inapte", name="visite_site_inapte")
     */
    public function visite_site_inapte()
    {
        return $this->render('pages/tarifs/tarif_visite/visite_site_inapte.html.twig');

    }
    /**
     * @Route("/visite_domicile", name="visite_domicile")
     */
    public function visite_domicile()
    {
        return $this->render('pages/tarifs/tarif_visite/visite_domicile.html.twig');

    }

    /**
     * @Route("/tarif_reception", name="tarif_reception")
     */
    public function tarif_reception()
    {
        return $this->render('pages/tarifs/tarif_reception/reception.html.twig');

    }  
     /**
     * @Route("/tarif_consta", name="tarif_consta")
     */
     public function tarif_consta()
     {
        return $this->render('pages/tarifs/tarif_consta/consta.html.twig');

    }  

    /**
     * @Route("/liste_abbrev", name="liste_abbrev")
     */
    public function liste_abbrev()
    {
        return $this->render('pages/tarifs/abbreviations.html.twig');

    }   



}
