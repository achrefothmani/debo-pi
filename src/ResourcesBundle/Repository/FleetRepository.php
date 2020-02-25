<?php

namespace ResourcesBundle\Repository;

/**
 * FleetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FleetRepository extends \Doctrine\ORM\EntityRepository
{
    public function findFleets($str,$str2,$str3){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m
                FROM ResourcesBundle:Fleet m
                WHERE m.category = :str and m.nature = :str2 and m.date >= :str3'
            )
            ->setParameter('str',$str)->setParameter('str2',$str2)->setParameter('str3',$str3)
            ->getResult();
    }
}
