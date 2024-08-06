<?php

declare(strict_types=1);

namespace App\Service\DcServiceParam;

use App\Entity\DcServiceParam;
use App\Repository\DcServiceParamRepository;
use App\Service\BaseGetter;

/**
 * Class Getter
 */
class Getter extends BaseGetter
{
    protected const DEFAULT_ORDER = [];

    public function __construct(
        protected DcServiceParamRepository $repository
    ) {
        $this->commonRepository = $this->repository;
    }

    /**
     * @param int $serviceId
     * @return DcServiceParam[]
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
