<?php

namespace App\Dto\Request\Find\Service;

use App\Interfaces\EntityRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ByOrdersDto
 * @package App\Dto\Request\Find\Service
 */
class ByOrdersDto extends OrderId implements EntityRequestInterface
{
    /**
     * @var int[]
     */
    #[Assert\Type('array')]
    private array $isStatuses = [];

    /**
     * @var int[]
     */
    #[Assert\Type('array')]
    private array $isNotStatuses = [];

    /**
     * @var int[]
     */
    #[Assert\Type('array')]
    private array $notBankIds = [];

    /**
     * @var bool
     */
    #[Assert\Type('boolean')]
    private bool $isOnlyActive = true;

    /**
     * @return array
     */
    public function getIsStatuses(): array
    {
        return $this->isStatuses;
    }

    /**
     * @param array $isStatuses
     * @return void
     */
    public function setIsStatuses(array $isStatuses): void
    {
        $this->isStatuses = $isStatuses;
    }

    /**
     * @return array
     */
    public function getIsNotStatuses(): array
    {
        return $this->isNotStatuses;
    }

    /**
     * @param array $isNotStatuses
     * @return void
     */
    public function setIsNotStatuses(array $isNotStatuses): void
    {
        $this->isNotStatuses = $isNotStatuses;
    }

    /**
     * @return int[]
     */
    public function getNotBankIds(): array
    {
        return $this->notBankIds;
    }

    /**
     * @param int[] $notBankIds
     * @return void
     */
    public function setNotBankIds(array $notBankIds): void
    {
        $this->notBankIds = $notBankIds;
    }

    public function isOnlyActive(): bool
    {
        return $this->isOnlyActive;
    }

    public function setIsOnlyActive(bool $isOnlyActive): void
    {
        $this->isOnlyActive = $isOnlyActive;
    }
}
