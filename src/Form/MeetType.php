<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\League;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class MeetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('hostGoals')
                ->add('guestGoals')
                ->add('term')
                ->add('position')
                ->add('createdAt')
                ->add('updatedAt')
                ->add('hostTeam')
                ->add('guestTeam')
                ->add('matchday')
                ->add('league')
//                ->add('league', EntityType::class, array(
//                    'class' => 'AppBundle:League',
//                    'query_builder' => function (EntityRepository $er) {
//                            return $er->createQueryBuilder('l');
//                    },
//                    'choice_label' => 'league',
                ;
        
//        exit(\Doctrine\Common\Util\Debug::dump($builder));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Meet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_meet';
    }


}
