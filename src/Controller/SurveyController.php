<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Survey;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SurveyController extends AbstractController
{
    /**
     * @Route("/survey", name="survey")
     */
    public function index(Request $request)
    {
        return $this->render('survey/index.html.twig');
    }

    /**
     * @Route("/store", name="app_survey")
     */
    public function store(Request $request, EntityManagerInterface $entityManager)
    {
        $session = new Session();
        $survey = new Survey();
        $survey->setMark($request->request->get('mark'));
        $survey->setModel($request->request->get('model'));
        $survey->setEng($request->request->get('engine'));
        $survey->setGearBox($request->request->get('gear_box'));
        $survey->setHorsePower($request->request->get('horse_power'));
        $survey->setBodyType($request->request->get('type'));
        $survey->setCreatedAt($request->request->get('from'));
        $survey->setEndDate($request->request->get('to'));
        $entityManager->persist($survey);
        $entityManager->flush();
        $session->set('notice', 'Ще изпратим скоро най-добрата оферта! Благодаря за запитването!');
        return $this->redirectToRoute('listing');
    }
}
