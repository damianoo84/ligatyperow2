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
            ->add('username' , null, ['label' => 'Imię'])
            ->add('shortname' , null, ['label' => 'Skrót'])
            ->add('email' , null, ['label' => 'Email'])
            ->add('password' , null, ['label' => 'Hasło'])
            ->add('phone' , null, ['label' => 'Telefon'])
            ->add('numberOfWins' , null, ['label' => 'Ilość wygranych'])
            ->add('status' , null, ['label' => 'Status'])
            ->add('priority' , null, ['label' => 'Priorytet'])
            ->add('rankingPosition' , null, ['label' => 'Pozycja w rankingu'])
            ->add('maxPointsPerQueue' , null, ['label' => 'Maksymalna liczba punktów na kolejkę'])
            ->add('minPointsPerQueue' , null, ['label' => 'Minimalna liczba punktów na kolejkę'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
