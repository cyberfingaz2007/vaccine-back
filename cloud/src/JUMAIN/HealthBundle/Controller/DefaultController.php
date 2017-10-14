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
        
        //$data = array("hello" => "world");

        $view = $this->view($numVal);

        return $this->handleView($view);
    }

    public function getTotNumChildEnteredTillDateAction($dateValue)
    {
        $em = $this->getDoctrine()->getManager();
        $numVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findNumChildEnteredByDate($dateValue);
        
        //$data = array("hello" => "world");

        $view = $this->view($numVal);

        return $this->handleView($view);
    }
}
