<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;


class ChangePasswordType extends AbstractType {
    
    public function getName() {
        return 'changePassword';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('currentPassword', 'password', array(
                'label' => 'Aktualne hasło',
                'mapped' => false,
                'constraints' => array(
                    new UserPassword(array(
                        'message' => 'Podano błędne aktualne hasło użytkownika'
                    ))
                )
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options' => array(
                    'label' => 'Nowe hasło'
                ),
                'second_options' => array(
                    'label' => 'Powtórz hasło'
                )
            ))
            ->add('submit', 'submit', array(
                'label' => 'Zmień hasło'
            ));
    }
    
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'validation_groups' => array('Default', 'ChangePassword')
        ));
    }

}