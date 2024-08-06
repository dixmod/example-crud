<?php

namespace App\Dto\Request\Find;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Paginator
 * @package App\Dto\Request\Find
 */
class Paginator
{
    #[OA\Property(description: 'Смещение вывода (page-1) * limit ', default: 0, example: 40)]
    #[Assert\Type('integer')]
    #[Assert\Range(min: 0)]
    private int $offset = 0;

    #[OA\Property(description: 'Количество на странице', default: 20, example: 20)]
    #[Assert\Type('integer')]
    #[Assert\Range(min: 1)]
    private int $limit = 20;

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }
}
