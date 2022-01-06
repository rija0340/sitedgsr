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

use Symfony\Component\HttpFoundation\Request; // Nous avons besoin d'accéder à la requête pour obtenir le numéro de page
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\Actualite as EntityActualite;

class ActualitesController extends AbstractController
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
  public function actualites(Request $request, PaginatorInterface $paginator)
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
   * @Route("/actualites_liste", name="actualites_liste")
   */
  public function actualites_liste(Request $request, PaginatorInterface $paginator)
  {

    $actualites = new Actualite();
    $actu = new Actualite();

    $attachements = $this->attachrepo->findAll();
    $actualites = $this->acturepo->findBy(array(),  array('datePub' => 'DESC'));
    $attach = $this->attachrepo->find(15);

    //pagination
    $actualites = $paginator->paginate(
      $actualites, // Requête contenant les données à paginer (ici nos articles)
      $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
      9 // Nombre de résultats par page
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

    return $this->render('pages/actualites/liste_actualites.html.twig', [
      'actualites' => $actualites,
      'attachements' => $attachements,
      'last_image' => $last_image,
    ]);
  }

  // quant on appuye sur le bouton voir dans actualité, l/url le chargement de page est bloqué par le js, le controlleur va cherhcer les données dans la base de données et les transmet au js qui va se charger de passer les données à la vue

  /**
   * @Route("/actualite/{id}", name="actualite.show", methods = {"GET"})
   * @param Actualite actualite
   * 
   */
  public function show(int $id, Actualite $actualite,   Request $request)
  {

    $attachement = array();
    $i = 0;

    if ($request->isXmlHttpRequest()) {

      $actualite = $this->acturepo->find($id);

      $att = $actualite->getAttachements();

      foreach ($att as $att) {

        $attachement[$i] = $att->getImage();
        $i = $i + 1;
      }


      $response = new Response(json_encode(array(

        'titre' => $actualite->getTitle(),
        'contenu' => $actualite->getContent(),
        'img' => $actualite->getFilename(),
        'img' => $actualite->getFilename(),
        'url_video' => $actualite->getUrlVideo(),
        'datepub' => $actualite->getDatePub(),
        'attachement' => $attachement //array et un tablea 


      )));

      $response->headers->set('Content-Type', 'application/json');

      return $response; //cette reponse va être recu par ajax et celui puis donnée à la vue

    } else {

      $actualites = new Actualite();

      $actualites = $this->acturepo->findBy(array(),  array('datePub' => 'DESC'));

      return $this->render('pages/actualites/actualites.html.twig', [

        'actualites' => $actualites
      ]);
    }
  }

  /**
   * @Route("/details-actualite/{id}", name="actualite_details")
   */
  public function details_actualite(Request $request, Actualite $actualite)
  {
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

    // dd(str_word_count($actualite->getContent()));
    return $this->render('pages/actualites/details.html.twig', [
      'actualite' => $actualite,
      'actualites' => $this->acturepo->findNotVideoOnly(),
      'last_image' => $last_image,

    ]);
  }
}
