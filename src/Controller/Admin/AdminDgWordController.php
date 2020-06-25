<?php

namespace App\Controller\Admin;

use App\Entity\DgWord;
use App\Form\DgWordType;
use App\Repository\DgWordRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/admin/dgword")
     */
    class AdminDgWordController extends AbstractController
    {
    	/**
     * @var repository
    */
        private $repository;

        public function __construct (DgWordRepository $repository, ObjectManager $em)
        {
            $this->repository = $repository;
            $this->em = $em;

        }

     /**
     * @Route("/", name="admin.dgword.index", methods={"GET"})
     */
     public function index()
     {
         $dgWord = new DgWord();

         $dgWord =  $this->repository->findAll();

         return $this->render('admin/dgword/index.html.twig', [
            'dgWord' => $dgWord,
        ]);
     }

    /**
  * @Route("/create", name="admin.dgword.new")
  */
    public function new(Request $request){
        $dgWord = new DgWord();
        $form = $this->createForm(DgWordType::class, $dgWord);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($dgWord);
            $this->addFlash('success', 'Mot du DG créé avec succés');
            $this->em->flush();
            return $this->redirectToRoute('admin.dgword.index');
        }

        return $this->render('admin/dgword/new.html.twig',[

            'dgWord' => $dgWord,
            'form' => $form->createView()

        ]);

    }

    /**
     * @Route("/{id}", name ="admin.dgword.edit", methods="GET|POST")
     * @param dgs $dgWord
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(DgWord $dgWord, Request $request){

        $form = $this->createForm(DgWordType::class, $dgWord);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
            $this->addFlash('success', 'Mot du DG modifié avec succés');

            return $this->redirectToRoute('admin.dgword.index');
        }
        return $this->render('admin/dgword/edit.html.twig',[

            'dgWord' => $dgWord,
            'form' => $form->createView()

        ]);
    }
    /**
     * @Route("/admin/dgword/{id}", name ="admin.dgword.delete", methods="DELETE")
     */
    public function delete(DgWord $dgWord, Request $request){

       if ($this->isCsrfTokenValid('delete' . $dgWord->getId(), $request->get('_token')  )) {
          $this->em->remove($dgWord);
          $this->em->flush();
          $this->addFlash('success', 'Mot supprimé avec succés');
      }
      return $this->redirectToRoute('admin.dgword.index');
  }
}
