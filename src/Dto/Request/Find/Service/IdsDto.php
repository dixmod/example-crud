<?php

namespace App\Dto\Request\Find\Service;

use App\Interfaces\EntityRequestInterface;
use OpenApi\Attributes\Property;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class IdsDto
 * @package App\Dto\Request\Find\Service
 */
class IdsDto implements EntityRequestInterface
{
    /**
     * @var int[]
     */
    #[Assert\NotBlank]
    #[Assert\Type('array')]
    #[Property(description: 'Набор id', example: [1099, 2000])]
    private array $ids;

    /**
     * @return int[]
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    /**
     * @param int[] $ids
     * @return void
     */
    public function setIds(array $ids): void
    {
        $this->ids = $ids;
    }
}
