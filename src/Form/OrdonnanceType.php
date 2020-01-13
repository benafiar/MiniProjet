<?php

namespace App\Form;

use App\Entity\Ordonnance;
use App\Entity\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdonnanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('Nom_Medicament')
            ->add('Dosa_Medicament')
            ->add('Quantite_Medicament')
            ->add('Pasologie_medicament')
            ->add('consultation', EntityType::class ,[
                'class'=>Consultation::class,
                'choice_label'=>'patients'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ordonnance::class,
        ]);
    }
}
