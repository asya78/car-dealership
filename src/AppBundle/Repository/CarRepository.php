<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Car;

/**
 * CarRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllCarBy($make){

        $make = ucfirst($make);

        return $this
            ->createQueryBuilder('p')
            ->where('p.make = :make')
            ->setParameter('make', $make)
            ->orderBy('p.model','ASC')
            ->orderBy('p.travelledDistance', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
