<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\ImagesEntete;
use App\Repository\ImagesEnteteRepository;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AttachementRepository;


class GalPhotoController extends AbstractController
{

    private $acturepo;
    private $attachrepo;
    private $attachement;

    public function __construct(ActualiteRepository $acturepo, AttachementRepository $attachrepo, ImagesEnteteRepository $imgenteterepo){

        $this->acturepo = $acturepo;
        $this->attachrepo = $attachrepo;
        $this->imgenteterepo = $imgenteterepo;
    }


    /**
     * @Route("/gallerie_photo", name="gallerie_photo")
     */
    public function gallerie_photo()
    {
    	$actualites = new Actualite();
    	$actualites = $this->acturepo->findBy(array(), array('id' => 'DESC'));

            //affichage image en couveture
      $i = 0;
      
      $last_image = new ImagesEntete();
      $images = $this->imgenteterepo->findAll();

      foreach ($images as $cle => $img) {

        if ( $img->getLabelCouverture()->getLabel() == 'galerie photo' ) {
          $ity['$i'] = $img;
          $i = $i +1;
        }
      }
      $i = $i - 1;
      $last_image = $ity['$i'];
    	return $this->render('pages/gallerie_photo/gallerie_photo.html.twig', [
            'actualites' => $actualites,
    		'last_image' => $last_image
    	]);

    }  

}
