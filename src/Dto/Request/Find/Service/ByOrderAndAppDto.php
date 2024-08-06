<?php

namespace App\Dto\Request\Find\Service;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ByOrderAndApp
 * @package App\Dto\Request\Find\Service
 */
class ByOrderAndAppDto extends OrderId
{
    /**
     * @var int[]
     */
    #[Assert\Type('array')]
    private array $appIds = [];

    /**
     * @return int[]
     */
    public function getAppIds(): array
    {
        return $this->appIds;
    }

    /**
     * @param int[] $appIds
     */
    public function setAppIds(array $appIds): void
    {
        $this->appIds = $appIds;
    }
}
