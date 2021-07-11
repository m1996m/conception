<?php

namespace App\Form;

use App\Entity\FicheSuivi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheSuiviType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenu')
            ->add('createdAt')
            ->add('idPatient')
            ->add('idMaternite')
            ->add('idIternational')
            ->add('idUrgence')
            ->add('idPersonnel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FicheSuivi::class,
        ]);
    }
}
