<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Attachement;
use App\Repository\ActualiteRepository;
use App\Repository\AttachementRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;


class ActualitesController extends AbstractController
{

    private $repository;
    private $attachrepo;
    private $attachement;

    public function __construct(ActualiteRepository $repository, AttachementRepository $attachrepo, ObjectManager $em){

        $this->repository = $repository;
        $this->attachrepo = $attachrepo;
    }

    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualites(ActualiteRepository $repository)
    {
    	$actualites = new Actualite();

    	$actualites = $this->repository->findBy(array(),  array('datePub' => 'DESC'));

    	return $this->render('pages/actualites/actualites.html.twig',[

    		'actualites' => $actualites
    	]);

    }

        /**
    * @Route("/actualite/{id}", name="actualite.show", methods = {"GET"})
    * @param Actualite actualite
    * 
    */
        public function show(int $id, Actualite $actualite,   Request $request){

            $attachement = Array();
            $i = 0;

         if($request->isXmlHttpRequest()) {

            $actualite = $this->repository->find($id);

            $att = $actualite->getAttachements();

            foreach($att as $att){

                    $attachement[$i] = $att->getImage();
                    $i = $i + 1;

            }
        

            $response = new Response(json_encode(array(

                'titre' => $actualite->getTitle(),
                'contenu' => $actualite->getContent(),
                'img' => $actualite->getFilename(),
                'url_video' => $actualite->getUrlVideo(),
                'datepub' => $actualite->getDatePub(),
                'attachement' => $attachement


            )));

            $response->headers->set('Content-Type', 'application/json');

          /*  var_dump( $attachement[0] );*/
            return $response;

        }else{

            return $this->render('pages/actualites/actualites.html.twig',[

                'actualites' => $actualites
            ]);

        }

    }    

}
