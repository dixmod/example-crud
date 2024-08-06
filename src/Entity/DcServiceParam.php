<?php

namespace App\Entity;

use App\Interfaces\EntityResponseInterface;
use App\Repository\DcServiceParamRepository;
use App\Traits\JsonSerializeTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DcServiceParam
 */
#[ORM\Table(name: 'additional_product_store.dc_service_param')]
#[ORM\Entity(repositoryClass: DcServiceParamRepository::class)]
class DcServiceParam implements EntityResponseInterface, DescribeLabelsInterface
{
    use JsonSerializeTrait {
        jsonSerialize as private baseJsonSerialize;
    }

    public const PROPERTY_SERVICE_ID = 'serviceId';
    public const PROPERTY_SIGN_TYPE_SELECTED = 'signTypeSelected';
    public const PROPERTY_SIGN_TYPE_ALLOW = 'signTypeAllow';
    public const PROPERTY_CUSTOM_SERVICE_DATA = 'customServiceData';
    public const PROPERTY_SMSCODE_COUNT_CAN_SEND = 'smscodeCountCanSend';
    public const PROPERTY_SMSCODE_COUNT_CAN_CHECK = 'smscodeCountCanCheck';
    public const PROPERTY_SMSCODE_COUNT_SEND = 'smscodeCountSend';
    public const PROPERTY_SMSCODE_COUNT_CHECK = 'smscodeCountCheck';
    public const ENTITY_TITLE = 'Дополнительные параметры услуг';
    public const TEMPLATE_TITLE = '%s (%s) -- %s';

    #[ORM\Column(
        name: 'service_id',
        type: 'integer',
        nullable: false,
        options: ['comment' => 'Связь 1 m1 dc_service \\']
    )]
    #[ORM\Id]
    private int $serviceId;

    #[ORM\Column(
        name: 'sign_type_selected',
        type: 'string',
        length: 20,
        nullable: true,
        options: ['comment' => 'Выбранный тип подписания']
    )]
    private ?string $signTypeSelected;

    #[ORM\Column(
        name: 'sign_type_allow',
        type: 'string',
        length: 100,
        nullable: true,
        options: ['comment' => 'Доступные типы подписания']
    )]
    private ?string $signTypeAllow;

    #[ORM\Column(name: 'custom_service_data', type: 'text', nullable: true)]
    private ?string $customServiceData;

    #[ORM\Column(name: 'smscode_count_send', type: 'integer', nullable: true)]
    private ?int $smscodeCountSend;

    #[ORM\Column(name: 'smscode_count_can_send', type: 'integer', nullable: true)]
    private ?int $smscodeCountCanSend;

    #[ORM\Column(name: 'smscode_count_check', type: 'integer', nullable: true)]
    private ?int $smscodeCountCheck;

    /** One Cart has One Customer. */
    #[ORM\OneToOne(inversedBy: 'serviceParams', targetEntity: DcService::class)]
    #[ORM\JoinColumn(name: 'service_id', referencedColumnName: 'id')]
    private ?DcService $service;

    /**
     * @var int|null
     */
    #[ORM\Column(name: 'smscode_count_can_check', type: 'integer', nullable: true)]
    private ?int $smscodeCountCanCheck;

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $serviceId): self
    {
        $this->serviceId = $serviceId;
        return $this;
    }

    public function getSignTypeSelected(): ?string
    {
        return $this->signTypeSelected;
    }

    public function setSignTypeSelected(string $signTypeSelected): self
    {
        $this->signTypeSelected = $signTypeSelected;
        return $this;
    }

    public function getSignTypeAllow(): ?string
    {
        return $this->signTypeAllow;
    }

    public function setSignTypeAllow(?string $signTypeAllow): self
    {
        $this->signTypeAllow = $signTypeAllow;
        return $this;
    }

    public function getCustomServiceData(): ?string
    {
        return $this->customServiceData;
    }

    public function setCustomServiceData(?string $customServiceData): self
    {
        $this->customServiceData = $customServiceData;
        return $this;
    }

    public function getSmscodeCountSend(): ?int
    {
        return $this->smscodeCountSend;
    }

    public function setSmscodeCountSend(?int $smscodeCountSend): self
    {
        $this->smscodeCountSend = $smscodeCountSend;
        return $this;
    }

    public function getSmscodeCountCanSend(): ?int
    {
        return $this->smscodeCountCanSend;
    }

    public function setSmscodeCountCanSend(?int $smscodeCountCanSend): self
    {
        $this->smscodeCountCanSend = $smscodeCountCanSend;
        return $this;
    }

    public function getSmscodeCountCheck(): ?int
    {
        return $this->smscodeCountCheck;
    }

    public function setSmscodeCountCheck(?int $smscodeCountCheck): self
    {
        $this->smscodeCountCheck = $smscodeCountCheck;
        return $this;
    }

    public function getSmscodeCountCanCheck(): ?int
    {
        return $this->smscodeCountCanCheck;
    }

    public function setSmscodeCountCanCheck(?int $smscodeCountCanCheck): self
    {
        $this->smscodeCountCanCheck = $smscodeCountCanCheck;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $labels = self::labels();
        $data = [];

        $data[self::PROPERTY_SIGN_TYPE_SELECTED] = $this->getSignTypeSelected();
        $data[self::PROPERTY_SIGN_TYPE_ALLOW] = $this->getSignTypeAllow();
        $data[self::PROPERTY_CUSTOM_SERVICE_DATA] = $this->getCustomServiceData();
        $data[self::PROPERTY_SMSCODE_COUNT_CAN_CHECK] = $this->getSmscodeCountCanCheck();
        $data[self::PROPERTY_SMSCODE_COUNT_CAN_SEND] = $this->getSmscodeCountCanSend();
        $data[self::PROPERTY_SMSCODE_COUNT_SEND] = $this->getSmscodeCountSend();
        $data[self::PROPERTY_SMSCODE_COUNT_CHECK] = $this->getSmscodeCountCheck();

        foreach ($data as $key => $value) {
            $data[$key] = sprintf(
                self::TEMPLATE_TITLE . PHP_EOL,
                $labels[$key],
                $key,
                $value,
            );
        }

        return implode('. ', $data);
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::PROPERTY_SERVICE_ID => 'ID Услуги',
            self::PROPERTY_SIGN_TYPE_SELECTED => 'Выбранный тип подписания',
            self::PROPERTY_SIGN_TYPE_ALLOW => 'Доступные типы подписания',
            self::PROPERTY_CUSTOM_SERVICE_DATA => 'Дополнительные поля (в json-формате)',
            self::PROPERTY_SMSCODE_COUNT_CAN_SEND => 'Сколько раз можно запросить смс-код',
            self::PROPERTY_SMSCODE_COUNT_CAN_CHECK => 'Сколько раз можно проверить смс-код',
            self::PROPERTY_SMSCODE_COUNT_SEND => 'Сколько раз запрошен смс-код',
            self::PROPERTY_SMSCODE_COUNT_CHECK => 'Сколько раз проверен смс-код',
        ];
    }

    /**
     * @param DcService|null $service
     * @return void
     */
    public function setService(?DcService $service): void
    {
        $this->service = $service;
    }
}
