<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription",name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager,UserPasswordEncoderInterface $encoder): Response{
        $user = new User();
        $form = $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('login_connexion');
        }
        return $this->render('security/registration.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/connexion", name="login_connexion")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(): Response{
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion",name="logout_connexion")
     */
    public function logout(){

    }
}
