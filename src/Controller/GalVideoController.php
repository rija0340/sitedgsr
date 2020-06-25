<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Repository\ActualiteRepository;
use App\Repository\DGRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GalVideoController extends AbstractController
{

   /**
     * @Route("/gallerie_video", name="gallerie_video")
     */
   public function gallerie_video(ActualiteRepository $repository)
   {

   	$actualites = new Actualite();
   	$actualites = $repository->findBy(array(), array('id' => 'DESC'));
   	return $this->render('pages/gallerie_video/gallerie_video.html.twig', [
   		'actualites' => $actualites,
      
    ]);


   }
 }
