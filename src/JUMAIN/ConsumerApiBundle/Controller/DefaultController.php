<?php

namespace JUMAIN\ConsumerApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends FOSRestController
{
    public function indexAction()
    {
        //return $this->render('JUMAINConsumerApiBundle:Default:index.html.twig');
        //return $this->render('JUMAINConsumerBundle:Default:index.html.twig');
        //return $this->handleView(array("hello" => "world"));
        $em = $this->getDoctrine()->getManager();
        $hollyEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllHolly();
        $data = array("hello" => "world");
        $view = $this->view($hollyEntities);
        return $this->handleView($view);
    }

    public function getMoviesAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getMovieAction($id)
    {
        $em = $this->getDoctrine()->getManager();
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
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getHollyMoviesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $hollyEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllHolly();
        /*if (is_null($hollyEntities)) {
            throw $this->createNotFoundException('No such Movie');
        }*/
        if (!$hollyEntities) {
          $view = $this->view("No Movies Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($hollyEntities);
        return $this->handleView($view);
    }

    public function getNollyMoviesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nollyEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllNolly();
        if (!$nollyEntities) {
          $view = $this->view("No Movies Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($nollyEntities);
        return $this->handleView($view);
    }

    public function getBollyMoviesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bollyEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllBolly();
        if (!$bollyEntities) {
          $view = $this->view("No Movies Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($bollyEntities);
        return $this->handleView($view);
    }

    public function getNovelaMoviesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $novEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllNove();
        if (!$novEntities) {
          $view = $this->view("No Movies Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($novEntities);
        return $this->handleView($view);
    }

    public function getKoreanMoviesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $korEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllKore();
        if (!$korEntities) {
          $view = $this->view("No Movies Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($korEntities);
        return $this->handleView($view);
    }

    public function getPhilMoviesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $philEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllPhil();
        if (!$philEntities) {
          $view = $this->view("No Movies Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($philEntities);
        return $this->handleView($view);
    }

    public function getOtherMoviesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $otherEntities = $em->getRepository('JUMAINContentBundle:Movie')
                ->findAllOthers();
        if (!$otherEntities) {
          $view = $this->view("No Movies Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($otherEntities);
        return $this->handleView($view);
    }

    public function getSeriesAction()
    {
        $data = array("hello" => "world");
        $em = $this->getDoctrine()->getManager();

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

        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getSerieAction($serieId)
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getSerieSeasonsAction($serieId)
    {
      $em = $this->getDoctrine()->getManager();
      $seasonEntities = $em->getRepository('JUMAINContentBundle:Season')
              ->getSerieSeasons($serieId);
      $view = $this->view($seasonEntities);
      return $this->handleView($view);
    }

    public function getSerieSeasonAction($serieId, $seasonId)
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getSeasonEpisodesAction($seasonId)
    {
        $em = $this->getDoctrine()->getManager();
        $episodeEntities = $em->getRepository('JUMAINContentBundle:Episode')
                ->getSeasonEpisodes($seasonId);
        $view = $this->view($episodeEntities);
        return $this->handleView($view);
    }

    public function getHollySeriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $hollyEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllHolly();
        if (!$hollyEntities) {
          $view = $this->view("No Holly Series Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($hollyEntities);
        return $this->handleView($view);
    }

    public function getNollySeriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nollyEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllNolly();
        if (!$nollyEntities) {
          $view = $this->view("No Nolly Series Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($nollyEntities);
        return $this->handleView($view);
    }

    public function getBollySeriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bollyEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllBolly();
        if (!$bollyEntities) {
          $view = $this->view("No Bolly Series Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($bollyEntities);
        return $this->handleView($view);
    }

    public function getNovelaSeriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $novEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllNove();
        if (!$novEntities) {
          $view = $this->view("No Series Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($novEntities);
        return $this->handleView($view);
    }

    public function getKoreanSeriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $korEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllKore();
        if (!$korEntities) {
          $view = $this->view("No Series Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($korEntities);
        return $this->handleView($view);
    }

    public function getPhilSeriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $philEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllPhil();
        if (!$philEntities) {
          $view = $this->view("No Series Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($philEntities);
        return $this->handleView($view);
    }

    public function getOtherSeriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $otherEntities = $em->getRepository('JUMAINContentBundle:Serie')
                ->findAllOthers();
        if (!$otherEntities) {
          $view = $this->view("No Series Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($otherEntities);
        return $this->handleView($view);
    }

    public function getLocalMusVidsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('JUMAINContentBundle:MusicalVideo')
                ->findAllLocal();
        if (!$entities) {
          $view = $this->view("No Musical Videos Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($entities);
        return $this->handleView($view);
    }

    public function getForeignMusVidsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('JUMAINContentBundle:MusicalVideo')
                ->findAllForeign();
        if (!$entities) {
          $view = $this->view("No Musical Videos Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($entities);
        return $this->handleView($view);
    }

    public function getLocalTrailersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('JUMAINContentBundle:Trailer')
                ->findAllLocal();
        if (!$entities) {
          $view = $this->view("No Trailers Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($entities);
        return $this->handleView($view);
    }

    public function getForeignTrailersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('JUMAINContentBundle:Trailer')
                ->findAllForeign();
        if (!$entities) {
          $view = $this->view("No Trailers Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($entities);
        return $this->handleView($view);
    }

    public function getChannelsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('JUMAINConsumerBundle:Channel')
                ->findAll();
        if (!$entities) {
          $view = $this->view("No Channels Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($entities);
        return $this->handleView($view);
    }

    public function getChannelVideosAction($channelId)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('JUMAINContentBundle:ChannelVideo')
                ->findChannelVideos($channelId);
        if (!$entities) {
          $view = $this->view("No Channel Videos Found", Response::HTTP_NOT_FOUND);
          return $this->handleView($view);
        }
        $view = $this->view($entities);
        return $this->handleView($view);
    }
}
