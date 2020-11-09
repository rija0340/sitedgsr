<?php

namespace App\Controller;

use App\Entity\Organigramme;
use App\Repository\OrganigrammeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ImagesEntete;
use App\Repository\ImagesEnteteRepository;

class OrgController extends AbstractController
{

      public function __construct( ImagesEnteteRepository $imgenteterepo ){

        $this->imgenteterepo = $imgenteterepo;

    }

    /**
     * @Route("/organigramme", name="organigramme")
     */
    public function organigramme(OrganigrammeRepository $repo)
    {
    	$org = new Organigramme();
    	$org = $repo->findLatest();
        $i = 0;
        
        $last_image = new ImagesEntete();
        $images = $this->imgenteterepo->findAll();

        foreach ($images as $cle => $img) {

            if ( $img->getLabelCouverture()->getLabel() == 'organigramme' ) {
                $ity['$i'] = $img;
                $i = $i +1;
            }
        }

        $last_image = $ity['$i'];

        return $this->render('pages/organigramme/organigramme.html.twig',[

            'org' => $org,
            'last_image' =>  $last_image

        ]);
    }
      
}
