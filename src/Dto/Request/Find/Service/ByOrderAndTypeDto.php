<?php

namespace App\Dto\Request\Find\Service;

use OpenApi\Attributes\Property;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ByOrderAndType
 * @package App\Dto\Request\Find\Service
 */
class ByOrderAndTypeDto extends OrderId
{
    /**
     * @var int[]
     */
    #[Assert\Type('array')]
    #[Property(description: 'Набор типов id', example: [715, 720])]
    private array $types = [];

    /**
     * @return int[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param int[] $types
     * @return $this
     */
    public function setTypes(array $types): self
    {
        $this->types = $types;

        return $this;
    }
}
