<?php

namespace App\Form;

use App\Entity\Meet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('hostGoals')
            ->add('guestGoals')
            ->add('term')
            ->add('position')
            ->add('created')
            ->add('updated')
            ->add('hostTeam')
            ->add('guestTeam')
            ->add('matchday')
            ->add('league')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meet::class,
        ]);
    }
}
