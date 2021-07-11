<?php

namespace App\Form;

use App\Entity\FichePatient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FichePatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statut')
            ->add('idMaternite')
            ->add('idInternational')
            ->add('idUrgence')
            ->add('idPatient')
            ->add('idPersonnel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FichePatient::class,
        ]);
    }
}
