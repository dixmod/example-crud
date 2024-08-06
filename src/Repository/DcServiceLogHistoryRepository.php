<?php

namespace App\Repository;

use App\Entity\DcServiceLogHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DcServiceLogHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcServiceLogHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcServiceLogHistory[]    findAll()
 * @method DcServiceLogHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcServiceLogHistoryRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DcServiceLogHistory::class);
    }
}
