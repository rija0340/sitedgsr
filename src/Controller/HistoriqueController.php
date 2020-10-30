<?php

namespace App\Controller;

use App\Entity\ImagesEntete;
use App\Repository\DGRepository;
use App\Repository\ImagesEnteteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
      
    private $dgwordRepo;
    private $repo;

    public function __construct(DGRepository $repo, ImagesEnteteRepository $imgenteterepo ){

        $this->imgenteterepo = $imgenteterepo;
        $this->repo = $repo;

    }

      /**
     * @Route("/historique", name="historique")
     */
    public function historique()
    {

        $i = 0;
        $image = new ImagesEntete();
        $last_image = new ImagesEntete();

        // $image = $this->imgenteterepo->findBy([ 'labelCouverture' => 'historique'], array('id' => 'DESC'), 1);
        // $image = $this->imgenteterepo->findBy(array('LabelCouverture'=>'historique') , array('id' => 'DESC'), 1);

        $images = $this->imgenteterepo->findAll();

        dump($images);

        foreach ($images as $cle => $img) {

            // echo $img->getLabelCouverture()->getLabel();
            // echo '[' . $cle . '] vaut ' . $img . '<br />';

            if ( $img->getLabelCouverture()->getLabel() == 'historique' ) {
                $ity['$i'] = $img;
                dump($ity['$i']);
                $i = $i +1;

                dump($img);
            }
            
            
        }

        // var_dump($image[0]);
        
        // $labelName = $image[0]->getLabelCouverture()->getLabel();

         

        $last_image = $ity['$i'];

        $directors = $this->repo->findAll(); 
        return $this->render('pages/historique/historique.html.twig', [
            'directors' => $directors,
            'last_image' =>  $last_image

        ]);
    }  
}
