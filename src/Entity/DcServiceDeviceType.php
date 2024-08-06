<?php

namespace App\Entity;

use App\Interfaces\EntityResponseInterface;
use App\Traits\JsonSerializeTraitRecurse;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DcServiceDeviceType
 */
#[ORM\Table(name: 'additional_product_store.dc_service_device_type')]
#[ORM\Entity]
class DcServiceDeviceType implements EntityResponseInterface, DescribeLabelsInterface
{
    use JsonSerializeTraitRecurse;

    public const PROPERTY_ID = 'id';
    public const PROPERTY_DEVICE_TYPE_NAME = 'deviceTypeName';
    public const PROPERTY_XML_ID = 'xmlId';
    public const ENTITY_TITLE = 'Тип устройств для услуг';

    #[ORM\Column(name: self::PROPERTY_ID, type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(
        sequenceName: 'additional_product_store.dc_service_device_type_id_seq',
        allocationSize: 1,
        initialValue: 1
    )]
    private int $id;

    #[ORM\Column(name: 'device_type_name', type: 'string', length: 255, nullable: false)]
    private string $deviceTypeName;

    #[ORM\Column(name: 'xml_id', type: 'text', nullable: true)]
    private ?string $xmlId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDeviceTypeName(): string
    {
        return $this->deviceTypeName;
    }

    public function setDeviceTypeName(string $deviceTypeName): void
    {
        $this->deviceTypeName = $deviceTypeName;
    }

    public function getXmlId(): ?string
    {
        return $this->xmlId;
    }

    public function setXmlId(?string $xmlId): void
    {
        $this->xmlId = $xmlId;
    }

    public function __toString(): string
    {
        return $this->deviceTypeName;
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return
            [
                self::PROPERTY_ID => 'Идентификатор',
                self::PROPERTY_DEVICE_TYPE_NAME => 'Наименование',
            ];
    }
}
