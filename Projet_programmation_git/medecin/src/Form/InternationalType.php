<?php

namespace App\Form;

use App\Entity\International;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternationalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('genre')
            ->add('dateNaissance')
            ->add('adresse')
            ->add('telephone')
            ->add('nationalite')
            ->add('maladie')
            ->add('debutMaladie')
            ->add('financement')
            ->add('dateArrve')
            ->add('messages')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => International::class,
        ]);
    }
}
