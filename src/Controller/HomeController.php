<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\DgWord;
use App\Entity\Spot;
use App\Repository\ActualiteRepository;
use App\Repository\DgWordRepository;
use App\Repository\SpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $spotRepo;
    private $dgwordRepo;
    private $actuRepo;

    public function __construct(SpotRepository $spotRepo, DgWordRepository $dgwordRepo, ActualiteRepository $actuRepo ){

        $this->spotRepo = $spotRepo;
        $this->dgwordRepo = $dgwordRepo;
        $this->actuRepo = $actuRepo;


    }
    /**
     * @Route("/", name="index")
     */
    public function index( )
    {
        $spot = new Spot();
        $dgword = new DgWord();
        $actualites = new Actualite();

        $spot = $this->spotRepo->find(1);
        // $dgword = $this->dgwordRepo->findOneBy(3);
        $actualites = $this->actuRepo->findBy(array() , array('datePub' => 'DESC'), 3);
        $dgword = $this->dgwordRepo->findBy(array() , array('id' => 'DESC'), 1);

        $last_dgword = $dgword[0];

        dump($last_dgword);

        $actu1 = $actualites[0];
        $actu2 = $actualites[1];
        $actu3 = $actualites[2];
     

        return $this->render('pages/home/home.html.twig', [
            'spot' => $spot->getYoutubeLink(),
            'current_dg' =>  $last_dgword->getDg(),
            'dgword' =>  $last_dgword,
            'actualite1' => $actu1,
            'actualite2' => $actu2,
            'actualite3' => $actu3, 

            'actu1_title' => $actu1->getTitle(),
            'actu2_title' => $actu2->getTitle(),
            'actu3_title' => $actu3->getTitle()

        ]);
    }

    /**
     * @Route("/dgword", name="dgword")
     */
    public function dgword(){


        $dgword = new DgWord();
        $dgword = $this->dgwordRepo->findBy(array() , array('id' => 'DESC'), 1);

        $last_dgword = $dgword[0];

        return $this->render('pages/home/dgword.html.twig', [

            'current_dg' =>  $last_dgword->getDg(),
            'last_dgword' => $last_dgword,
            
        ]);
    }
}
