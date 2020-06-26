<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Repository\ActualiteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AttachementRepository;

class GalPhotoController extends AbstractController
{

    private $acturepo;
    private $attachrepo;
    private $attachement;

    public function __construct(ActualiteRepository $acturepo, AttachementRepository $attachrepo, ObjectManager $em){

        $this->acturepo = $acturepo;
        $this->attachrepo = $attachrepo;
    }


    /**
     * @Route("/gallerie_photo", name="gallerie_photo")
     */
    public function gallerie_photo()
    {
    	$actualites = new Actualite();

    	$actualites = $this->acturepo->findBy(array(), array('id' => 'DESC'));
    	return $this->render('pages/gallerie_photo/gallerie_photo.html.twig', [
    		'actualites' => $actualites
    	]);

    }  

}
