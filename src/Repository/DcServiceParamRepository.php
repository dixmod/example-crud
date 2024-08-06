<?php

namespace App\Repository;

use App\Entity\DcServiceParam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DcServiceParam|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcServiceParam|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcServiceParam[]    findAll()
 * @method DcServiceParam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcServiceParamRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DcServiceParam::class);
    }
}
