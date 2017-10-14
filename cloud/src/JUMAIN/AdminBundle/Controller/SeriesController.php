<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use JUMAIN\ContentBundle\Entity\Serie;
use JUMAIN\ContentBundle\Form\Type\SerieType;

use JUMAIN\ContentBundle\Entity\Season;
use JUMAIN\ContentBundle\Form\Type\SeasonType;

use JUMAIN\ContentBundle\Entity\Episode;
use JUMAIN\ContentBundle\Form\Type\EpisodeType;

class SeriesController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newSerie = new Serie();
        $form = $this->addSerieCreateForm($newSerie);

        $hollyEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllHolly();
        $nollyEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllNolly();
        $bollyEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllBolly();
        $novEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllNove();
        $korEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllKore();
        $philEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllPhil();
        $otherEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllOthers();



        return $this->render('JUMAINAdminBundle:Series:index.html.twig', array(
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

    public function addSeriesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newSerie = new Serie();

        $form = $this->addSerieCreateForm($newSerie);

        if ($request->isMethod('POST'))
        {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();


                $newSeason = new Season();
                $newSeason->setSeasonName("Season01");
                $newSeason->setSeasonTitle("Season 1");
                $newSeason->setSeasonNum(1);
                $newSeason->setEpisodesNumber(0);
                $newSeason->setSerie($newSerie);

                $newSerie->setSeasonNumber(1);
                $newSerie->addSeason($newSeason);
                $em->persist($newSerie);
                //$em->persist($newSerie);
                $em->flush();

                $this->addFlash('notice','Successfully added '.$newSerie->getSerieName().'!');
                return $this->redirectToRoute('jumain_admin_homepage');
            }
        }
        $this->addFlash('error','Error occured while adding Serie!');
        return $this->redirectToRoute('jumain_admin_homepage');
    }

    public function getSerieSeasonsAction($serieId)
    {
        $em = $this->getDoctrine()->getManager();
        $newSeason = new Season();

        $serieEntity = new Serie();
        $serieEntity = $em->getRepository('JUMAINContentBundle:Serie')
                        ->find($serieId);
        /*
        $session = $request->getSession();
        $session->set('serieId', $serieId);
        */
        $newSeason->setSerie($serieEntity);

        $form = $this->addSeasonCreateForm($newSeason);

        $seasonEntities = $em->getRepository('JUMAINContentBundle:Season')
                ->getSerieSeasons($serieId);


        return $this->render('JUMAINAdminBundle:Series:seasons.html.twig', array(
          'formAddSeason' => $form->createView(),
          'seasonEntities' => $seasonEntities,
        ));
    }

    public function addSerieSeasonAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newSeason = new Season();
        /*
        $session = $request->getSession();
        $serieId = $session->get('serieId');
        */
        $serieEntity = new Serie();

        //$newSeason->setSerie($serieEntity);
        $form = $this->addSeasonCreateForm($newSeason);

        //$seasonEntities = $em->getRepository('JUMAINContentBundle:Season')
        //        ->getSerieSeasons($serieId);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$newSeason = $form->getData();
            $newSeason->setEpisodesNumber(0);
            $newSeason->getSerie()->increaseSeasonNumber();
            $em->persist($newSeason);
            //$em->persist($newSerie);
            $em->flush();

            return new Response("<div><strong>Submitted</strong></div>");
        }


        return $this->render('JUMAINAdminBundle:Series:seasons.html.twig', array(
          'formAddSeason' => $form->createView(),
          //'seasonEntities' => $seasonEntities,
        ));
    }

    public function getSeasonEpisodesAction($seasonId)
    {
        $em = $this->getDoctrine()->getManager();
        $newEpisode = new Episode();

        $seasonEntity = new Season();
        $seasonEntity = $em->getRepository('JUMAINContentBundle:Season')
                        ->find($seasonId);

        $newEpisode->setSeason($seasonEntity);

        $form = $this->addEpisodeCreateForm($newEpisode);

        $episodeEntities = $em->getRepository('JUMAINContentBundle:Episode')
                ->getSeasonEpisodes($seasonId);


        return $this->render('JUMAINAdminBundle:Series:episodes.html.twig', array(
          'formAddEpisode' => $form->createView(),
          'episodeEntities' => $episodeEntities,
        ));
    }

    public function addSeasonEpisodeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newEpisode = new Episode();
        $form = $this->addEpisodeCreateForm($newEpisode);

        //$episodeEntities = $em->getRepository('JUMAINContentBundle:Episode')
        //        ->getSeasonEpisodes($seasonId);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $newEpisode->getSeason()->increaseEpisodesNumber();
            $em->persist($newEpisode);

            $em->flush();

            $this->addFlash('notice','Successfully added '.$newEpisode->getEpisodeTitle().'!');

            //return new Response("<div> submitted </div>");
            return $this->redirectToRoute('jumain_admin_homepage');
        }
        $this->addFlash('error','Error occured while adding episode!');

        return $this->redirectToRoute('jumain_admin_homepage');
    }


    /////////////////////////////////////////////////////////////////////////////////////////////// FORMS /////////////////////////////////////////////////////////////////////////////////
    /**
    * Creates a form to edit an Serie entity.
    *
    * @param Serie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addSerieCreateForm(Serie $entity)
    {
        $form = $this->createForm(SerieType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_series_add'),
            'method' => 'POST',
            'attr' => array('id' => 'formSerie',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit a Season entity.
    *
    * @param Season $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addSeasonCreateForm(Season $entity)
    {
        $form = $this->createForm(SeasonType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_serie_seasons_add'),
            'method' => 'POST',
            'attr' => array('id' => 'formAddSeason',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Save'));

        return $form;
    }

    /**
    * Creates a form to edit a Episode entity.
    *
    * @param Episode $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addEpisodeCreateForm(Episode $entity)
    {
        $form = $this->createForm(EpisodeType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_serie_season_episodes_add'),
            'method' => 'POST',
            'attr' => array('id' => 'formAddEpisode',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Save'));

        return $form;
    }
}
