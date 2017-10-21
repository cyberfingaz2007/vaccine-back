<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserAccountsController extends Controller
{
    public function indexAction()
    {
        return $this->render('JUMAINAdminBundle:UserAccounts:index.html.twig');
    }
}
