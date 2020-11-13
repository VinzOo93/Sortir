<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\EditUserType;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param AppAuthenticator $authenticator
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppAuthenticator $authenticator): Response
    {


        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/showUser/{id}", name="show_user")
     * requirements={"id","\d+"}
     * methods={"GET"})
     */
    public function showUser(): Response
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $user = $this->getUser();


        $this->getDoctrine()->getRepository(User::class);
        $data_user = $user;


            return $this->render('profile/showUser.html.twig',[
                'data_user' => $data_user->getId()
            ]);
    }

    /**
     * @Route("/update/{id}", name="update",
     * requirements={"id","\d+"},
     * methods={"GET","POST"})
     * @param User $user
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */

    public function update(User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();

            // Si l'ancien mot de passe est bon

            if (password_verify($form->get("oldPassword")->getData(), $user->getPassword())){

                $newEncodedPassword = $passwordEncoder->encodePassword($user, $form->get("plainPassword")->getData());

                $user->setPassword($newEncodedPassword);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success','Utilisateur modifié avec succès');

            return $this->redirectToRoute('sortie');
        }

        return $this->render('profile/updateUser.html.twig',[
           'userForm'=> $form->createView(),
        ]);
    }
}
