<?php 


namespace App\Controller\Admin;
use App\Entity\DG;
use App\Repository\DGRepository;
use App\Form\DGType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



 /**
 * @Route("/admin/dg")
 */
 class AdminDGController extends AbstractController
 {

	/**
	 * @var DGRepository
	 */
	private $repository;

	public function __construct (DGRepository $repository, EntityManagerInterface $em)
	{
		$this->repository = $repository;
		$this->em = $em;

	}


	 /**
     * @Route("/", name="admin.dg.index", methods={"GET"})
     */
	 public function index(DGRepository $dirRepo) {

	 	$dg = new DG();

	 	$dg = $dirRepo->findAll();

	 	return $this->render('admin/DG/index.html.twig', [
	 		'dg' => $dg
	 	]);
	 }

	/**
  * @Route("/create", name="admin.dg.new")
  */
	public function new(Request $request){
		$dg = new DG();
		$form = $this->createForm(DGType::class, $dg);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->em->persist($dg);
			$this->addFlash('success', 'Directeur créé avec succés');
			$this->em->flush();
			return $this->redirectToRoute('admin.dg.index');
		}

		return $this->render('admin/dg/new.html.twig',[

			'dg' => $dg,
			'form' => $form->createView()

		]);

	}

	/**
	 * @Route("/{id}", name ="admin.dg.edit", methods="GET|POST")
	 * @param DGs $DG
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit(DG $dg, Request $request){
		
		$form = $this->createForm(DGType::class, $dg);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$this->em->flush();
			$this->addFlash('success', 'Directeur modifié avec succés');

			return $this->redirectToRoute('admin.dg.index');
		}
		return $this->render('admin/dg/edit.html.twig',[

			'DG' => $dg,
			'form' => $form->createView()

		]);
	}
	/**
	 * @Route("/{id}", name ="admin.dg.delete", methods="DELETE")
	 */
	public function delete(DG $dg, Request $request){

		if ($this->isCsrfTokenValid('delete' . $dg->getId(), $request->get('_token')  )) {
			$this->em->remove($dg);
			$this->em->flush();
			$this->addFlash('success', 'Directeur supprimé avec succés');
		}
		return $this->redirectToRoute('admin.dg.index');
	}

}




















?>

