<?php

namespace JUMAIN\HealthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use JMS\Serializer\Annotation as JMS;

use JUMAIN\HealthBundle\Entity\Project;
use JUMAIN\HealthBundle\Entity\Community;
use JUMAIN\HealthBundle\Entity\Patient;
use JUMAIN\HealthBundle\Entity\MedicalDetail;

class DefaultController extends FOSRestController
{
    public function indexAction()
    {
        $data = array("hello" => "Hello! World, Welcome to the API");

        $view = $this->view($data);

        return $this->handleView($view);
    }

    /////////////////////////////// Dashboard Actions //////////////////////////////////////////////

    public function getNumAllTotalVaccinatedAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfAllPatientsVacc();

        $data = array("totVal" => $totVal+0);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getNumAllPatientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $totPatients = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfPatients();
        
        $data = array("totPatients" => $totPatients+0);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getNumCompProjectsAction()
    {
        $em = $this->getDoctrine()->getManager();
        /*$totPatients = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfPatients();*/
        
        $data = array("totComp" => 0);


        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getNumProjectsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $numProjects = $em->getRepository('JUMAINHealthBundle:Project')
                ->getNumOfProjects();
        
        $data = array("numProjects" => $numProjects + 0);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    public function getRecentlyAddedPatientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $recPate = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findAllRecRegPatients();
        
        //$data = array("numProjects" => $numProjects + 0);

        $view = $this->view($recPate);

        return $this->handleView($view);
    }

    public function getProjectCompletionStatsAction()
    {
        $projectNamesArray = array();

        $deDataArray = array();

        $em = $this->getDoctrine()->getManager();

        $allProjects = $em->getRepository('JUMAINHealthBundle:Project')
                ->findAllRegProjects();

        foreach ($allProjects as $project) {
            # code...
            array_push($projectNamesArray, $project->getProjectName());
            
            $totNumber = $project->getCommunity()->getChildBel10();

            $numVacc = $this->getProjectDetails($project) + 0;

            $percntVal = ($numVacc/$totNumber) * 100;

            array_push($deDataArray, round($percntVal, 2));
        }

        $deDsData = new MyBarChartDataSetObj("Percentage Completed", "rgba(220,220,220,0.5)", "rgba(220,220,220,0.8)", "rgba(220,220,220,0.75)", "rgba(220,220,220,1)", $deDataArray);

        $myDsObj = [$deDsData];

        $resData = new PieChrtData($projectNamesArray, $myDsObj);

        //$data = array("numProjects" => $numProjects + 0);

        $view = $this->view($resData);

        return $this->handleView($view);
    }

    public function getProjectImpactAction($projectId)
    {
        $labelsArray = array();

        $deDataArray = array();

        $em = $this->getDoctrine()->getManager();

        $project = new Project();

        $project = $em->getRepository('JUMAINHealthBundle:Project')
                ->find($projectId);
        
        $strtDate = $project->getProjectStrtDate();
        
        //$strtDate = date_create($stDate);

        // Set timezone
        date_default_timezone_set('Africa/Lagos');

        $today = date('Y-m-d');

        //$today = $today->format('Y-m-d');
        $strtDate = $strtDate->format('Y-m-d');
        

        while (strtotime($strtDate) <= strtotime($today)) {
            //echo $strtDate->format('Y-m-d');

            array_push($labelsArray, $strtDate);

            $numHealthy = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfHealthyPatientsByProjectByDate($project, $strtDate);

            array_push($deDataArray, $numHealthy + 0);

            $strtDate = date ("Y-m-d", strtotime("+3 day", strtotime($strtDate)));
        }
        /*
        for ($date = strtotime($strtDate->format('Y-m-d')); $date < strtotime($today); $date = strtotime("+3 day", $date)) {
            //echo date("Y-m-d", $date)."";
            array_push($labelsArray, date("Y-m-d", $date));

            $numHealthy = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfHealthyPatientsByProjectByDate($project, date_create($date));

            array_push($deDataArray, $numHealthy);
        }
        */
        /*


        for ($i=$strtDate; $i < $today; date_add($i, date_interval_create_from_date_string('3 days'))) { 
            # code...
            array_push($labelsArray, $i);

            $numHealthy = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfHealthyPatientsByProjectByDate($project, $i);

            array_push($deDataArray, $numHealthy);
        }
        */
        $deDsData = new MyBarChartDataSetObj("Project Impact", "rgba(220,220,220,0.5)", "rgba(220,220,220,0.8)", "rgba(220,220,220,0.75)", "rgba(220,220,220,1)", $deDataArray);

        $myDsObj = [$deDsData];

        $resData = new PieChrtData($labelsArray, $myDsObj);

        $data = array("numProjects" => $strtDate);

        $view = $this->view($resData);

        return $this->handleView($view);
    }

    /////////////////////////////// End Dashboard Actions //////////////////////////////////////////

    /////////////////////////////// Patients Actions //////////////////////////////////////////////

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

        $view = $this->view($totPatients);

        return $this->handleView($view);
    }

    /////////////////////////////// End Patients Actions //////////////////////////////////////////

    /////////////////////////////// Communities Actions //////////////////////////////////////////////

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

    /////////////////////////////// End Communities Actions //////////////////////////////////////////

    /////////////////////////////// Projects Actions //////////////////////////////////////////////

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

    /////////////////////////////// End Projects Actions //////////////////////////////////////////

    /////////////////////////////// Reports Actions //////////////////////////////////////////////
    
    /*///
    /// To get number of all vaccinated patients for each project
    /// the route /api/AllNumVaccByProj
    */
    public function getAllVaccForProjectsAction()
    {
        $projectNamesArray = array();
        $deDataArray = array();
        $em = $this->getDoctrine()->getManager();

        $allProjects = $em->getRepository('JUMAINHealthBundle:Project')
                ->findAllRegProjects();

        foreach ($allProjects as $project) {
            # code...
            array_push($projectNamesArray, $project->getProjectName());
            
            $numVal = $this->getProjectDetails($project) + 0;

            array_push($deDataArray, $numVal);
        }



        $deDsData = new MyBarChartDataSetObj("Children Vaccinated", "rgba(220,220,220,0.5)", "rgba(220,220,220,0.8)", "rgba(220,220,220,0.75)", "rgba(220,220,220,1)", $deDataArray);

        $myDsObj = [$deDsData];

        $data = array("totValue" => "totValue");

        $resData = new PieChrtData($projectNamesArray, $myDsObj);


        $view = $this->view($resData);

        return $this->handleView($view);
    }

    public function getProjectDetails(Project $project)
    {
        # code...
        $em = $this->getDoctrine()->getManager();

        $numVacc = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfPatientsVaccByProject($project);

        return $numVacc;
    }

    public function getProjectDetailsByDate(Project $project, $dateValue)
    {
        # code...
        $em = $this->getDoctrine()->getManager();

        $numVacc = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfPatientsVaccByProject($project, $dateValue);

        return $numVacc;
    }

    /*///
    /// To get number of all vaccinated patients for each project by selected date
    */
    public function getVaccForProjectsByDateAction($dateValue)
    {
        $projectNamesArray = array();
        $deDataArray = array();
        $em = $this->getDoctrine()->getManager();

        $allProjects = $em->getRepository('JUMAINHealthBundle:Project')
                ->findAllRegProjects();

        foreach ($allProjects as $project) {
            # code...
            array_push($projectNamesArray, $project->getProjectName());
            
            $numVal = $this->getProjectDetailsByDate($project, $dateValue) + 0;

            array_push($deDataArray, $numVal);
        }

        $deDsData = new MyBarChartDataSetObj("Children Vaccinated", "rgba(220,220,220,0.5)", "rgba(220,220,220,0.8)", "rgba(220,220,220,0.75)", "rgba(220,220,220,1)", $deDataArray);

        $myDsObj = [$deDsData];

        $data = array("totValue" => "totValue");

        $resData = new PieChrtData($projectNamesArray, $myDsObj);

        $view = $this->view($resData);

        return $this->handleView($view);
    }

    public function getTotalVaccinatedAction($projectId)
    {
        $em = $this->getDoctrine()->getManager();

        $project = new Project();
        $project = $em->getRepository('JUMAINHealthBundle:Project')
                ->find($projectId);

        $numToBeVacc = $project->getCommunity()->getChildBel10();

        $vaccVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfPatientsVaccByProject($project);

        $totPatientsInProj = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfPatientsByProject($project);

        $ntVacc = $totPatientsInProj - $vaccVal;

        $ntRegistered = $numToBeVacc - $totPatientsInProj;

        $deData = [$vaccVal, $ntVacc, $ntRegistered];
        
        $myDSeObj = new MyDataSetObj($deData, ["#FF6384","#36A2EB","#FFCE56"], ["#FF6384","#36A2EB","#FFCE56"]);
        
        $labelsData = ["Vaccinated", "Rejected", "Not Registered"];
        $dataSets = [$myDSeObj];

        $resData = new PieChrtData($labelsData, $dataSets);

        $view = $this->view($resData);

        return $this->handleView($view);
    }

    

    public function getTotalBudgetSpentAction($projectId)
    {
        $em = $this->getDoctrine()->getManager();

        $project = new Project();
        $project = $em->getRepository('JUMAINHealthBundle:Project')
                ->find($projectId);
        $numToBeVacc = $project->getCommunity()->getChildBel10();
        $totBudget = $project->getBudget();

        $costPerChld = $totBudget / $numToBeVacc;

        $numOfPatientsInProj = $em->getRepository('JUMAINHealthBundle:Patient')
                ->getNumOfPatientsByProject($project);

        $totSpent = $costPerChld * $numOfPatientsInProj;
        $unSpent = $totBudget - $totSpent;

        $obj1 = new chrtData(round($unSpent, 2), 'UnSpent');
        $obj2 = new chrtData(round($totSpent, 2), 'Spent');

        $chartData = [$obj1, $obj2];

        $view = $this->view($chartData);

        return $this->handleView($view);
    }

    public function getTotalTimeUsedAction($projectId)
    {
        $em = $this->getDoctrine()->getManager();
        $totVal = $em->getRepository('JUMAINHealthBundle:Patient')
                ->findTotVaccinated();
        
        $data = array("totBudgetSpent" => $totVal,
                        "totBudget" => $totVal);

        $view = $this->view($data);

        return $this->handleView($view);
    }

    /*///
    /// To get number of all vaccinated patients for each project by date
    /// the route /api/AllNumVaccByProj
    */
    public function getProjectsPatientsVaccinatedByDateAction($dateValue)
    {
        $projectNamesArray = array();
        $deDataArray = array();
        $em = $this->getDoctrine()->getManager();

        $allProjects = $em->getRepository('JUMAINHealthBundle:Project')
                ->findAllRegProjects();

        foreach ($allProjects as $project) {
            # code...
            array_push($projectNamesArray, $project->getProjectName());
            
            $numVal = $this->getProjectDetails($project) + 0;

            array_push($deDataArray, $numVal);
        }



        $deDsData = new MyBarChartDataSetObj("Children Vaccinated", "rgba(220,220,220,0.5)", "rgba(220,220,220,0.8)", "rgba(220,220,220,0.75)", "rgba(220,220,220,1)", $deDataArray);

        $myDsObj = [$deDsData];

        $data = array("totValue" => "totValue");

        $resData = new PieChrtData($projectNamesArray, $myDsObj);


        $view = $this->view($resData);

        return $this->handleView($view);
    }

    /////////////////////////////// End Reports Actions //////////////////////////////////////////

    /////////////////////////////// Other Actions //////////////////////////////////////////////

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

    

    

    
}

/**
* 
*/
class chrtData
{
    public $value;
    public $label;
    
    function __construct($value, $label)
    {
        # code...
        $this->value = $value;
        $this->label = $label;
    }
}

/**
* 
*/
class PieChrtData
{
    public $labels;
    public $datasets;
    
    function __construct($labels, $datasets)
    {
        # code...
        $this->labels = $labels;
        $this->datasets = $datasets;
    }
}

/**
* 
*/
class MyDataSetObj
{
    public $data;
    /**
     * @var integer
     *
     * @JMS\SerializedName("backgroundColor")
     */
    public $backgroundColor;
    /**
     * @var integer
     *
     * @JMS\SerializedName("hoverBackgroundColor")
     */
    public $hoverBackgroundColor;
    
    function __construct($data, $backgroundColor, $hoverBackgroundColor)
    {
        # code...
        $this->data = $data;
        $this->backgroundColor = $backgroundColor;
        $this->hoverBackgroundColor = $hoverBackgroundColor;
    }
}

/**
* 
*/
class MyBarChartDataSetObj
{
    public $label;
    /**
     * @var integer
     *
     * @JMS\SerializedName("fillColor")
     */
    public $fillColor;
    /**
     * @var integer
     *
     * @JMS\SerializedName("strokeColor")
     */
    public $strokeColor;
    /**
     * @var integer
     *
     * @JMS\SerializedName("highlightFill")
     */
    public $highlightFill;
    /**
     * @var integer
     *
     * @JMS\SerializedName("highlightStroke")
     */
    public $highlightStroke;
    public $data;
    
    function __construct($label, $fillColor, $strokeColor, $highlightFill, $highlightStroke, $data)
    {
        # code...
        $this->label = $label;
        $this->fillColor = $fillColor;
        $this->strokeColor = $strokeColor;
        $this->highlightFill = $highlightFill;
        $this->highlightStroke = $highlightStroke;
        $this->data = $data;
    }
}