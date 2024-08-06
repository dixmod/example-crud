<?php

declare(strict_types=1);

namespace App\Service\DcServiceScheme;

use App\Entity\DcServiceScheme;
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

    public function getById(int $id): ?DcServiceScheme
    {
        return $this->em->getRepository(DcServiceScheme::class)->find($id);
    }
}
