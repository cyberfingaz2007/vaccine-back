<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AuthVideosController extends Controller
{
    public function indexAction()
    {
        return $this->render('JUMAINAdminBundle:AuthVideos:index.html.twig');
    }
}
