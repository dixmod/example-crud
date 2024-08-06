<?php

namespace App\Dto\Request\Find\Service;

use OpenApi\Attributes\Property;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ContractAuthByOrderDto
 * @package App\Dto\Request\Find\Service
 */
class ContractAuthByOrderDto extends OrderId
{
    /**
     * @var int[]
     */
    #[Assert\Type('array')]
    #[Property(description: 'Набор id', example: [1099, 2000])]
    private array $excludeIds = [];

    /**
     * @return int[]
     */
    public function getExcludeIds(): array
    {
        return $this->excludeIds;
    }

    /**
     * @param int[] $excludeIds
     */
    public function setExcludeIds(array $excludeIds): void
    {
        $this->excludeIds = $excludeIds;
    }
}
