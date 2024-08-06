<?php

declare(strict_types=1);

namespace App\Service\Common;

use App\Exception\Http\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class RepositoryResolver
 */
class RepositoryResolver
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @param string $classEntity
     * @return EntityRepository
     * @throws NotFoundException
     */
    public function get(string $classEntity): EntityRepository
    {
        $entityClassName = $this->getEntityClassName($classEntity);
        return $this->entityManager->getRepository($entityClassName);
    }

    /**
     * @param string $classEntity
     * @return string
     * @throws NotFoundException
     */
    private function getEntityClassName(string $classEntity): string
    {
        $classEntity = 'App\Entity\\' . ucfirst($classEntity);

        if (!class_exists($classEntity)) {
            throw new NotFoundException();
        }

        return $classEntity;
    }
}
