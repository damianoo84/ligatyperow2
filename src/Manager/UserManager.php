<?php

namespace App\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use App\Entity\User;
use App\Exception\UserException;

class UserManager {
    
    /**
     * @var Doctrine
     */
    protected $doctrine;
        
    
    /**
     * @var EncoderFactory
     */
    protected $encoderFactory;
    
    
    function __construct(Doctrine $doctrine, EncoderFactory $encoderFactory) {
        $this->doctrine = $doctrine;
        $this->encoderFactory = $encoderFactory;
    }
    
    
    public function changePassword(User $User){
        
        if(null == $User->getPlainPassword()){
            throw new UserException('Nie ustawiono nowego hasła!');
        }

        $encoder = $this->encoderFactory->getEncoder($User);
        $encoderPassword = $encoder->encodePassword($User->getPlainPassword(), $User->getSalt());
        $User->setPassword($encoderPassword);

        $em = $this->doctrine->getManager();
        $em->persist($User);
        $em->flush();

        return true;
    }
}
