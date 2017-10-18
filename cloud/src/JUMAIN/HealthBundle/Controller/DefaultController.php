<?php

namespace JUMAIN\HealthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use JUMAIN\HealthBundle\Entity\Project;
use JUMAIN\HealthBundle\Entity\Community;
use JUMAIN\HealthBundle\Entity\Patient;
use JUMAIN\HealthBundle\Entity\MedicalDetail;

class DefaultController extends FOSRestController
{
    public function indexAction()
    {
        $data = array("hello" => "world");

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getChildEnteredByDateAction($dateValue)
    {
        $em = $this->getDoctrine()->getManager();
        $childEntities = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findAllChildEnteredByDate($dateValue);
        
        $data = array("hello" => "world");

        $view = $this->view($childEntities);

        return $this->handleView($view);
    }

    public function getNumChildEnteredByDateAction($dateValue)
    {
        $em = $this->getDoctrine()->getManager();
        $numVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findNumChildEnteredByDate($dateValue);
        
        $data = array("numValue" => $numVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getTotNumChildEnteredTillDateAction($dateValue)
    {
        $em = $this->getDoctrine()->getManager();
        $totNumVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotNumChildEnteredTillDate($dateValue);
        
        $data = array("totValue" => $totNumVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getTotalVaccinatedAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotVaccinated();
        
        $data = array("totValue" => $totVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getTotalBudgetSpentAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotVaccinated();
        
        $data = array("totBudgetSpent" => $totVal,
                        "totBudget" => $totVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getTotalTimeElapsedAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotVaccinated();
        
        $data = array("totBudgetSpent" => $totVal,
                        "totBudget" => $totVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function postNewPatientAction(Request $request)
    {
        $patient = new Patient();
        $detail = new MedicalDetail();
        $project = new Project();

        $data = $request->request->get('dataBag');

        $id = $data['project'];

        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('JUMAINHealthBundle:Project')->find($id);

        $patient->setFullName($data['fullName']);
        $patient->setSex($data['sex']);
        $patient->setDateOfBirth($data['dob']);
        $patient->setResidence($data['residence']);

        $detail->setVaccinationStatus($vaccinationStatus);
        $detail->setVaccinationDate($vaccinationDate);
        $detail->setEmployeeName($employeeName);
        $detail->setDescription($description);
        $detail->setCurrent(true);
        $detail->setPatient($patient);
        $detail->setProject($project);

        $em->persist($detail);
        $em->flush();

        $msg = array('message' => 'Patient Submitted Successfully', );

        $view = $this->view($msg);

        return $this->handleView($view);
    }

    public function addPatient()
    {
        $data = array("hello" => "world");

        $view = $this->view($data);

        return false;
    }

    public function getAllPatientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totPatients = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findAllRegPatients();
        /*
        $data = array("totBudgetSpent" => $totVal,
                        "totBudget" => $totVal);
        */

        $view = $this->view($totPatients);

        return $this->handleView($view);
    }

    public function postNewCommunityAction(Request $request)
    {
        $community = new Community();

        $em = $this->getDoctrine()->getManager();
        
        $data = $request->request->get('dataBag');

        $community->setCommunityName($data['communityName']);
        $community->setMaleAbv10($data['maleAbv10']);
        $community->setFemBtw10N15($data['femBtw10N15']);
        $community->setChildBel10($data['childBel10']);
        $community->setFemAbv15($data['femAbv15']);
        $community->setCurrent(true);

        $em->persist($community);
        $em->flush();

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getAllCommunitiesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totCommunity = $em->getRepository('JUMAINHealthBundle:Community')
                ->findAllRegCommunity();

        $view = $this->view($totCommunity);

        return $this->handleView($view);
    }

    public function postNewProjectAction(Request $request)
    {
        $project = new Project();

        $em = $this->getDoctrine()->getManager();
        
        $data = $request->request->get('dataBag');

        $project->setCommunityName($data['communityName']);
        $project->setMaleAbv10($data['maleAbv10']);
        $project->setFemBtw10N15($data['femBtw10N15']);
        $project->setChildBel10($data['childBel10']);
        $project->setFemAbv15($data['femAbv15']);
        $project->setCurrent(true);

        $em->persist($project);
        $em->flush();

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getAllProjectsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totProjects = $em->getRepository('JUMAINHealthBundle:Project')
                ->findAllRegProjects();
        
        $view = $this->view($totProjects);

        return $this->handleView($view);
    }
}
