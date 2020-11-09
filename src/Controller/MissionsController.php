<?php

namespace App\Controller;

use App\Repository\DGRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ImagesEntete;
use App\Repository\ImagesEnteteRepository;

class MissionsController extends AbstractController
{

	private $dgwordRepo;
	private $repo;

	public function __construct( ImagesEnteteRepository $imgenteterepo ){

		$this->imgenteterepo = $imgenteterepo;

	}

    /**
     * @Route("/missions", name="missions")
     */
    public function missions()
    {
    	$i = 0;
    	
    	$last_image = new ImagesEntete();
    	$images = $this->imgenteterepo->findAll();

    	foreach ($images as $cle => $img) {

    		if ( $img->getLabelCouverture()->getLabel() == 'missions' ) {
    			$ity['$i'] = $img;
    			$i = $i +1;
    		}
    	}
    	$i = $i -1;

    	$last_image = $ity['$i'];
    	return $this->render('pages/missions/missions.html.twig', [
    		'last_image' =>  $last_image

    	]);
    }   

}
