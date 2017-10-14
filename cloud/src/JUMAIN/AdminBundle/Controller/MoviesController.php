<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use JUMAIN\ContentBundle\Entity\Movie;
use JUMAIN\ContentBundle\Form\Type\MovieType;

class MoviesController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newMovie = new Movie();

        $form = $this->addMovieCreateForm($newMovie);

        $hollyEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllHolly();
        $nollyEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllNolly();
        $bollyEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllBolly();
        $novEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllNove();
        $korEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllKore();
        $philEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllPhil();
        $otherEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllOthers();

        return $this->render('JUMAINAdminBundle:Movies:index.html.twig', array(
          'form' => $form->createView(),
          'hollyEntities' => $hollyEntities,
          'nollyEntities' => $nollyEntities,
          'bollyEntities' => $bollyEntities,
          'novEntities' => $novEntities,
          'korEntities' => $korEntities,
          'philEntities' => $philEntities,
          'otherEntities' => $otherEntities,
        ));
    }

    public function addMoviesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newMovie = new Movie();

        $form = $this->addMovieCreateForm($newMovie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newMovie);
            $em->flush();

            $this->addFlash('notice','Successfully added '.$newMovie->getMovieName().'!');
            return $this->redirectToRoute('jumain_admin_homepage');
            //return $this->redirectToRoute('jumain_admin_homepage');
        }

        /*
        return $this->render('JUMAINAdminBundle:Movies:index.html.twig', array(
          'form' => $form->createView(),
        ));
        */
        $this->addFlash('error','Error occured while adding movie!');
        return $this->redirectToRoute('jumain_admin_homepage');
    }




    //////////////////////////////////////////////////////// FORMS /////////////////////////////////////////////////////////////////////////////////
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
            'action' => $this->generateUrl('jumain_admin_movies_add'),
            'method' => 'POST',
            'attr' => array('id' => 'formMovie',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }
}
