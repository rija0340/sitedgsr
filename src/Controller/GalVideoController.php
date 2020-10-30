<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\ImagesEntete;
use App\Repository\ImagesEnteteRepository;
use App\Repository\ActualiteRepository;
use App\Repository\DGRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GalVideoController extends AbstractController
{


    public function __construct(ImagesEnteteRepository $imgenteterepo){

        $this->imgenteterepo = $imgenteterepo;
    }

   /**
     * @Route("/gallerie_video", name="gallerie_video")
     */
   public function gallerie_video(ActualiteRepository $repository)
   {


            //affichage image en couveture
      $i = 0;
      
      $last_image = new ImagesEntete();
      $images = $this->imgenteterepo->findAll();

      foreach ($images as $cle => $img) {

        if ( $img->getLabelCouverture()->getLabel() == 'galerie vidéo' ) {
          $ity['$i'] = $img;
          dump($ity['$i']);
          $i = $i +1;
          dump($img);
        }
      }
      $i = $i - 1;
      $last_image = $ity['$i'];

   	$actualites = new Actualite();
   	$actualites = $repository->findBy(array(), array('id' => 'DESC'));
   	return $this->render('pages/gallerie_video/gallerie_video.html.twig', [
      'actualites' => $actualites,
   		'last_image' => $last_image,
      
    ]);


   }
 }
