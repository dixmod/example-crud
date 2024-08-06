<?php

namespace App\Repository;

use App\Entity\DcServiceBarcode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DcServiceBarcode|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcServiceBarcode|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcServiceBarcode[]    findAll()
 * @method DcServiceBarcode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcServiceBarcodeRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DcServiceBarcode::class);
    }
}
