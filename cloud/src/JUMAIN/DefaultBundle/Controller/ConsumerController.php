<?php

namespace JUMAIN\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConsumerController extends Controller
{
    public function indexAction()
    {
        //return $this->render('JUMAINDefaultBundle:Default:index.html.twig');
        return $response = $this->forward('JUMAINConsumerBundle:Default:index');
    }

    public function consumerSignupAction()
    {
        //return $this->render('JUMAINDefaultBundle:Default:index.html.twig');
        return $response = $this->forward('JUMAINConsumerBundle:Default:index');
    }

}
