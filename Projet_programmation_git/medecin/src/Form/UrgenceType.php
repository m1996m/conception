<?php

namespace App\Form;

use App\Entity\Urgence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UrgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('financement')
            ->add('dateArrive')
            ->add('heure')
            ->add('suivi')
            ->add('profession')
            ->add('email')
            ->add('telephone')
            ->add('messages')
            ->add('idPersonnel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Urgence::class,
        ]);
    }
}
