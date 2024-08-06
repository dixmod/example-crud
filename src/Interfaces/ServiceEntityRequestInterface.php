<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * Interface ServiceEntityRequestInterface
 */
interface ServiceEntityRequestInterface extends EntityRequestInterface
{
    public function getServiceStatusId(): ?int;

    public function getInsureDeviceTypeId(): ?int;

    public function setInsureDeviceTypeId(?int $insureDeviceTypeId): self;
}
