<?php

namespace App\Controller;

use App\Entity\RDV;
use App\Form\RDVType;
use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\RDVRepository;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecretaireController extends AbstractController
{

    private $entityManager;
    public function __construct(
        EntityManagerInterface $entityManager
        )
    {
        $this->entityManager = $entityManager;
    }
/**
 *  @Route("/formPatient/{id}/delete", name="deletePatient")
*/ 
public function delete($id, Patient $patient=null, Request $request ,PatientRepository $repo) {

    if(!$patient){
        $patient=new Patient();
    }
    $patients=$repo->find($id);
  
    $this->entityManager->remove($patient);
    $this->entityManager->flush();
  
    return $this->redirectToRoute('formPatient');

}


    /**
         * @Route("/formPatient", name="formPatient")
         *  @Route("/formPatient/{id}/edit", name="editPatient")
         *  @Route("", name="search")  
     */
    public function formPatient(Patient $patient=null, Request $request ,PatientRepository $repo)
    {
        if(!$patient){
            $patient=new Patient();
        }
        $form=$this->createFormBuilder($patient)
        ->add('date_creation_fiche')
        ->add('cin')
        ->add('nom')
        ->add('prenom')
        ->add('adresse')
        ->add('profession')
        ->add('date_naissance')
        ->add('numero_telephone')
        ->add('save', SubmitType::class)
        ->getForm();
$form->handleRequest($request);


if ($form->isSubmitted() && $form->isValid()) {
    $this->entityManager->persist($patient);
    $this->entityManager->flush();
}

$patients=$repo->findAll();



////button rechercher
//$criter=$form->getData();
//$patients=$repo->searchPatient($criter);

        return $this->render('secretaire/formPatient.html.twig', [
            'formPatient' => $form->createView(),
            'patients'=> $patients,
            'patient'=> $patient,

        ]);
    }
    /**
        * @Route("/formRDV/deleterdv/{id}", name="deleteRDV")
    */ 
public function deleterdv($id, RDV $rdv=null, Request $request,RDVRepository $repo) {

    if(!$rdv){
        $rdv=new RDV();
    }
    $rdv=$repo->find($id);
  
    $this->entityManager->remove($rdv);
    $this->entityManager->flush();
  
    return $this->redirectToRoute('formRDV');


}


      /**
     * @Route("/formRDV", name="formRDV")
     * @Route("/formRDV/{id}/edit", name="editRDV")  
    
     */
    public function formRDV(Request $request, RDV $rdv=null ,RDVRepository $repo  )
    {
        if(!$rdv){
            $rdv=new RDV();
        }
       
       $form=$this->createForm(RDVType::class,$rdv);
       $form->add('save', SubmitType::class);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
        $x=$form->getData();
        $this->entityManager->persist($rdv);
        $this->entityManager->flush();

        
        }
       
       
        $rendez_vous=$repo->findAll();
        return $this->render('secretaire/formRDV.html.twig', [
            'formRDV' => $form->createView(),
            'rendez_vous'=> $rendez_vous,
            'rdv'=>$rdv
        ]);
    }



      /**
     * @Route("/page1", name="premier_page")
     
     */
    public function premierPage( )
    {
         
       
        return $this->render('secretaire/pg1.html.twig');
    }



    }

