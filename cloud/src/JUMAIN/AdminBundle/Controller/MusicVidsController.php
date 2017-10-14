<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use JUMAIN\ContentBundle\Entity\MusicalVideo;
use JUMAIN\ContentBundle\Form\Type\MusicalVideoType;

class MusicVidsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newMusVid = new MusicalVideo();
        $form = $this->addMusVidsCreateForm($newMusVid);

        $localEntities = $em->getRepository('JUMAINContentBundle:MusicalVideo')
                ->findAllLocal();
        $foreEntities = $em->getRepository('JUMAINContentBundle:MusicalVideo')
                ->findAllForeign();

        return $this->render('JUMAINAdminBundle:MusicVids:index.html.twig', array(
          'form' => $form->createView(),
          'localEntities' => $localEntities,
          'foreEntities' => $foreEntities,
        ));
    }

    public function addMusVidsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newMusVid = new MusicalVideo();

        $form = $this->addMusVidsCreateForm($newMusVid);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newMusVid);
                $em->flush();

                $this->addFlash('notice','Successfully added '.$newMusVid->getMusicName().'!');
                return $this->redirectToRoute('jumain_admin_homepage');
            }
        }

        $this->addFlash('error','Error occured while adding Musical Video!');
        return $this->redirectToRoute('jumain_admin_homepage');
    }




    /////////////////////////////////////////////////////////////////////////////////////////////// FORMS /////////////////////////////////////////////////////////////////////////////////
    /**
    * Creates a form to edit an MusicalVideo entity.
    *
    * @param MusicalVideo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addMusVidsCreateForm(MusicalVideo $entity)
    {
        $form = $this->createForm(MusicalVideoType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_musvids_add'),
            'method' => 'POST',
            'attr' => array('id' => 'formMuzVid',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }
}
