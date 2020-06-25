<?php

namespace App\Controller\Admin;

use App\Entity\Organigramme;
use App\Form\OrganigrammeType;
use App\Repository\OrganigrammeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\JsonResponse;



/**
* @Route("/admin/org")
*/
class AdminOrganigrammeController extends AbstractController
{
/**
	 * @var repository
	*/
private $repository;

public function __construct (OrganigrammeRepository $repository, ObjectManager $em)
{
	$this->repository = $repository;
	$this->em = $em;

}

	 /**
     * @Route("/", name="admin.org.index", methods={"GET"})
     */
	 public function index()
	 {
	 	$org = new Organigramme();

	 	$org =  $this->repository->findAll();

	 	return $this->render('admin/organigramme/index.html.twig', [
	 		'org' => $org,
	 	]);
	 }

    /**
  * @Route("/create", name="admin.org.new")
  */
    public function new(Request $request){
    	$org = new Organigramme();
    	$form = $this->createForm(OrganigrammeType::class, $org);
    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
    		$this->em->persist($org);
    		$this->addFlash('success', 'Organigramme créé avec succés');
    		$this->em->flush();
    		return $this->redirectToRoute('admin.org.index');
    	}

    	return $this->render('admin/organigramme/new.html.twig',[

    		'org' => $org,
    		'form' => $form->createView()

    	]);

    }

    /**
     * @Route("/edit/{id}", name ="admin.org.edit", methods="GET|POST")
     * @param organigramme $org
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Organigramme $org, Request $request){

    	$form = $this->createForm(OrganigrammeType::class, $org);
    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {

    		$this->em->flush();
    		$this->addFlash('success', 'Organigramme modifié avec succés');

    		return $this->redirectToRoute('admin.org.index');
    	}
    	return $this->render('admin/organigramme/edit.html.twig',[

    		'org' => $org,
    		'form' => $form->createView()

    	]);
    }
    /**
     * @Route("/delete/{id}", name ="admin.org.delete", methods="DELETE" )
     * 
     */
    public function delete(Organigramme $org, Request $request){

        if($request->isXmlHttpRequest()) {

          if ($this->isCsrfTokenValid('delete' . $org->getId(), $request->request->get('_token')  )) {
            $this->em->remove($org);
            $this->em->flush();
            $this->addFlash('success', 'Organigramme supprimé avec succés');
            return $this->redirectToRoute('admin.spot.index');
          }

        } else {

            return $this->redirectToRoute('admin.spot.index');

        }

    }
  
  }
