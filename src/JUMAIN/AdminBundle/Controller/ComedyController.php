<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use JUMAIN\ContentBundle\Entity\Movie;
use JUMAIN\ContentBundle\Form\Type\MovieType;

class ComedyController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newMovie = new Movie();

        $form = $this->addMovieCreateForm($newMovie);
        return $this->render('JUMAINAdminBundle:Comedy:index.html.twig', array(
          'form' => $form->createView(),
        ));
    }

    public function addComedyAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newMovie = new Movie();

        $form = $this->addMovieCreateForm($newMovie);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newMovie);
                $em->flush();

                return $this->redirect($this->generateUrl('jumain_admin_comedy'));
            }
        }

        return $this->render('JUMAINAdminBundle:Comedy:index.html.twig', array(
          'form' => $form->createView(),
        ));
    }




    /////////////////////////////////////////////////////////////////////////////////////////////// FORMS /////////////////////////////////////////////////////////////////////////////////
    /**
    * Creates a form to edit an Movie entity.
    *
    * @param Movie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addMovieCreateForm(Movie $entity)
    {
        $form = $this->createForm(MovieType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_comedy_add'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }
}
