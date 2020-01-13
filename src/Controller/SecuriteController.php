<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface ;

class SecuriteController extends AbstractController
{

    private $entityManager;
    public function __construct(
        EntityManagerInterface $entityManager
        )
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/Inscription", name="securite")
     */
    public function registration(Request $request, 
     $manager, UserPasswordEncoderInterface $encoder)
    {
        $user=new User();
        $form=$this->createForm(InscriptionType::class,$user);
        $form->add('save', SubmitType::class);
        $form->handleRequest($request);
        
        

        if ($form->isSubmitted() && $form->isValid()) {
         $hash= $encoder->encodePassword($user,$user->getPassword());
         $user->setPassword($hash);
         $this->entityManager->persist( $user);
         $this->entityManager->flush();
         
         return $this->redirectToRoute('securiteLogin');
         }
        return $this->render('securite/registration.html.twig', [
            'form' => $form->createView()
            
        ]);
        }
      /**
     * 
     * 
     * @Route("/", name="securiteLogin")
     * 
     *  @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
    
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
    
        return $this->render('securite/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    /**
     * @Route("/Deconnexion", name="securite_logout")
     */
    public function logout() {}

    
}