<?php

namespace App\Controller;

use App\Entity\Centre;
use App\Entity\Faritany;
use App\Entity\Ville;
use App\Entity\Imagesentete;
use App\Repository\CentreRepository;
use App\Repository\FaritanyRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ImagesEnteteRepository;

class CentresController extends AbstractController
{



	private $faritanyRepo;
 private $centreRepo;
 private $villeRepo;

 public function __construct (FaritanyRepository $faritanyRepo,VilleRepository $villeRepo ,CentreRepository $centreRepo,ImagesEnteteRepository $imgenteterepo)
 {
  $this->faritanyRepo = $faritanyRepo;
  $this->villeRepo = $villeRepo;
  $this->centreRepo = $centreRepo;
  $this->imgenteterepo = $imgenteterepo;


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
      

      //affichage image en couveture
      $i = 0;
      
      $last_image = new ImagesEntete();
      $images = $this->imgenteterepo->findAll();

      foreach ($images as $cle => $img) {

        if ( $img->getLabelCouverture()->getLabel() == 'centres' ) {
          $ity['$i'] = $img;
          $i = $i +1;
        }
      }
      $i = $i - 1;

      $last_image = $ity['$i'];

      return $this->render('pages/centres/centres.html.twig', [

        'faritany' => $faritany,
        'centres' => $centres,
        'villes' => $villes,
        'last_image'=> $last_image

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
