<?php

namespace App\Command;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;

use SoapClient;

class CronCommand extends Command {

    private $container;
    private $logger;

    public function __construct(ContainerInterface $container, LoggerInterface $logger)
    {
        parent::__construct();
        $this->container = $container;
        $this->logger = $logger;
    }

    protected function configure() : void
    {
        $this->setName('app:przypominajka')
            ->setDescription('Przypomnienie o typowaniu');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        
        $matchdayObject = $em->getRepository('App:Matchday')->getMatchday();
        $this->logger->info('DC matchdayObject: ' . $matchdayObject);
        
        // pobranie listy numerów tel. użytkowników, którzy jeszcze nie wytypowali 
        $usersPhones = $em->getRepository('App:Type')->getNoTypedUsersList($matchdayObject['name']);

        $this->logger->info('DC $usersPhones: ' . $usersPhones);

        ini_set("soap.wsdl_cache_enabled", "0");
        $client = new \SoapClient("http://api.gsmservice.pl/soap/v2/gateway.php?wsdl");
        $arAccount = array("login" => "damcio","pass" => "gutek246");
        $arMessages = array(array(
            "recipients" => $usersPhones,
            "message" => "Przypomnienie o typowaniu",
//            "message" => "To jest test. Można zignorować lub potwierdzić że doszło. Można też dopisać: nie lubię Realu i CR7 :) ",
            "sender"=> "Damian",
            "msgType" => 1,
            "unicode" => false,
            "sandbox" => false
        ));

        $this->logger->info('DC before send sms message');

        // wysłanie smsów o ustalonym w CRON terminie
        $client->SendSMS(array("account" => $arAccount,"messages"=> $arMessages))->return;

        $this->logger->info('DC after send sms message');
    }    
}