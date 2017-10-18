<?php

namespace JUMAIN\HealthBundle\DataFixtures\ORM;


use JUMAIN\HealthBundle\Entity\Project;
use JUMAIN\HealthBundle\Entity\Community;
use JUMAIN\HealthBundle\Entity\Patient;
use JUMAIN\HealthBundle\Entity\MedicalDetail;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $outProject =new Project();
        // create 5 Communities! Bam!
        for ($i = 0; $i < 5; $i++) {
            $community = new Community();
            $community->setCommunityName('Community '.$i);
            $community->setMaleAbv10(mt_rand(680, 9820));
            $community->setFemBtw10N15(mt_rand(768, 6300));
            $community->setChildBel10(mt_rand(400, 8980));
            $community->setFemAbv15(mt_rand(1900, 79060));
            $community->setCurrent(true);

            //$manager->persist($community);

            $project = new Project();
            $project->setProjectName('Project '.$i);
            $project->setDescription('Description '.$i);
            $project->setNumOfFieldWorkers(mt_rand(10, 100));
            $project->setTimeSpan(mt_rand(40, 80));
            $project->setBudget(mt_rand(28900, 67900));
            $project->setCommunity($community);
            $project->setProjectStrtDate(new \DateTime('now'));
            $project->setProjectStatus('done');

            $manager->persist($project);

            $outProject = $project;
        }

        // create 5 Patient! Bam!
        for ($i = 0; $i < 5; $i++) {
            $patient = new Patient();
            $patient->setFullName('Patient '.$i);
            $patient->setSex('male');
            $patient->setDateOfBirth(new \DateTime('now'));
            $patient->setResidence('residence ' . $i);

            //$manager->persist($patient);


            $detail = new MedicalDetail();
            $detail->setVaccinationStatus('done');
            $detail->setVaccinationDate(new \DateTime('now'));
            $detail->setEmployeeName('EMPLOYEE ' . $i);
            $detail->setDescription('Description ' . $i);
            $detail->setCurrent(true);
            $detail->setPatient($patient);
            $detail->setProject($outProject);

            $manager->persist($detail);
        }

        $manager->flush();
    }
}