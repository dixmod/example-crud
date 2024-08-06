<?php

namespace App\Entity;

use App\Interfaces\EntityResponseInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DcServiceScheme
 */
#[ORM\Table(name: 'additional_product_store.card_schemes')]
#[ORM\Entity]
class DcServiceScheme implements EntityResponseInterface, DescribeLabelsInterface
{
    public const PROPERTY_ID = 'id';
    public const PROPERTY_SCHEME_NAME = 'schemeName';
    public const PROPERTY_XML_ID = 'xmlId';
    public const ENTITY_TITLE = 'Cправочник схем оформления';

    #[ORM\Column(name: self::PROPERTY_ID, type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(
        sequenceName: 'additional_product_store.card_schemes_id_seq',
        allocationSize: 1,
        initialValue: 1
    )]
    private int $id;

    #[ORM\Column(name: 'uf_name', type: 'string', length: 255, nullable: false)]
    private string $schemeName;

    #[ORM\Column(name: 'uf_xml_id', type: 'text', nullable: true)]
    private ?string $xmlId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSchemeName(): string
    {
        return $this->schemeName;
    }

    public function getXmlId(): ?string
    {
        return $this->xmlId;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setSchemeName(string $schemeName): void
    {
        $this->schemeName = $schemeName;
    }

    public function setXmlId(?string $xmlId): void
    {
        $this->xmlId = $xmlId;
    }

    public function jsonSerialize(): string
    {
        return $this->getSchemeName();
    }

    public function __toString(): string
    {
        return $this->schemeName;
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::PROPERTY_ID => 'Идентификатор',
            self::PROPERTY_SCHEME_NAME => 'Наименование',
            self::PROPERTY_XML_ID => 'Код',
        ];
    }
}
