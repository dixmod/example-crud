<?php

namespace App\Entity;

use App\Interfaces\EntityResponseInterface;
use App\Traits\JsonSerializeTraitRecurse;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DcServiceBarcode
 */
#[ORM\Table(name: 'additional_product_store.dc_service_barcode')]
#[ORM\Entity]
class DcServiceBarcode implements EntityResponseInterface, DescribeLabelsInterface
{
    use JsonSerializeTraitRecurse;

    public const PROPERTY_SERVICE_ID = 'serviceId';

    public const PROPERTY_ID = 'id';
    public const PROPERTY_SERVICE = 'service';
    public const PROPERTY_BARCODE = 'barcode';
    public const ENTITY_TITLE = 'Штрихкоды для услуг';

    /**
     * @var int
     */
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(
        sequenceName: 'additional_product_store.dc_service_barcode_id_seq',
        allocationSize: 1,
        initialValue: 1
    )]
    private $id;

    /**
     * @var int
     */
    #[ORM\Column(name: 'service_id', type: 'integer', nullable: false)]
    private $serviceId;

    /**
     * @var string
     */
    #[ORM\Column(name: self::PROPERTY_BARCODE, type: 'text', nullable: false)]
    private $barcode;

    #[ORM\ManyToOne(targetEntity: DcService::class, inversedBy: 'serviceBarcode')]
    private DcService $service;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

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

    public function getService(): DcService
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->barcode;
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::PROPERTY_SERVICE_ID => 'ID Услуги',
            self::PROPERTY_SERVICE => 'Услуга',
            self::PROPERTY_BARCODE => 'Штрих-код',
        ];
    }
}
