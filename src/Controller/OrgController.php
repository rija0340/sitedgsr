<?php

namespace App\Controller;

use App\Entity\Organigramme;
use App\Repository\OrganigrammeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrgController extends AbstractController
{

  
    /**
     * @Route("/organigramme", name="organigramme")
     */
    public function organigramme(OrganigrammeRepository $repo)
    {
    	$org = new Organigramme();
    	$org = $repo->findLatest();


        return $this->render('pages/organigramme/organigramme.html.twig',[

        	'org' => $org

        ]);
    }
      
}
