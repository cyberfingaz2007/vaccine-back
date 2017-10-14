<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AccountingController extends Controller
{
    public function indexAction()
    {
        return $this->render('JUMAINAdminBundle:Accounting:index.html.twig');
    }
}
