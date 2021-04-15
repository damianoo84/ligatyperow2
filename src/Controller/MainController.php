<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Entity\Type;
use App\Entity\Comment;
use App\Entity\Season;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\ChangePasswordType;
use App\Exception\UserException;
use App\Twig\AppExtension;
use Psr\Log\LoggerInterface;
use App\Service\TypeService;
use App\Service\HistoryService;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController{

    /**
     * @Route(
     *      "/",
     *      name = "liga_typerow_index"
     * )
     * @Template()
     */
    public function indexAction(){
        
        return array();
    }

    /**
     * @Route(
     *      "/tabela",
     *      name = "liga_typerow_table"
     * )
     * @Template()
     * @param AppExtension $appExtension
     * @return array
     */
    public function tableAction(LoggerInterface $logger, TypeService $typeService){

        $logger->info('this is the table action');
        $points = $typeService->getPointsPerMatchday();
        return array('points' => $points);
    }
    
    /**
     * @Route(
     *      "/wszystkietypy/{matchday}",
     *      name = "liga_typerow_userstypes",
     *      requirements={"matchday": "\d+"},
     * )
     * @Template()
     */
    public function userstypesAction(LoggerInterface $logger, Request $request, TypeService $typeService){
        
        $logger->info('this is the userstypes action');
        $types = $typeService->getUsersTypes($request);
        return array('types' => $types);
    }

    /**
     * @Route(
     *      "/ranking",
     *      name = "liga_typerow_ranking"
     * )
     * @Template()
     */
    public function rankingAction(LoggerInterface $logger, TypeService $typeService){

        $logger->info('this is the ranking action');
        $ranks = $typeService->getRanking();
        return array('ranks' => $ranks);
    }

    /**
     * @Route(
     *      "/historia/{season}",
     *      name = "liga_typerow_history"
     * )
     * @Template()
     */
    public function historyAction(LoggerInterface $logger, HistoryService $historyService, Request $request){

        $logger->info('this is the history action');
        $history = $historyService->getHistory($request);
        return array('points' => $history);
    }

    /**
     * @Route(
     *      "/typy",
     *      name = "liga_typerow_types"
     * )
     * @Template()
     * 
     */
    public function typesAction(Request $request, LoggerInterface $logger, TypeService $typeService){
        
        $logger->info('this is the types action');
        $types = $typeService->getUserTypes($this->getUser()->getId());

        $isTyped = false;
        if (count($types) != 0) {
            $isTyped = true;
        }

        if ($isTyped) {
            return array('types' => $types);
        }

        $meets = $typeService->getMeets();

        if ($request->getMethod() == 'POST') {
            $request->isXmlHttpRequest();
            $typeService->getMeetsPerMatchday($request, $this->getUser());
            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        return array('meets' => $meets);
    }

    /**
     * @Route(
     *      "/statystyki",
     *      name = "liga_typerow_statistics"
     * )
     * @Template()
     */
    public function statisticsAction(LoggerInterface $logger){

        $logger->info('this is the statistics action');
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $stats = $repository->getStatistics();
        
        return array('stats' => $stats);
    }

    /**
     * @Route(
     *      "/zasady",
     *      name = "liga_typerow_principles"
     * )
     * @Template()
     */
    public function principlesAction(LoggerInterface $logger){

        $logger->info('this is the principles action');
        $principles = array(
            'Liga trwa 15 kolejnych tygodni.', 'W każdym tygodniu typujemy 10 wybranych meczy, które odbędą się w tygodniu następnym. '
            , 'Czas na typy to 7 dni liczony od poniedziałku '
            . 'godz.00:00 do niedzieli godz. 23:59',
            'Za prawidłowe wytypowanie rozstrzygnięcia meczu otrzymuje się 2 pkt. '
            . 'Za prawidłowe wytypowanie wyniku bramkowego otrzymuje się 4 pkt.',
            'Jeżeli w meczu dojdzie do dogrywki lub rzutów karnych to liczy się '
            . 'wynik meczu regulaminowych 90 minut.',
            'Jeżeli mecz niezostanie rozegrany w danej kolejce lub przerwany (i nie dokończony) '
            . 'lub zostanie uznany jako walkower, wtedy typy na ten mecz zostają anulowane.',
            'Jeżeli zwycięzcą po 15 kolejkach okażą się dwie lub więcej osób, '
            . 'które będą miały taką samą ilość punktów to zostanie przeprowadzona dogrywka między nimi.'
        );
        
        return array('principles' => $principles);
    }
    
    /**
     * @Route(
     *      "/rekordy",
     *      name = "liga_typerow_records"
     * )
     * @Template()
     */
    public function recordsAction(LoggerInterface $logger){

        $logger->info('this is the records action');
        $records = array(
            'Najwięcej punktów w jednej kolejce' => '26 - Piotrek 1(2x),Krystian,Kuba,Wojtek,Przemek 2',
            'Najwięcej punktów w sezonie' => '224 - Łukasz',
            'Największa przewaga punktowa zwycięzcy' => '18 - Piotrek 3',
            'Najwięcej trafionych meczy za 2 punkty' => '82 - Marcin',
            'Najwięcej trafionych meczy za 4 punkty' => '28 - Piotrek 3',
            'Najwięcej trafionych meczy w sumie w jednym sezonie' => '93 - Łukasz'
        );
        
        return array('records' => $records);
    }

    /**
     * @Route(
     *      "/forum",
     *      name = "liga_typerow_forum"
     * )
     * @Template()
     */
    public function forumAction(Request $request, AppExtension $appExtension, LoggerInterface $logger){

        $logger->info('this is the forum action');
        $matchday = $appExtension->getCurrentMatchday();

        $repoSeason = $this->getDoctrine()->getRepository(Season::class);
        $lastSeasonId = $repoSeason->getLastSeason();
            
        if(isset($matchday)){
            $matchday['season_id'] = $lastSeasonId;
        }
        
        $repoComment = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repoComment->getCommentsBySeason($matchday['season_id']);
        
        if ($request->getMethod() == 'POST') {
            
            if($request->request->get('user_comment') != null && $request->request->get('user_comment') != ''){
                
                $season = $repoSeason->findOneById($request->request->get('season_id'));
                
                $comment = new Comment();
                $comment->setUser($this->getUser());
                $comment->setSeason($season);
                $comment->setText(
                            htmlspecialchars(
                            stripslashes(
                            trim(
                            strip_tags($request->request->get('user_comment'))))));
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();     
            }

            return $this->redirect($this->generateUrl('liga_typerow_forum'));
        }
        
        return array('comments' => $comments, 'matchday' => $matchday);
    }
    
    /**
     * @Route(
     *      "/konto",
     *      name = "liga_typerow_account"
     * )
     * 
     * @Template()
     */
    public function accountSettingsAction(Request $Request, LoggerInterface $logger)
    {
        $logger->info('this is the account action');
        $User = $this->getUser();
        
        // Change Password
        $changePasswdForm = $this->createForm(new ChangePasswordType(), $User);
        
        if($Request->isMethod('POST') && $Request->request->has('changePassword')){
            $changePasswdForm->handleRequest($Request);
            
            if($changePasswdForm->isValid()){
                
                try {
                    $userManager = $this->get('user_manager');
                    $userManager->changePassword($User);

                    $this->get('session')->getFlashBag()->add('success', 'Twoje hasło zostało zmienione!');
                    return $this->redirect($this->generateUrl('liga_typerow_account'));
                    
                } catch (UserException $ex) {
                    $this->get('session')->getFlashBag()->add('error', $ex->getMessage());
                }
                
            }else{
                $this->get('session')->getFlashBag()->add('error', 'Popraw błędy formularza2!');
            }
        }
        
        
        return array(
            'user' => $User,
            'changePasswdForm' => $changePasswdForm->createView()
        );
    }
    
}