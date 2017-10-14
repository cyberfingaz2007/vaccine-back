<?php

namespace JUMAIN\HealthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends FOSRestController
{
    public function indexAction()
    {
        $data = array("hello" => "world");

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getChildEnteredByDateAction($dateValue)
    {
        $em = $this->getDoctrine()->getManager();
        $childEntities = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findAllChildEnteredByDate($dateValue);
        
        $data = array("hello" => "world");

        $view = $this->view($childEntities);

        return $this->handleView($view);
    }

    public function getNumChildEnteredByDateAction($dateValue)
    {
        $em = $this->getDoctrine()->getManager();
        $numVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findNumChildEnteredByDate($dateValue);
        
        $data = array("numValue" => $numVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getTotNumChildEnteredTillDateAction($dateValue)
    {
        $em = $this->getDoctrine()->getManager();
        $totNumVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotNumChildEnteredTillDate($dateValue);
        
        $data = array("totValue" => $totNumVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getTotalVaccinatedAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotVaccinated();
        
        $data = array("totValue" => $totVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getTotalBudgetSpentAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotVaccinated();
        
        $data = array("totBudgetSpent" => $totVal,
                        "totBudget" => $totVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getTotalTimeElapsedAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotVaccinated();
        
        $data = array("totBudgetSpent" => $totVal,
                        "totBudget" => $totVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }
}
