<?php

namespace App\Repository;

use App\Entity\DcServiceLogError;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DcServiceLogError|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcServiceLogError|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcServiceLogError[]    findAll()
 * @method DcServiceLogError[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcServiceLogErrorRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DcServiceLogError::class);
    }
}
