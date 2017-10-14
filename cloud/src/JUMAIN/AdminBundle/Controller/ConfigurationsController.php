<?php

namespace JUMAIN\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use JUMAIN\ContentBundle\Entity\AuthVidsCategory;
use JUMAIN\ContentBundle\Form\Type\AuthVidsCategoryType;
use JUMAIN\ContentBundle\Entity\Category;
use JUMAIN\ContentBundle\Form\Type\CategoryType;
use JUMAIN\ContentBundle\Entity\MuzVidsCategory;
use JUMAIN\ContentBundle\Form\Type\MuzVidsCategoryType;
use JUMAIN\ContentBundle\Entity\TrailerCategory;
use JUMAIN\ContentBundle\Form\Type\TrailerCategoryType;
use JUMAIN\ContentBundle\Entity\ComedyCategory;
use JUMAIN\ContentBundle\Form\Type\ComedyCategoryType;
use JUMAIN\ContentBundle\Entity\ContentType;
use JUMAIN\ContentBundle\Form\Type\ContentTypeType;
use JUMAIN\ContentBundle\Entity\ContentLevel;
use JUMAIN\ContentBundle\Form\Type\ContentLevelType;
use JUMAIN\ContentBundle\Entity\ContentLevelPrice;
use JUMAIN\ContentBundle\Form\Type\ContentLevelPriceType;

class ConfigurationsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newAuthVidsCate = new AuthVidsCategory();
        $formAuthVidsCate = $this->addAuthVidsCateCreateForm($newAuthVidsCate);
        $newCate = new Category();
        $formCate = $this->addCategoryCreateForm($newCate);
        $newMuzVidsCate = new MuzVidsCategory();
        $formMuzVidsCate = $this->addMuzVidsCateCreateForm($newMuzVidsCate);
        $newTrailCate = new TrailerCategory();
        $formTrailCate = $this->addTrailerCateCreateForm($newTrailCate);
        $newComedyCate = new ComedyCategory();
        $formComedyCate = $this->addComedyCateCreateForm($newComedyCate);
        $newContType = new ContentType();
        $formContType = $this->addContTypeCreateForm($newContType);
        $newContLvl = new ContentLevel();
        $formContLvl = $this->addContentLevelCreateForm($newContLvl);
        $newContLvlPrc = new ContentLevelPrice();
        $formContLvlPrc = $this->addContLevelPriceCreateForm($newContLvlPrc);

        $authEntities = $em->getRepository('JUMAINContentBundle:AuthVidsCategory')
                ->findAll();
        $cateEntities = $em->getRepository('JUMAINContentBundle:Category')
                ->findAll();
        $musEntities = $em->getRepository('JUMAINContentBundle:MuzVidsCategory')
                ->findAll();
        $trailEntities = $em->getRepository('JUMAINContentBundle:TrailerCategory')
                ->findAll();
        $comEntities = $em->getRepository('JUMAINContentBundle:ComedyCategory')
                ->findAll();
        $contTypEntities = $em->getRepository('JUMAINContentBundle:ContentType')
                ->findAll();
        $contLvlEntities = $em->getRepository('JUMAINContentBundle:ContentLevel')
                ->findAll();
        $contLvlPrcEntities = $em->getRepository('JUMAINContentBundle:ContentLevelPrice')
                ->findAllCurr();


        return $this->render('JUMAINAdminBundle:Configurations:index.html.twig', array(
          'formAuthVidsCate' => $formAuthVidsCate->createView(),
          'formCate' => $formCate->createView(),
          'formMuzVidsCate' => $formMuzVidsCate->createView(),
          'formTrailCate' => $formTrailCate->createView(),
          'formComedyCate' => $formComedyCate->createView(),
          'formContType' => $formContType->createView(),
          'formContLvl' => $formContLvl->createView(),
          'formContLvlPrc' => $formContLvlPrc->createView(),
          'authEntities' => $authEntities,
          'cateEntities' => $cateEntities,
          'musEntities' => $musEntities,
          'trailEntities' => $trailEntities,
          'comEntities' => $comEntities,
          'contTypEntities' => $contTypEntities,
          'contLvlEntities' => $contLvlEntities,
          'contLvlPrcEntities' => $contLvlPrcEntities,
        ));
    }

    public function addAuthVidsCateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newAuthVidsCate = new AuthVidsCategory();
        $formAuthVidsCate = $this->addAuthVidsCateCreateForm($newAuthVidsCate);

        if ($request->isMethod('POST'))
        {
            $formAuthVidsCate->handleRequest($request);

            if ($formAuthVidsCate->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newAuthVidsCate);
                $em->flush();

                return $this->forward('JUMAINAdminBundle:Configurations:nuAuthVidsCate');
            }
        }

        return $this->render('JUMAINAdminBundle:Configurations:index.html.twig', array(
          'formAuthVidsCate' => $formAuthVidsCate->createView(),
        ));
    }

    public function nuAuthVidsCateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newAuthVidsCate = new AuthVidsCategory();
        $formAuthVidsCate = $this->addAuthVidsCateCreateForm($newAuthVidsCate);

        $authEntities = $em->getRepository('JUMAINContentBundle:AuthVidsCategory')
                ->findAll();

        return $this->render('JUMAINAdminBundle:Configurations:nuAuthVidsCate.html.twig', array(
          'formAuthVidsCate' => $formAuthVidsCate->createView(),
          'authEntities' => $authEntities,
        ));
    }

    public function addCategoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newCate = new Category();
        $formCate = $this->addCategoryCreateForm($newCate);

        if ($request->isMethod('POST'))
        {
            $formCate->handleRequest($request);

            if ($formCate->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newCate);
                $em->flush();

                return $this->forward('JUMAINAdminBundle:Configurations:nuCategory');
            }
        }

        return $this->render('JUMAINAdminBundle:Configurations:index.html.twig', array(
          '$formCate' => $formCate->createView(),
        ));
    }

    public function nuCategoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newCate = new Category();
        $formCate = $this->addCategoryCreateForm($newCate);

        $cateEntities = $em->getRepository('JUMAINContentBundle:Category')
                ->findAll();

        return $this->render('JUMAINAdminBundle:Configurations:nuCate.html.twig', array(
          '$formCate' => $formCate->createView(),
          'cateEntities' => $cateEntities,
        ));
    }

    public function addMuzvidsCateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newMuzVidsCate = new MuzVidsCategory();
        $formMuzVidsCate = $this->addMuzVidsCateCreateForm($newMuzVidsCate);

        if ($request->isMethod('POST'))
        {
            $formMuzVidsCate->handleRequest($request);

            if ($formMuzVidsCate->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newMuzVidsCate);
                $em->flush();

                return $this->forward('JUMAINAdminBundle:Configurations:nuMuzvidsCate');
            }
        }

        return $this->render('JUMAINAdminBundle:Configurations:index.html.twig', array(
          'formMuzVidsCate' => $formMuzVidsCate->createView(),
        ));
    }

    public function nuMuzvidsCateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newMuzVidsCate = new MuzVidsCategory();
        $formMuzVidsCate = $this->addMuzVidsCateCreateForm($newMuzVidsCate);

        $musEntities = $em->getRepository('JUMAINContentBundle:MuzVidsCategory')
                ->findAll();

        return $this->render('JUMAINAdminBundle:Configurations:nuMusCate.html.twig', array(
          'formMuzVidsCate' => $formMuzVidsCate->createView(),
          'musEntities' => $musEntities,
        ));
    }

    public function addTrailerCateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newTrailCate = new TrailerCategory();
        $formTrailCate = $this->addTrailerCateCreateForm($newTrailCate);

        if ($request->isMethod('POST'))
        {
            $formTrailCate->handleRequest($request);

            if ($formTrailCate->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newTrailCate);
                $em->flush();

                return $this->forward('JUMAINAdminBundle:Configurations:nuTrailerCate');

            }
        }

        return $this->render('JUMAINAdminBundle:Configurations:nuTrailCate.html.twig', array(
          'formTrailCate' => $formTrailCate->createView(),
        ));
    }

    public function nuTrailerCateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newTrailCate = new TrailerCategory();
        $formTrailCate = $this->addTrailerCateCreateForm($newTrailCate);

        $trailEntities = $em->getRepository('JUMAINContentBundle:TrailerCategory')
                ->findAll();

        return $this->render('JUMAINAdminBundle:Configurations:nuTrailCate.html.twig', array(
          'formTrailCate' => $formTrailCate->createView(),
          'trailEntities' => $trailEntities,
        ));
    }

    public function addComedyCateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newComedyCate = new ComedyCategory();
        $formComedyCate = $this->addComedyCateCreateForm($newComedyCate);

        if ($request->isMethod('POST'))
        {
            $formComedyCate->handleRequest($request);

            if ($formComedyCate->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newMovie);
                $em->flush();

                return $this->forward('JUMAINAdminBundle:Configurations:nuComedyCate');
            }
        }

        return $this->render('JUMAINAdminBundle:Configurations:index.html.twig', array(
          'formComedyCate' => $formComedyCate->createView(),
        ));
    }

    public function nuComedyCateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newComedyCate = new ComedyCategory();
        $formComedyCate = $this->addComedyCateCreateForm($newComedyCate);

        $comEntities = $em->getRepository('JUMAINContentBundle:ComedyCategory')
                ->findAll();

        return $this->render('JUMAINAdminBundle:Configurations:nuComCate.html.twig', array(
          'formComedyCate' => $formComedyCate->createView(),
          'comEntities' => $comEntities,
        ));
    }

    public function addContTypeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newContType = new ContentType();
        $formContType = $this->addContTypeCreateForm($newContType);

        if ($request->isMethod('POST'))
        {
            $formContType->handleRequest($request);

            if ($formContType->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newContType);
                $em->flush();

                return $this->forward('JUMAINAdminBundle:Configurations:nuContType');
            }
        }

        return $this->render('JUMAINAdminBundle:Configurations:nuContTyp.html.twig', array(
          'formContType' => $formContType->createView(),
        ));
    }

    public function nuContTypeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newContType = new ContentType();
        $formContType = $this->addContTypeCreateForm($newContType);

        $contTypEntities = $em->getRepository('JUMAINContentBundle:ContentType')
                ->findAll();

        return $this->render('JUMAINAdminBundle:Configurations:nuContTyp.html.twig', array(
          'formContType' => $formContType->createView(),
          'contTypEntities' => $contTypEntities,
        ));
    }

    public function addContLvlAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newContLvl = new ContentLevel();
        $formContLvl = $this->addContentLevelCreateForm($newContLvl);

        if ($request->isMethod('POST'))
        {
            $formContLvl->handleRequest($request);

            if ($formContLvl->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newContLvl);
                $em->flush();

                return $this->forward('JUMAINAdminBundle:Configurations:nuContLvl');
            }
        }

        return $this->render('JUMAINAdminBundle:Configurations:index.html.twig', array(
          'formContLvl' => $formContLvl->createView(),
        ));
    }

    public function nuContLvlAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newContLvl = new ContentLevel();
        $formContLvl = $this->addContentLevelCreateForm($newContLvl);

        $contLvlEntities = $em->getRepository('JUMAINContentBundle:ContentLevel')
                ->findAll();

        return $this->render('JUMAINAdminBundle:Configurations:nuContLvl.html.twig', array(
          'formContLvl' => $formContLvl->createView(),
          'contLvlEntities' => $contLvlEntities,
        ));
    }

    public function addContLvlPrcAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $newContLvlPrc = new ContentLevelPrice();
        $formContLvlPrc = $this->addContLevelPriceCreateForm($newContLvlPrc);

        if ($request->isMethod('POST'))
        {
            $formContLvlPrc->handleRequest($request);

            if ($formContLvlPrc->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($newContLvlPrc);
                $em->flush();

                return $this->forward('JUMAINAdminBundle:Configurations:nuContLvlPrc');
            }
        }

        return $this->render('JUMAINAdminBundle:Configurations:index.html.twig', array(
          'formContLvlPrc' => $formContLvlPrc->createView(),
        ));
    }

    public function nuContLvlPrcAction()
    {
        $em = $this->getDoctrine()->getManager();
        $newContLvlPrc = new ContentLevelPrice();
        $formContLvlPrc = $this->addContLevelPriceCreateForm($newContLvlPrc);

        $contLvlPrcEntities = $em->getRepository('JUMAINContentBundle:ContentLevelPrice')
                ->findAllCurr();

        return $this->render('JUMAINAdminBundle:Configurations:nuContLvlPrc.html.twig', array(
          'formContLvlPrc' => $formContLvlPrc->createView(),
          'contLvlPrcEntities' => $contLvlPrcEntities,
        ));
    }

    /////////////////////////////////////////////////////////////////////////////////////////////// FORMS /////////////////////////////////////////////////////////////////////////////////
    /**
    * Creates a form to edit an AuthVidsCategory entity.
    *
    * @param AuthVidsCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addAuthVidsCateCreateForm(AuthVidsCategory $entity)
    {
        $form = $this->createForm(AuthVidsCategoryType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_config_add_authvidscate'),
            'method' => 'POST',
            'attr' => array('id' => 'formAuthVidsCate',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit an Category entity.
    *
    * @param Category $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addCategoryCreateForm(Category $entity)
    {
        $form = $this->createForm(CategoryType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_config_add_category'),
            'method' => 'POST',
            'attr' => array('id' => 'formCate',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit an MuzVidsCategory entity.
    *
    * @param MuzVidsCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addMuzVidsCateCreateForm(MuzVidsCategory $entity)
    {
        $form = $this->createForm(MuzVidsCategoryType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_config_add_musvidscate'),
            'method' => 'POST',
            'attr' => array('id' => 'formMuzVidsCate',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit an TrailerCategory
    *
    * @param TrailerCategory The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addTrailerCateCreateForm(TrailerCategory $entity)
    {
        $form = $this->createForm(TrailerCategoryType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_config_add_trailercate'),
            'method' => 'POST',
            'attr' => array('id' => 'formTrailCate',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit an ComedyCategory entity.
    *
    * @param ComedyCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addComedyCateCreateForm(ComedyCategory $entity)
    {
        $form = $this->createForm(ComedyCategoryType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_config_add_comedycate'),
            'method' => 'POST',
            'attr' => array('id' => 'formComedyCate',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit an ContentType entity.
    *
    * @param ContentType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addContTypeCreateForm(ContentType $entity)
    {
        $form = $this->createForm(ContentTypeType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_config_add_conttype'),
            'method' => 'POST',
            'attr' => array('id' => 'formContType',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit an ContentLevel entity.
    *
    * @param ContentLevel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addContentLevelCreateForm(ContentLevel $entity)
    {
        $form = $this->createForm(ContentLevelType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_config_add_contlvl'),
            'method' => 'POST',
            'attr' => array('id' => 'formContLvl',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

    /**
    * Creates a form to edit an ContentLevelPrice entity.
    *
    * @param ContentLevelPrice $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function addContLevelPriceCreateForm(ContentLevelPrice $entity)
    {
        $form = $this->createForm(ContentLevelPriceType::class, $entity, array(
            'action' => $this->generateUrl('jumain_admin_config_add_contlvlprc'),
            'method' => 'POST',
            'attr' => array('id' => 'formContLvlPrc',),
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Submit'));

        return $form;
    }

}
