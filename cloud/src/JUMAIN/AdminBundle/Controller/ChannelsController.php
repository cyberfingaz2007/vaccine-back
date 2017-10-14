<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use JUMAIN\ContentBundle\Entity\ChannelVideo;
use JUMAIN\ContentBundle\Form\Type\ChannelVideoType;

use JUMAIN\ConsumerBundle\Entity\Channel;
use JUMAIN\ConsumerBundle\Form\Type\ChannelType;


class ChannelsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newChannel = new Channel();
        $newChannelVid = new ChannelVideo();

        $form = $this->addChannelCreateForm($newChannel);
        $formCV = $this->addChannelVidCreateForm($newChannelVid);

        $channelsEntities = $em->getRepository('JUMAINConsumerBundle:Channel')
                ->findAll();
        $channelsVidsEntities = $em->getRepository('JUMAINContentBundle:ChannelVideo')
                ->findAll();

        return $this->render('JUMAINAdminBundle:Channels:index.html.twig', array(
          'form' => $form->createView(),
          'formCV' => $formCV->createView(),
          'channelsEntities' => $channelsEntities,
          'channelsVidsEntities' => $channelsVidsEntities,
        ));
    }

    public function addChannelAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newChannel = new Channel();

        $form = $this->addChannelCreateForm($newChannel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newChannel);
            $em->flush();

            $this->addFlash('notice','Successfully added '.$newChannel->getChannelName().'!');
            return $this->redirectToRoute('jumain_admin_homepage');
            //return $this->redirectToRoute('jumain_admin_homepage');
        }

        $this->addFlash('error','Error occured while creating Channel!');
        return $this->redirectToRoute('jumain_admin_homepage');
    }

    public function addChannelVidsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newChannelVid = new ChannelVideo();

        $form = $this->addChannelVidCreateForm($newChannelVid);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newChannelVid);
            $em->flush();

            $this->addFlash('notice','Successfully added '.$newChannelVid->getContentName().'!');
            return $this->redirectToRoute('jumain_admin_homepage');
        }

        $this->addFlash('error','Error occured while adding Channel Video!');
        return $this->redirectToRoute('jumain_admin_homepage');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////// FORMS /////////////////////////////////////////////////////////////////////////////////
    /**
    * Creates a form to edit an Channel entity.
    *
    * @param Channel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addChannelCreateForm(Channel $entity)
    {
        $form = $this->createForm(ChannelType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_channels_add'),
            'method' => 'POST',
            'attr' => array('id' => 'formChannel',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit an ChannelVideo entity.
    *
    * @param ChannelVideo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addChannelVidCreateForm(ChannelVideo $entity)
    {
        $form = $this->createForm(ChannelVideoType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_channel_video_add'),
            'method' => 'POST',
            'attr' => array('id' => 'formChannelVid',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }
}
