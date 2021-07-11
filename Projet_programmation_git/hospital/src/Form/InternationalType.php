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
            ->add('nationalite')
            ->add('maladie')
            ->add('debut')
            ->add('financement')
            ->add('arrive')
            ->add('patient')
            ->add('personnel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => International::class,
        ]);
    }
}
