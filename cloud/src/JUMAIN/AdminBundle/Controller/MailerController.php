<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class MailerController extends Controller
{
  public function sendEmailMessageAction($fromEmail, $toEmail, $subject, $renderedTemplate = null)
  {
    # code...
    $message = \Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom($fromEmail)
        ->setTo($toEmail)
        ->setBody($renderedTemplate);

        $this->get('mailer')->send($message);
  }
}
