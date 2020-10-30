<?php

namespace App\Controller\Admin;

use App\Entity\Spot;
use App\Form\SpotType;
use App\Repository\SpotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/admin/spot")
     */
    class AdminSpotController extends AbstractController
    {

	/**
	 * @var spotRepository
	*/
	private $repository;

	public function __construct (SpotRepository $repository, EntityManagerInterface $em)
	{
		$this->repository = $repository;
		$this->em = $em;

	}

	 /**
     * @Route("/", name="admin.spot.index", methods={"GET"})
     */
     public function index(SpotRepository $spotRepo)
     {
       $spot = new Spot();

       $spot =  $spotRepo->findAll();

       return $this->render('admin/spot/index.html.twig', [
        'spot' => $spot,
    ]);
   }

    /**
  * @Route("/create", name="admin.spot.new")
  */
    public function new(Request $request){
        $spot = new Spot();
        $form = $this->createForm(SpotType::class, $spot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($spot);
            $this->addFlash('success', 'Spot créé avec succés');
            $this->em->flush();
            return $this->redirectToRoute('admin.spot.index');
        }

        return $this->render('admin/spot/new.html.twig',[

            'spot' => $spot,
            'form' => $form->createView()

        ]);

    }

    /**
     * @Route("/{id}", name ="admin.spot.edit", methods="GET|POST")
     * @param spots $spot
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Spot $spot, Request $request){

        $form = $this->createForm(spotType::class, $spot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
            $this->addFlash('success', 'Spot modifié avec succés');

            return $this->redirectToRoute('admin.spot.index');
        }
        return $this->render('admin/spot/edit.html.twig',[

            'spot' => $spot,
            'form' => $form->createView()

        ]);
    }
    /**
     * @Route("/admin/spot/{id}", name ="admin.spot.delete", methods="DELETE")
     */
    public function delete(Spot $spot, Request $request){

       if ($this->isCsrfTokenValid('delete' . $spot->getId(), $request->get('_token')  )) {
          $this->em->remove($spot);
          $this->em->flush();
          $this->addFlash('success', 'Directeur supprimé avec succés');
      }
      return $this->redirectToRoute('admin.spot.index');
  }
}
