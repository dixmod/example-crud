<?php

namespace App\Entity;

use App\Interfaces\EntityResponseInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DcServiceStatus
 */
#[ORM\Table(name: 'additional_product_store.dc_service_status')]
#[ORM\Entity]
class DcServiceStatus implements EntityResponseInterface, DescribeLabelsInterface
{
    public const PROPERTY_ID = 'id';
    public const PROPERTY_STATUS_NAME = 'statusName';
    public const PROPERTY_XML_ID = 'xmlId';
    public const ENTITY_TITLE = 'Cправочник статусов услуг';

    #[ORM\Column(name: self::PROPERTY_ID, type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(
        sequenceName: 'additional_product_store.dc_service_status_id_seq',
        allocationSize: 1,
        initialValue: 1
    )]
    private int $id;

    #[ORM\Column(name: 'status_name', type: 'string', length: 255, nullable: false)]
    private string $statusName;

    #[ORM\Column(name: 'xml_id', type: 'text', nullable: true)]
    private ?string $xmlId;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatusName(): string
    {
        return $this->statusName;
    }

    /**
     * @return string|null
     */
    public function getXmlId(): ?string
    {
        return $this->xmlId;
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
     * @param string $statusName
     * @return void
     */
    public function setStatusName(string $statusName): void
    {
        $this->statusName = $statusName;
    }

    /**
     * @param string|null $xmlId
     * @return void
     */
    public function setXmlId(?string $xmlId): void
    {
        $this->xmlId = $xmlId;
    }

    /**
     * @return array<string, mixed>
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function jsonSerialize(): array
    {
        return ['name' => $this->getStatusName()];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->statusName;
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::PROPERTY_ID => 'Идентификатор',
            self::PROPERTY_STATUS_NAME => 'Наименование',
        ];
    }
}
