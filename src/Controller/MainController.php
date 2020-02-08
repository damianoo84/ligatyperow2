<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Entity\Type;
use App\Entity\Meet;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\History;
use App\Entity\Season;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Form\ChangePasswordType;
use App\Exception\UserException;
use App\Twig\AppExtension;

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
    public function tableAction(AppExtension $appExtension){

        $matchday = $appExtension->getCurrentMatchday();

        $repository = $this->getDoctrine()->getRepository(Type::class);
        $points = $repository->getPointsPerMatchday(1);

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
    public function userstypesAction(Request $request, AppExtension $appExtension){
        
        $matchdayRepo = $appExtension->getMatchdayByName($request->get('matchday'));
        
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $types = $repository->getUsersTypes($matchdayRepo->getName(), $matchdayRepo->getSeason()->getId());
        
        return array('types' => $types);
    }
    
    /**
     * @Route(
     *      "/typy",
     *      name = "liga_typerow_types"
     * )
     * @Template()
     * 
     */
    public function typesAction(Request $request){
        
        $matchday = $this->get('app.twig_extension')->getCurrentMatchday();
        
        $repoType = $this->getDoctrine()->getRepository(Type::class);
        $types = $repoType->getUserTypes($matchday['id'], $this->getUser()->getId());
        
        $isTyped = false;
        if(count($types) != 0){
            $isTyped = true;
        }
        
        if($isTyped){
            return array('types' => $types);
        }
        
        $repository = $this->getDoctrine()->getRepository(Meet::class);
        $meets = $repository->getMeetsPerMatchday($matchday['id']);
        
        if ($request->getMethod() == 'POST') {
            
            $request = $this->getRequest();
            $req = $request->request->all();
            
            $data = array();
            $counter = count(current($req));
            foreach (array_keys($req) as $key) {
                for($i=0; $i<$counter; $i++) {
                    $data[$i][$key] = $req[$key][$i];
                }
            }
            
            foreach ($data as $key){
                $type = new Type();
                $meet = new Meet();
                $meet = $repository->findOneById($key['meet_id']);
                $type->setHostType($key['hostType']);
                $type->setGuestType($key['guestType']);
                $type->setNumberOfPoints(0);
                $type->setUser($this->getUser());
                $type->setMeet($meet);
                
                $validator = $this->get('validator');
                $errors = $validator->validate($type);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($meet);
                $em->persist($type);
                
                if (count($errors) > 0) {
                    return $this->redirect($this->generateUrl('liga_typerow_validation'));
                }
            }
            $em->flush();
            
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
    public function statisticsAction(){
        
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $stats = $repository->getStatistics();
        
        return array('stats' => $stats);
    }
    
    /**
     * @Route(
     *      "/ranking",
     *      name = "liga_typerow_ranking"
     * )
     * @Template()
     */
    public function rankingAction(){
        
        $repository = $this->getDoctrine()->getRepository(User::class);
        $ranks = $repository->getRanking();
        
        return array('ranks' => $ranks);
    }
    
    /**
     * @Route(
     *      "/zasady",
     *      name = "liga_typerow_principles"
     * )
     * @Template()
     */
    public function principlesAction(){
        
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
    public function recordsAction(){
        
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
     *      "/historia/{season}",
     *      name = "liga_typerow_history"
     * )
     * @Template()
     */
    public function historyAction(Request $request){
        
        $repository = $this->getDoctrine()->getRepository(History::class);
        $history = $repository->getHistory($request->get('season'));
        
        return array('points' => $history);
    }

    /**
     * @Route(
     *      "/forum",
     *      name = "liga_typerow_forum"
     * )
     * @Template()
     */
    public function forumAction(Request $request, AppExtension $appExtension){
        
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
            
//            return new JsonResponse(array('message' => 'Success!'), 200);
            return $this->redirect($this->generateUrl('liga_typerow_forum'));
        }
        
        return array('comments' => $comments, 'matchday' => $matchday);
    }
    

//    public function accountAction(){
//        
//        $repository = $this->getDoctrine()->getRepository('Statistic:class');
//        $udatas = $repository->getUserData($this->getUser());
//        
//        return array('udatas' => $udatas);
//    }

    /**
     * @Route(
     *      "/validation",
     *      name = "liga_typerow_validation"
     * )
     * @Template()
     */
    public function validationAction(){
        return array();
    }
    
    /**
     * @Route(
     *      "/mytest",
     *      name = "liga_typerow_mytest"
     * )
     * 
     * @Template()
     */
    public function myTestAction(){
        return array();
    }
    
    /**
     * @Route(
     *      "/konto",
     *      name = "liga_typerow_account"
     * )
     * 
     * @Template()
     */
    public function accountSettingsAction(Request $Request)
    {        
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