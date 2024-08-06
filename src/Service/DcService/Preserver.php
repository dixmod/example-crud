<?php

declare(strict_types=1);

namespace App\Service\DcService;

use App\Entity\DcService;
use App\Interfaces\ServiceEntityRequestInterface;
use App\Service\Common\Preserver as BasePreserver;
use App\Service\DcServiceDeviceType\Getter as GetterDeviceType;
use App\Service\DcServiceStatus\Getter as GetterStatus;

/**
 * Class Preserver
 */
class Preserver
{
    public function __construct(
        private readonly GetterStatus $getterStatus,
        private readonly GetterDeviceType $getterDeviceType,
        private readonly BasePreserver $basePreserver,
    ) {
    }

    public function updateAndSave(DcService $entity, ServiceEntityRequestInterface $params): void
    {
        if (null !== $params->getServiceStatusId()) {
            $serviceStatus = $this->getterStatus->getById($params->getServiceStatusId());

            $entity->setServiceStatus($serviceStatus);
        }

        if (null !== $params->getInsureDeviceTypeId()) {
            $insureDeviceType = $this->getterDeviceType->getById($params->getInsureDeviceTypeId());

            $entity->setInsureDeviceTypeId($insureDeviceType->getId());
            $entity->setInsureDeviceType($insureDeviceType);

            $params->setInsureDeviceTypeId(null);
        }

        $this->basePreserver->updateAndSave($entity, $params);
    }
}
