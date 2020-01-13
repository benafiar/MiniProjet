<?php

namespace App\Controller;

use App\Entity\Ordonnance;
use App\Entity\Consultation;
use App\Form\OrdonnanceType;
use App\Form\ConsultationType;
use App\Repository\OrdonnanceRepository;
use App\Repository\ConsultationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class MedecinController extends AbstractController
{
    private $entityManager;
    public function __construct(
        EntityManagerInterface $entityManager
        )
    {
        $this->entityManager = $entityManager;
    }
    /**
        * @Route("/formOrdonnance/deleteOrd/{id}", name="deleteConsultation")
    */ 
    public function deleteConsul($id,  Consultation $consultation=null , Request $request ,ConsultationRepository $repo) {

        if(!$consultation){
            $consultation=new Consultation();
        }
        $consultation=$repo->find($id);
    
        $this->entityManager->remove($consultation);
        $this->entityManager->flush();
    
            return $this->redirectToRoute('form_consultation');
    }

    /**
     * @Route("/medecin/formConsultation", name="form_consultation")
     * @Route("/formConsultation/{id}/edit", name="editConsultation")
     */
    public function formConsultation(Request $request, Consultation $consultation=null, ConsultationRepository $repo)
    {
        if(!$consultation){
            $consultation=new Consultation();
        }
        $form=$this->createForm(ConsultationType::class,$consultation);
        $form->add('save', SubmitType::class);
        $form->handleRequest($request);
        
       if ($form->isSubmitted() && $form->isValid()) {
        $x=$form->getData();
        $this->entityManager->persist($consultation);
        $this->entityManager->flush();
        }
        $consultation=$repo->findAll();
        return $this->render('medecin/formConsultation.html.twig', [
            'formConsultation' => $form->createView(),
            'consultation'=> $consultation
        ]);
    }


    /**
     * @Route("/medecin/formOrdonnance", name="form_ordonnance")
     * @Route("/formOrdonnance/{id}/edit", name="editOrdonnance")
     */
    public function formOrdonnance(Request $request, Ordonnance $ordonnance=null,OrdonnanceRepository $repo )
    {
        if(!$ordonnance){
            $ordonnance=new Ordonnance();
        }
        $form=$this->createForm(OrdonnanceType::class,$ordonnance);
        $form->add('save', SubmitType::class);
        $form->handleRequest($request);
        
       if ($form->isSubmitted() && $form->isValid()) {
        $x=$form->getData();
        $this->entityManagerr->persist($ordonnance);
        $this->entityManager->flush();
        }
        $ordonnance=$repo->findAll();
        
        return $this->render('medecin/formOrdonnance.html.twig', [
            'formOrdonnance' => $form->createView(),
            'ordonnance'=> $ordonnance
        ]);
    }

     /**
        * @Route("/formOrdonnance/{id}/deleteOrd/", name="deleteOrdonnance")
    */ 
    public function deleteOrd($id,  Ordonnance $ordonnance=null , Request $request ,OrdonnanceRepository $repo) {

        if(!$ordonnance){
            $ordonnance=new Ordonnance();
        }
        $ordonnance=$repo->find($id);
    
        $this->entityManager->remove($ordonnance);
        $this->entityManager->flush();
    
        return $this->redirectToRoute('form_ordonnance');

    }
}
