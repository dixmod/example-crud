<?php

declare(strict_types=1);

namespace App\Service\DcServiceDeviceType;

use App\Entity\DcServiceDeviceType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Getter
 */
class Getter
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function getById(int $id): DcServiceDeviceType
    {
        return $this->em->getRepository(DcServiceDeviceType::class)->find($id);
    }
}
