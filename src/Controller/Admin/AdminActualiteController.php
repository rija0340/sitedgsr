<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



 /**
 * @Route("/admin/actualite")
 */
 class AdminActualiteController extends AbstractController
 {
	/**
	 * @var repository
	 */
	private $repository;

	public function __construct (ActualiteRepository $repository,  ObjectManager $em)
	{
		$this->repository = $repository;
		$this->em = $em;

	}

	 /**
     * @Route("/", name="admin.actualite.index", methods={"GET"})
     */
	 public function index() {

	 	$actualite = new actualite();

	 	$actualite = $this->repository->findBy(array(),   array('id' => 'DESC'));

	 	return $this->render('admin/actualite/index.html.twig', [
	 		'actualites' => $actualite,
	 	]);
	 }

	/**
  * @Route("/create", name="admin.actualite.new")
  */
	public function new(Request $request){
		$actualite = new actualite();
		$form = $this->createForm(ActualiteType::class, $actualite);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->em->persist($actualite);
			$this->addFlash('success', 'Actualité créé avec succés');
			$this->em->flush();
			return $this->redirectToRoute('admin.actualite.index');
		}

		return $this->render('admin/actualite/new.html.twig',[

			'actualite' => $actualite,
			'form' => $form->createView()

		]);

	}

	/**
	 * @Route("/{id}", name ="admin.actualite.edit", methods="GET|POST")
	 * @param Actualite $actualite
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(actualite $actualite, Request $request){
		
		$form = $this->createForm(actualiteType::class, $actualite);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$this->em->flush();
			$this->addFlash('success', 'Actualite modifié avec succés');

			return $this->redirectToRoute('admin.actualite.index');
		}
		return $this->render('admin/actualite/edit.html.twig',[

			'actualite' => $actualite,
			'form' => $form->createView()

		]);
	}
	/**
	 * @Route("/{id}", name ="admin.actualite.delete", methods="DELETE")
	 */
	public function delete(Actualite $actualite, Request $request){

		if ($this->isCsrfTokenValid('delete' . $actualite->getId(), $request->get('_token')  )) {
			$this->em->remove($actualite);
			$this->em->flush();
			die('efa ato e');
			$this->addFlash('success', 'Actualite supprimé avec succés');
		}
		return $this->redirectToRoute('admin.actualite.index');
	}


}
