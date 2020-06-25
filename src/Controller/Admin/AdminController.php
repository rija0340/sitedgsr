<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{

    /**
     * @Route("/inscription", name="security.registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
      $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

       $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){

        $hash = $encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);

        $manager->persist($user);
        $manager->flush();

        $this->redirectToRoute('login');
      }

      return $this->render('admin/registration.html.twig', [
        'form' => $form->createView()
      ]);
    } 

      

    /**
     * @Route("/admin", name="admin.index")
     */
    public function index(){

            return $this->render('admin/index.html.twig'); 

        }


}
