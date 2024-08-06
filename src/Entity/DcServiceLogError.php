<?php

namespace App\Entity;

use App\Enum\DateTimeFormatEnum;
use App\Interfaces\EntityResponseInterface;
use App\Repository\DcServiceLogErrorRepository;
use App\Traits\JsonSerializeTraitRecurse;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DcServiceLogError
 */
#[ORM\Table(name: 'additional_product_store.dc_service_log_error')]
#[ORM\Entity(repositoryClass: DcServiceLogErrorRepository::class)]
class DcServiceLogError implements EntityResponseInterface, DescribeLabelsInterface
{
    use JsonSerializeTraitRecurse {
        jsonSerialize as private baseJsonSerialize;
    }

    public const PROPERTY_SERVICE_ID = 'serviceId';
    public const PROPERTY_ID = 'id';
    public const PROPERTY_SERVICE = 'service';
    public const PROPERTY_CREATED_AT = 'createdAt';
    public const PROPERTY_ERROR_VALUE = 'errorValue';
    public const ENTITY_TITLE = 'Лог ошибок для услуг';

    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(
        sequenceName: 'additional_product_store.dc_service_log_error_id_seq',
        allocationSize: 1,
        initialValue: 1
    )]
    private int $id;

    #[ORM\Column(name: 'service_id', type: 'integer', nullable: false)]
    private int $serviceId;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP(6)'])]
    private DateTimeInterface $createdAt;

    #[ORM\Column(name: 'error_value', type: 'text', nullable: false)]
    private string $errorValue;

    #[ORM\ManyToOne(targetEntity: DcService::class, inversedBy: 'serviceParams')]
    private DcService $service;

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setServiceId(int $serviceId): self
    {
        $this->serviceId = $serviceId;
        return $this;
    }

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setErrorValue(string $errorValue): self
    {
        $this->errorValue = $errorValue;
        return $this;
    }

    public function getErrorValue(): string
    {
        return $this->errorValue;
    }

    public function getService(): DcService
    {
        return $this->service;
    }

    /**
     * Refactoring to transformer
     */
    public function jsonSerialize(): array
    {
        $data = $this->baseJsonSerialize();

        $data[self::PROPERTY_CREATED_AT] = $this->createdAt->format(DateTimeFormatEnum::DATE_TIME);

        return $data;
    }

    public function __toString(): string
    {
        return
            $this->getCreatedAt()->format(DateTimeFormatEnum::DATE_TIME) . PHP_EOL .
            $this->getErrorValue();
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::PROPERTY_SERVICE_ID => 'ID Услуги',
            self::PROPERTY_SERVICE => 'Услуга',
            self::PROPERTY_CREATED_AT => 'Дата создания',
            self::PROPERTY_ERROR_VALUE => 'Ошибка',
        ];
    }
}
