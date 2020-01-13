<?php

namespace App\Form;

use App\Entity\Patient;
use App\Entity\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patients', EntityType::class ,[
                'class'=>Patient::class,
                'choice_label'=>'cin'
            ])
            ->add('nom_medecin')
            ->add('prenom_medecin')
            ->add('taille')
            ->add('tension')
            ->add('temperature')
            ->add('examen')
            ->add('conclusion')
            ->add('groupe_sanguin')
            ->add('poid')
            
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
            
        ]);
    }
}
