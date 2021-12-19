<?php

namespace App\Controller\Admin;

use App\Classe\Mailjet;
use App\Classe\DateHelper;
use App\Entity\ResetPassword;
use App\Form\ResetPasswordType;
use App\Repository\ResetPasswordRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminChangePasswordController extends AbstractController
{

    private $dateHelper;
    private $mailjet;
    private $em;
    private $userRepo;
    private $resetPasswordRepo;
    private $passwordEncoder;


    public function __construct(UserPasswordEncoderInterface $passwordEncoder, ResetPasswordRepository $resetPasswordRepo, UserRepository $userRepo, EntityManagerInterface $em, Mailjet $mailjet, DateHelper $dateHelper)
    {
        $this->dateHelper = $dateHelper;
        $this->mailjet = $mailjet;
        $this->em = $em;
        $this->userRepo = $userRepo;
        $this->resetPasswordRepo = $resetPasswordRepo;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/changer-mot-de-passe", name="change_password")
     */
    public function index(Request $request): Response
    {
        //enregistrer en base la demande de resetpassowrd
        $resetpassword = new ResetPassword();

        $user = $this->userRepo->findOneBy(["email" => "dgsrsrp@gmail.com"]);
        $resetpassword->setUser($user);
        $resetpassword->setToken(uniqid());
        $resetpassword->setCreatedAt($this->dateHelper->dateNow());
        $this->em->persist($resetpassword);
        $this->em->flush();

        //envoyer un email a l'utilisateur avec nouveau mot de passe 

        $url = $this->generateUrl('update_password', [

            'token' => $resetpassword->getToken()
        ]);
        $this->mailjet->send("Merci de bien vouloir cliquer sur le lien suivant  <a href='" . $url . "'> pour mettre à jour votre mot de passe.</a>");

        return $this->render('admin/reset_password/index.html.twig');
    }


    /**
     * @Route("/modifier-mon-mot-de-passe-oublie/{token}", name="update_password")
     */
    public function update($token, Request $request)
    {

        $resetpassword = $this->resetPasswordRepo->findOneByToken($token);

        if (!$resetpassword) {
            return $this->redirectToRoute('reset_password');
        }

        //verifier si createdAt = now - 3h

        $now = $this->dateHelper->dateNow();

        if ($now >  $resetpassword->getCreatedAt()->modify('+ 3 hour')) {
            // $this->flashy->error("Votre demande de mot de passe a expiré. Merci de la renouveler");
            return $this->redirectToRoute('reset_password');
        }

        //rndre une vue avec mot de passe et confirmez 
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $new_password = $request->request->get('reset_password')['new_password']['first'];

            //encodage mot de passe 
            $password = $this->passwordEncoder->encodePassword($resetpassword->getUser(), $new_password);

            $resetpassword->getUser()->setPassword($password);
            //flush dd 
            $this->em->flush();

            $this->addFlash(
                'notice',
                'Le mot de passe a bien été modifié'
            );
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/reset_password/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
