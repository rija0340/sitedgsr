<?php

namespace App\Controller;

use App\Entity\ImagesEntete;
use App\Repository\ImagesEnteteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CouvertureController extends AbstractController
{

    private $imageenteterepo;


    public function __construct(ImagesEnteteRepository $imageenteterepo){

        $this->imageenteterepo = $imageenteterepo;
    }


    /**
     * @Route("/couverture", name="couverture")
     */
    public function couverture()
    {
    	// $actualites = new Actualite();

    	// $actualites = $this->acturepo->findBy(array(), array('id' => 'DESC'));
    	// return $this->render('pages/gallerie_photo/gallerie_photo.html.twig', [
    	// 	'actualites' => $actualites
    	// ]);

    }  

}
