<?php

namespace JUMAIN\HealthBundle\Repository;

/**
 * CommunityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommunityRepository extends \Doctrine\ORM\EntityRepository
{
	public function findAllRegCommunity(){
    $communities = $this->getEntityManager()
                    ->createQuery(
                    'SELECT c FROM JUMAINHealthBundle:Community c
                    ORDER BY c.communityName ASC ')
                    ->getResult();
    return $communities;
  }
}
