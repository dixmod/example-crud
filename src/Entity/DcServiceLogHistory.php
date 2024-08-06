<?php

namespace App\Entity;

use App\Enum\DateTimeFormatEnum;
use App\Interfaces\EntityResponseInterface;
use App\Repository\DcServiceLogHistoryRepository;
use App\Traits\JsonSerializeTraitRecurse;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DcServiceLogHistory
 */
#[ORM\Table(name: 'additional_product_store.dc_service_log_history')]
#[ORM\Entity(repositoryClass: DcServiceLogHistoryRepository::class)]
class DcServiceLogHistory implements EntityResponseInterface, DescribeLabelsInterface
{
    use JsonSerializeTraitRecurse {
        jsonSerialize as private baseJsonSerialize;
    }

    public const PROPERTY_SERVICE_ID = 'serviceId';
    public const PROPERTY_SERVICE = 'service';
    public const PROPERTY_CREATED_AT = 'createdAt';
    public const PROPERTY_HISTORY_VALUE = 'historyValue';
    public const PROPERTY_ID = 'id';
    public const ENTITY_TITLE = 'История для услуг';

    #[ORM\Column(name: self::PROPERTY_ID, type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(
        sequenceName: 'additional_product_store.dc_service_log_history_id_seq',
        allocationSize: 1,
        initialValue: 1
    )]
    private int $id;

    #[ORM\Column(name: 'service_id', type: 'integer', nullable: false)]
    private int $serviceId;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP(6)'])]
    private DateTimeInterface $createdAt;

    #[ORM\Column(name: 'history_value', type: 'text', nullable: false)]
    private string $historyValue;

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

    final public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    final public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setHistoryValue(string $historyValue): self
    {
        $this->historyValue = $historyValue;
        return $this;
    }

    final public function getHistoryValue(): string
    {
        return $this->historyValue;
    }

    final public function getService(): DcService
    {
        return $this->service;
    }

    public function setService(DcService $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::PROPERTY_ID => 'Идентификатор',
            self::PROPERTY_SERVICE_ID => 'ID Услуги',
            self::PROPERTY_SERVICE => 'Услуга',
            self::PROPERTY_CREATED_AT => 'Дата создания',
            self::PROPERTY_HISTORY_VALUE => 'Событие',
        ];
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return
            $this->getCreatedAt()->format(DateTimeFormatEnum::DATE_TIME) . PHP_EOL .
            $this->getHistoryValue();
    }
}
