<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Attachement;
use App\Entity\DgWord;
use App\Entity\Carousel;
use App\Entity\Spot;
use App\Repository\ActualiteRepository;
use App\Repository\DgWordRepository;
use App\Repository\SpotRepository;
use App\Repository\CarouselRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AttachementRepository;

class HomeController extends AbstractController
{

    private $spotRepo;
    private $dgwordRepo;
    private $actuRepo;

    public function __construct(SpotRepository $spotRepo, DgWordRepository $dgwordRepo, ActualiteRepository $actuRepo ,AttachementRepository $attachrepo, CarouselRepository $carouselRepo){

        $this->spotRepo = $spotRepo;
        $this->dgwordRepo = $dgwordRepo;
        $this->actuRepo = $actuRepo;
        $this->attachrepo = $attachrepo;
        $this->carouselRepo = $carouselRepo;



    }
    /**
     * @Route("/", name="index")
     */
    public function index( )
    {
        $spot = new Spot();
        $dgword = new DgWord();
        $actualites = new Actualite();
        $carousels = new Carousel();
        
        $spot = $this->spotRepo->find(1);
        // $dgword = $this->dgwordRepo->findOneBy(3);
        
        //on prend les 6 dernières actualités dans la base de données.
        $actualites = $this->actuRepo->findBy(array() , array('id' => 'DESC'), 6);

        
        //on prend les 3 dernières carousels dans la base de données.
        $carousels = $this->carouselRepo->findBy(array() , array('id' => 'DESC'), 6);

        
        $dgword = $this->dgwordRepo->findBy(array() , array('id' => 'DESC'), 1);
        $attachements = $this->attachrepo->findAll();

        $last_dgword = $dgword[0];

        $car1 = $carousels[0];
        $car2 = $carousels[1];
        $car3 = $carousels[2];

        return $this->render('pages/home/home.html.twig', [
            'spot' => $spot->getYoutubeLink(),
            'current_dg' =>  $last_dgword->getDg(),
            'last_dgword' =>  $last_dgword,
            'car1' => $car1,
            'car2' => $car2,
            'car3' => $car3, 
            'attachements' => $attachements,
            'actualites' => $actualites,
            // 'actu1_title' => $actu1->getTitle(),
            // 'actu2_title' => $actu2->getTitle(),
            // 'actu3_title' => $actu3->getTitle()

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
