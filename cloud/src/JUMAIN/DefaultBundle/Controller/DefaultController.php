<?php

namespace JUMAIN\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JUMAINDefaultBundle:Default:index.html.twig');
        //return $response = $this->forward('JUMAINConsumerBundle:Default:index');

    }

}
