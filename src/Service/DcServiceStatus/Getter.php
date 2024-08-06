<?php

declare(strict_types=1);

namespace App\Service\DcServiceStatus;

use App\Entity\DcServiceStatus;
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

    public function getById(int $id): DcServiceStatus
    {
        return $this->em->getRepository(DcServiceStatus::class)->find($id);
    }
}
