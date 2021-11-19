<?php

namespace App\Controller;

use App\Repository\DGRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ImagesEnteteRepository;
use App\Entity\ImagesEntete;

class TarifsController extends AbstractController
{


    public function __construct(ImagesEnteteRepository $imgenteterepo)
    {

        $this->imgenteterepo = $imgenteterepo;
    }


    /**
     * @Route("/tarifs", name="tarifs")
     */
    public function tarifs()
    {

        return $this->render('pages/tarifs/tarifs.html.twig');
    }
    /**
     * @Route("/tarifs/visite-sur-site-apte", name="visite_site_apte")
     */
    public function visite_site_apte()
    {
        return $this->render('pages/tarifs/tarif_visite/visite_site_apte.html.twig', [
            'last_image' => $this->getImageCouverture()
        ]);
    }
    /**
     * @Route("/tarifs/visite-sur-site-inapte", name="visite_site_inapte")
     */
    public function visite_site_inapte()
    {
        return $this->render('pages/tarifs/tarif_visite/visite_site_inapte.html.twig', [
            'last_image' => $this->getImageCouverture()
        ]);
    }
    /**
     * @Route("/tarifs/visite-a-domicile", name="visite_domicile")
     */
    public function visite_domicile()
    {
        return $this->render('pages/tarifs/tarif_visite/visite_domicile.html.twig', [
            'last_image' => $this->getImageCouverture()
        ]);
    }

    /**
     * @Route("/tarifs/réception", name="tarif_reception")
     */
    public function tarif_reception()
    {
        return $this->render('pages/tarifs/tarif_reception/reception.html.twig', [
            'last_image' => $this->getImageCouverture()
        ]);
    }
    /**
     * @Route("/tarifs/constatation-avant-dedouanement", name="tarif_consta")
     */
    public function tarif_consta()
    {
        return $this->render('pages/tarifs/tarif_consta/consta.html.twig', [
            'last_image' => $this->getImageCouverture()
        ]);
    }

    /**
     * @Route("/liste_abbrev", name="liste_abbrev")
     */
    public function liste_abbrev()
    {
        return $this->render('pages/tarifs/abbreviations.html.twig', [
            'last_image' => $this->getImageCouverture()
        ]);
    }



    public function getImageCouverture()
    {
        //affichage image en couveture
        $i = 0;

        $last_image = new ImagesEntete();
        $images = $this->imgenteterepo->findAll();

        foreach ($images as $cle => $img) {

            if ($img->getLabelCouverture()->getLabel() == 'tarifs') {
                $ity['$i'] = $img;
                $i = $i + 1;
            }
        }
        $i = $i - 1;

        $last_image = $ity['$i'];
        return $last_image;
    }
}
