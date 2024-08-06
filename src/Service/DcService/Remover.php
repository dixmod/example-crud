<?php

declare(strict_types=1);

namespace App\Service\DcService;

use App\Entity\DcService;
use App\Exception\Http\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Remover
 */
class Remover
{
    public function __construct(
        private readonly RepositoryGetter $getter,
        private readonly EntityManagerInterface $em
    ) {
    }

    /**
     * @param int $id
     * @return void
     * @throws NotFoundException
     */
    public function remove(int $id): void
    {
        $entity = $this->getter->getById($id);
        if (!$entity instanceof DcService) {
            throw new NotFoundException('Entity has not remove functional');
        }

        $entity->setActive(false);
        $this->em->persist($entity);
        $this->em->flush();
    }
}
