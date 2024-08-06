<?php

namespace App\Repository;

use App\Entity\DcService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DcService|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcService|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcService[]    findAll()
 * @method DcService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcServiceRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DcService::class);
    }
}
