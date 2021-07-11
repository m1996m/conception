<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('dateNaissance')
            ->add('genre')
            ->add('telephone')
            ->add('profession')
            ->add('image')
            ->add('user')
            ->add('personnel')
            ->add('maternites')
            ->add('internationals')
            ->add('fichePatients')
            ->add('messages')
            ->add('consultations')
            ->add('rendezVouses')
            ->add('suivis')
            ->add('ordonnances')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
