<?php

namespace App\Dto\Request;

use App\Interfaces\EntityRequestInterface;
use OpenApi\Attributes\Property;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DcBarcodeDto
 * @package App\Dto\Request
 */
class DcBarcodeDto implements EntityRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор услуги', example: 515294403)]
    private int $serviceId;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Property(description: 'Barcode', example: 'D$ABC00915181020$TB')]
    private string $barcode;

    /**
     * @return int
     */
    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    /**
     * @param int $serviceId
     */
    public function setServiceId(int $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode(string $barcode): void
    {
        $this->barcode = $barcode;
    }
}
