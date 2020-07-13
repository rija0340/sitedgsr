<?php

namespace App\Controller;

use App\Entity\Centre;
use App\Entity\Faritany;
use App\Entity\Ville;
use App\Repository\CentreRepository;
use App\Repository\FaritanyRepository;
use App\Repository\VilleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CentresController extends AbstractController
{



	private $faritanyRepo;
 private $centreRepo;
 private $villeRepo;

 public function __construct (FaritanyRepository $faritanyRepo,VilleRepository $villeRepo ,CentreRepository $centreRepo, ObjectManager $em)
 {
  $this->faritanyRepo = $faritanyRepo;
  $this->villeRepo = $villeRepo;
  $this->centreRepo = $centreRepo;
  $this->em = $em;

}


     /**
     * @Route("/centres", name="centres")
     */
     public function centres()
     {

     	$centres = new Centre();
      $faritany = new Faritany();
      $villes = new Ville();

      $faritany = $this->faritanyRepo->findAll();
      $centres = $this->centreRepo->findAll();
      $villes = $this->villeRepo->findAll(['ville' => 'ASC']);
      
      dump($villes);

      return $this->render('pages/centres/centres.html.twig', [

        'faritany' => $faritany,
        'centres' => $centres,
        'villes' => $villes,

      ]);
    }

    /**
    * @Route("/centre/{id}", name="centre.show", methods = {"GET"})
    * @param Centre centre
    * 
    */
    public function show(int $id, Centre $centre, Request $request){

     if($request->isXmlHttpRequest()) {

      $id_centre =  $request->request->get('id_centre'); 
      $centre = $this->centreRepo->find($id);

      $response = new Response(json_encode(array(

        'adresse' => $centre->getAdresse(),
        'grade_cc' => $centre->getGradeCc(),
        'nom_cc' => $centre->getNomCc(),
        'num_cc' => $centre->getNumCc(),
        'ville' => $centre->getVille()->getVille(),
        'faritany' => $centre->getVille()->getFaritany()->getFaritany(),
        'filename' => $centre->getFilename(),
        'imageFile' => $centre->getImageFile()

      )));

      $response->headers->set('Content-Type', 'application/json');

      return $response;

    }



  }
}
