<?php

namespace App\Controller\Admin;

use App\Repository\VilleRepository;
use App\Repository\FaritanyRepository;
use App\Entity\Ville;
use App\Form\VilleType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

 /**
 * @Route("/admin/ville")
 */
class AdminVilleController extends AbstractController
{
	/**
	 * @var VilleRepository
	 */
	private $repository;

	public function __construct (VilleRepository $repository, FaritanyRepository $faritanyRepo, ObjectManager $em)
	{
		$this->repository = $repository;
		$this->faritanyRepo = $faritanyRepo;
		$this->em = $em;

	}

	 /**
     * @Route("/", name="admin.ville.index", methods={"GET"})
     */
	 public function index() {

	 	$ville = new Ville();

	 	$ville = $this->repository->findAll();
	 	$faritany = $this->faritanyRepo->findAll();

	 	return $this->render('admin/ville/index.html.twig', [
	 		'villes' => $ville,
	 		'faritany' => $faritany
	 	]);
	 }

	/**
  * @Route("/create", name="admin.ville.new")
  */
	public function new(Request $request){
		$ville = new Ville();
		$form = $this->createForm(VilleType::class, $ville);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->em->persist($ville);
			$this->addFlash('success', 'Ville créé avec succés');
			$this->em->flush();
			return $this->redirectToRoute('admin.ville.index');
		}

		return $this->render('admin/ville/new.html.twig',[

			'ville' => $ville,
			'form' => $form->createView()

		]);

	}

	/**
	 * @Route("/{id}", name ="admin.ville.edit", methods="GET|POST")
	 * @param Ville $ville
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Ville $ville, Request $request){
		
		$form = $this->createForm(VilleType::class, $ville);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$this->em->flush();
			$this->addFlash('success', 'Ville modifié avec succés');

			return $this->redirectToRoute('admin.ville.index');
		}
		return $this->render('admin/ville/edit.html.twig',[

			'ville' => $ville,
			'form' => $form->createView()

		]);
	}
	/**
	 * @Route("/{id}", name ="admin.ville.delete", methods="DELETE")
	 */
	public function delete(Ville $ville, Request $request){

		if ($this->isCsrfTokenValid('delete' . $dg->getId(), $request->get('_token')  )) {
			$this->em->remove($ville);
			$this->em->flush();
			$this->addFlash('success', 'Ville supprimé avec succés');
		}
		return $this->redirectToRoute('admin.ville.index');
	}


}
