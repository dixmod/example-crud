<?php

namespace App\Dto\Request\Find\Service;

use OpenApi\Attributes\Property;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class OrderId
 * @package App\Dto\Request\Find\Service
 */
class OrderId
{
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор зака', example: 677689842)]
    private int $orderId;

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }
}
