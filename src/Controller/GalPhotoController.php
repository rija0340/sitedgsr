<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Repository\ActualiteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GalPhotoController extends AbstractController
{


    /**
     * @Route("/gallerie_photo", name="gallerie_photo")
     */
    public function gallerie_photo(ActualiteRepository $repository)
    {
    	$actualites = new Actualite();
    	$actualites = $repository->findBy(array(), array('id' => 'DESC'));
    	return $this->render('pages/gallerie_photo/gallerie_photo.html.twig', [
    		'actualites' => $actualites
    	]);

    }  

}
