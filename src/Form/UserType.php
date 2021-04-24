<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('phone')
            ->add('numberOfWins')
            ->add('status')
            ->add('priority')
            ->add('lastActivityAt')
            ->add('rankingPosition')
            ->add('maxPointsPerQueue')
            ->add('minPointsPerQueue')
            ->add('created')
            ->add('updated')
            ->add('username')
            ->add('shortname')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
