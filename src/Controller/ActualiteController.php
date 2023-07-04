<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\ImagesEntete;
use App\Repository\ActualiteRepository;
use App\Repository\AttachementRepository;
use App\Repository\ImagesEnteteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActualiteController extends AbstractController
{

    private $acturepo;
    private $attachrepo;
    private $attachement;

    public function __construct(ActualiteRepository $acturepo, AttachementRepository $attachrepo, ImagesEnteteRepository $imgenteterepo)
    {

        $this->acturepo = $acturepo;
        $this->attachrepo = $attachrepo;
        $this->imgenteterepo = $imgenteterepo;
    }
    /**
     * @Route("/actualites", name="actualites")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $actualites = new Actualite();
        $actu = new Actualite();

        $attachements = $this->attachrepo->findAll();
        $attach = $this->attachrepo->find(15);

        $actualites = $this->acturepo->findNotVideoOnly();

        //pagination
        $actualites = $paginator->paginate(
            $actualites, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            12 // Nombre de résultats par page
        );

        //affichage image en couveture
        $i = 0;

        $last_image = new ImagesEntete();
        $images = $this->imgenteterepo->findAll();

        foreach ($images as $cle => $img) {

            if ($img->getLabelCouverture()->getLabel() == 'actualités') {
                $ity['$i'] = $img;
                $i = $i + 1;
            }
        }
        $i = $i - 1;
        $last_image = $ity['$i'];

        return $this->render('pages/actualites/actualites.html.twig', [

            'actualites' => $actualites,
            'attachements' => $attachements,
            'last_image' => $last_image
        ]);
    }

    /**
     * @Route("/actualite/details/{id}", name="actualite_details")
     */
    public function show(Request $request, Actualite $actualite)
    {
        return $this->render('pages/actualites/details.html.twig', [
            'actualite' => $actualite,
            'actualites' => $this->acturepo->findAll()
        ]);
    }
}
