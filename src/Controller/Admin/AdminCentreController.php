<?php

namespace App\Controller\Admin;

use App\Entity\Centre;
use App\Entity\Faritany;
use App\Form\CentreType;
use App\Form\RegistrationType;
use App\Repository\CentreRepository;
use App\Repository\FaritanyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



 /**
 * @Route("/admin/centre")
 */
 class AdminCentreController extends AbstractController
 {
	/**
	 * @var CentreRepository
	 */
	private $repository;
	private $faritanyRepo;

	public function __construct (CentreRepository $repository, FaritanyRepository $faritanyRepo,  ObjectManager $em)
	{
		$this->repository = $repository;
		$this->faritanyRepo = $faritanyRepo;
		$this->em = $em;

	}

	 /**
     * @Route("/", name="admin.centre.index", methods={"GET"})
     */
	 public function index() {

	 	$centre = new Centre();
	 	$faritany = new Faritany();

	 	$centre = $this->repository->findAll();
	 	$faritany = $this->faritanyRepo->findAll();

	 	return $this->render('admin/centre/index.html.twig', [
	 		'centres' => $centre,
	 		'faritany' => $faritany,
	 	]);
	 }

	/**
  * @Route("/create", name="admin.centre.new")
  */
	public function new(Request $request){
		$centre = new Centre();
		$form = $this->createForm(CentreType::class, $centre);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->em->persist($centre);
			$this->addFlash('success', 'Centre créé avec succés');
			$this->em->flush();
			return $this->redirectToRoute('admin.centre.index');
		}

		return $this->render('admin/centre/new.html.twig',[

			'centre' => $centre,
			'form' => $form->createView()

		]);

	}

	/**
	 * @Route("/{id}", name ="admin.centre.edit", methods="GET|POST")
	 * @param Centre $centre
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(Centre $centre, Request $request){
		
		$form = $this->createForm(CentreType::class, $centre);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$this->em->flush();
			$this->addFlash('success', 'Centre modifié avec succés');

			return $this->redirectToRoute('admin.centre.index');
		}
		return $this->render('admin/centre/edit.html.twig',[

			'centre' => $centre,
			'form' => $form->createView()

		]);
	}
	/**
	 * @Route("/{id}", name ="admin.centre.delete", methods="DELETE")
	 */
	public function delete(Centre $centre, Request $request){

		if ($this->isCsrfTokenValid('delete' . $centre->getId(), $request->get('_token')  )) {
			$this->em->remove($centre);
			$this->em->flush();
			$this->addFlash('success', 'Centre supprimé avec succés');
		}
		return $this->redirectToRoute('admin.centre.index');
	}


}
