<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Attachement;
use App\Entity\ImagesEntete;
use App\Repository\ImagesEnteteRepository;
use App\Repository\ActualiteRepository;
use App\Repository\AttachementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;


class ActualitesController extends AbstractController
{

    private $acturepo;
    private $attachrepo;
    private $attachement;

    public function __construct(ActualiteRepository $acturepo, AttachementRepository $attachrepo, ImagesEnteteRepository $imgenteterepo){

        $this->acturepo = $acturepo;
        $this->attachrepo = $attachrepo;
        $this->imgenteterepo = $imgenteterepo;
    }

    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualites()
    {
        $actualites = new Actualite();
        $actu = new Actualite();

        $attachements = $this->attachrepo->findAll();
        $attach = $this->attachrepo->find(15);
        dump($attach);

        $actualites = $this->acturepo->findBy(array(),  array('datePub' => 'DESC'));

         //affichage image en couveture
      $i = 0;
      
      $last_image = new ImagesEntete();
      $images = $this->imgenteterepo->findAll();

      foreach ($images as $cle => $img) {

        if ( $img->getLabelCouverture()->getLabel() == 'actualités' ) {
          $ity['$i'] = $img;
          dump($ity['$i']);
          $i = $i +1;
          dump($img);
        }
      }
      $i = $i - 1;
      $last_image = $ity['$i'];



        return $this->render('pages/actualites/actualites.html.twig',[

          'actualites' => $actualites,
          'attachements' => $attachements,
          'last_image' => $last_image
      ]);

    }

        /**
     * @Route("/liste_actualites", name="liste_actualites")
     */
        public function liste_actualites()
        {
            $actualites = new Actualite();
            $actu = new Actualite();

            $attachements = $this->attachrepo->findAll();
            $attach = $this->attachrepo->find(15);

            $actualites = $this->acturepo->findBy(array(),  array('datePub' => 'DESC'));


            return $this->render('pages/actualites/liste_actualites.html.twig',[

              'actualites' => $actualites,
              'attachements' => $attachements
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

                $actualite = $this->acturepo->find($id);

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

                $actualites = new Actualite();

                $actualites = $this->acturepo->findBy(array(),  array('datePub' => 'DESC'));

                return $this->render('pages/actualites/actualites.html.twig',[

                    'actualites' => $actualites
                ]);

            }

        }    

    }
