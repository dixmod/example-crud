<?php

declare(strict_types=1);

namespace App\Dto\Response;

use JsonSerializable;

class PaginationDataDto implements JsonSerializable
{
    /**
     * @var array<mixed>
     */
    private $items;
    /**
     * @var int
     */
    private $perPage;
    /**
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $total;

    /**
     * @param array<mixed> $items
     */
    public function __construct(array $items, int $perPage, int $page, int $total)
    {
        $this->items = $items;
        $this->perPage = $perPage;
        $this->page = $page;
        $this->total = $total;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'items' => $this->items,
            'per-page' => $this->perPage,
            'page' => $this->page,
            'total' => $this->total,
        ];
    }

    /**
     * @return mixed[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
