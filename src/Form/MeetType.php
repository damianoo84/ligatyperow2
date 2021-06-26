<?php

namespace App\Form;

use App\Entity\League;
use App\Entity\Matchday;
use App\Entity\Meet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('hostTeam')
//            ->add('hostTeam', null, [
//                'query_builder' => function (EntityRepository $er) {
//                    return $er->createQueryBuilder('u')
//                        ->orderBy('u.name', 'ASC');
//                },])
            ->add('guestTeam')
            ->add('matchday', EntityType::class, [
                'class' => Matchday::class,
                'label' => 'kolejka'
            ])
            ->add('league', EntityType::class, [
                'class' => League::class,
                'label' => 'Liga'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meet::class,
        ]);
    }
}
