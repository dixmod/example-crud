<?php

namespace App\Dto\Request\Find\Service;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ByAgentFilterDto
 * @package App\Dto\Request\Find\Service
 */
class ByAgentFilterDto
{
    #[Assert\Type('integer')]
    protected int $id = 0;

    #[Assert\Type('array')]
    private array $shopIds = [];

    #[Assert\Type('integer')]
    private int $agentId = 0;

    #[Assert\Type('array')]
    private array $outletIds = [];

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int[]
     */
    public function getShopIds(): array
    {
        return $this->shopIds;
    }

    /**
     * @param int[] $shopIds
     * @return void
     */
    public function setShopIds(array $shopIds): void
    {
        $this->shopIds = $shopIds;
    }

    /**
     * @return int
     */
    public function getAgentId(): int
    {
        return $this->agentId;
    }

    /**
     * @param int $agentId
     * @return void
     */
    public function setAgentId(int $agentId): void
    {
        $this->agentId = $agentId;
    }

    /**
     * @return int[]
     */
    public function getOutletIds(): array
    {
        return $this->outletIds;
    }

    /**
     * @param int[] $outletIds
     * @return void
     */
    public function setOutletIds(array $outletIds): void
    {
        $this->outletIds = $outletIds;
    }
}
