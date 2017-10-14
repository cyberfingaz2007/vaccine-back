<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use JUMAIN\ContentBundle\Entity\Trailer;
use JUMAIN\ContentBundle\Form\Type\TrailerType;

class TrailersController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newTrailer = new Trailer();
        $form = $this->addTrailerCreateForm($newTrailer);

        $localEntities = $em->getRepository('JUMAINContentBundle:Trailer')
                ->findAllLocal();
        $foreEntities = $em->getRepository('JUMAINContentBundle:Trailer')
                ->findAllForeign();

        return $this->render('JUMAINAdminBundle:Trailers:index.html.twig', array(
          'form' => $form->createView(),
          'localEntities' => $localEntities,
          'foreEntities' => $foreEntities,
        ));
    }

    public function addTrailersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newTrailer = new Trailer();

        $form = $this->addTrailerCreateForm($newTrailer);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newTrailer);
                $em->flush();

                $this->addFlash('notice','Successfully added '.$newTrailer->getVideoName().'!');
                return $this->redirectToRoute('jumain_admin_homepage');
            }
        }

        $this->addFlash('error','Error occured while adding Trailer!!!');
        return $this->redirectToRoute('jumain_admin_homepage');
    }




    /////////////////////////////////////////////////////////////////////////////////////////////// FORMS /////////////////////////////////////////////////////////////////////////////////
    /**
    * Creates a form to edit an Trailer entity.
    *
    * @param Trailer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addTrailerCreateForm(Trailer $entity)
    {
        $form = $this->createForm(TrailerType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_trailer_add'),
            'method' => 'POST',
            'attr' => array('id' => 'formTrailer',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }
}
