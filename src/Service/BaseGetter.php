<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Http\NotFoundException;
use App\Interfaces\EntityResponseInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class BaseGetter
 */
abstract class BaseGetter
{
    protected ServiceEntityRepository $commonRepository;

    protected const DEFAULT_ORDER = [
        'id' => 'asc',
    ];

    protected const DEFAULT_ORDER_DESC = [
        'id' => 'desc',
    ];

    /**
     * @param int $id
     * @return EntityResponseInterface
     * @throws NotFoundException
     */
    public function getById(int $id): EntityResponseInterface
    {
        $entity = $this->commonRepository->find($id);

        if (null === $entity) {
            throw new NotFoundException();
        }

        return $entity;
    }

    /**
     * @param int $serviceId
     * @return EntityResponseInterface[]
     */
    public function getByServiceId(int $serviceId): array
    {
        return $this->commonRepository->findBy(
            [
                'serviceId' => $serviceId,
            ],
            static::DEFAULT_ORDER
        );
    }
}
