<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Supplier;

/**
 * SupplierRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SupplierRepository extends \Doctrine\ORM\EntityRepository
{


        public function getSupplierByImporter($isImporter){

            if ($isImporter == 'local') $destination = 0; else $destination = 1;
            return $this
                ->createQueryBuilder('s')
                ->where('s.isImporter = :destination')
                ->setParameter('destination', $destination)
                ->addOrderBy('s.id', 'ASC')
                ->getQuery()
                ->getResult();

        }

}
