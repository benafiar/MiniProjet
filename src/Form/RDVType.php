<?php

namespace App\Form;

use App\Entity\RDV;
use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RDVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('patients', EntityType::class ,[
                'class'=>Patient::class,
                'choice_label'=>'nom'
            ])
            ->add('nom_patient')
            ->add('date_RDV')
            ->add('heure_RDV')
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RDV::class,
        ]);
    }
}
