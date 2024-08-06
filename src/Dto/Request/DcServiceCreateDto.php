<?php

declare(strict_types=1);

namespace App\Dto\Request;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DcServiceDto
 */
#[RequestBody]
class DcServiceCreateDto extends DcServiceCommonDto
{
    #[Assert\NotBlank]
    #[Assert\DateTime]
    #[Property(description: 'Дата и время создания', example: '2023-12-18 00:07:10')]
    private string $createdAt;

    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор создавшего', example: 50687511)]
    private ?int $createdBy;

    #[Assert\NotBlank]
    #[Property(description: 'Название услуги', example: 'dc_sms_info_2700_149')]
    private string $serviceName;

    #[Assert\Type('integer')]
    #[Assert\NotBlank]
    #[Property(description: 'Идентификатор страховки', example: 1099)]
    private int $insurancenotbankId;

    #[Assert\Type('string')]
    #[Property(description: 'Название услуги', example: 'dc_sms_info_2700_149')]
    private ?string $code = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор заказа', example: 668795119)]
    private ?int $orderId = null;

    #[Assert\Type('integer')]
    #[Property(description: '', example: 355980089)]
    private ?int $storeId = null;

    #[Assert\Type('integer')]
    private ?int $shopId = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор анкеты', example: 511355415)]
    private ?int $schemeId = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: null)]
    private ?string $creditLimit = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: null)]
    private ?string $sName = null;

    #[Assert\Type('string')]
    #[Property(description: 'Номер телефона клиента', example: '(932) 322-9089')]
    private ?string $clientTel = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: null)]
    private ?string $uslugaTel = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: '35000')]
    private ?string $desiredCreditLimit = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: '20000AA545444')]
    private ?string $contractNumber = null;

    /**
     * @throws Exception
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return new DateTimeImmutable($this->createdAt, new DateTimeZone('Europe/Moscow'));
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?int $createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function setServiceName(string $serviceName): self
    {
        $this->serviceName = $serviceName;
        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(?int $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getInsurancenotbankId(): int
    {
        return $this->insurancenotbankId;
    }

    public function setInsurancenotbankId(int $insurancenotbankId): self
    {
        $this->insurancenotbankId = $insurancenotbankId;
        return $this;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(?int $storeId): self
    {
        $this->storeId = $storeId;
        return $this;
    }

    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function setShopId(?int $shopId): self
    {
        $this->shopId = $shopId;
        return $this;
    }

    public function getSchemeId(): ?int
    {
        return $this->schemeId;
    }

    public function setSchemeId(?int $schemeId): self
    {
        $this->schemeId = $schemeId;
        return $this;
    }

    public function getCreditLimit(): ?string
    {
        return $this->creditLimit;
    }

    public function setCreditLimit(?string $creditLimit): self
    {
        $this->creditLimit = $creditLimit;
        return $this;
    }

    public function getSName(): ?string
    {
        return $this->sName;
    }

    public function setSName(?string $sName): self
    {
        $this->sName = $sName;
        return $this;
    }

    public function getClientTel(): ?string
    {
        return $this->clientTel;
    }

    public function setClientTel(?string $clientTel): self
    {
        $this->clientTel = $clientTel;
        return $this;
    }

    public function getUslugaTel(): ?string
    {
        return $this->uslugaTel;
    }

    public function setUslugaTel(?string $uslugaTel): self
    {
        $this->uslugaTel = $uslugaTel;
        return $this;
    }

    public function getDesiredCreditLimit(): ?string
    {
        return $this->desiredCreditLimit;
    }

    public function getContractNumber(): ?string
    {
        return $this->contractNumber;
    }

    public function setContractNumber(?string $contractNumber): self
    {
        $this->contractNumber = $contractNumber;
        return $this;
    }

    public function setDesiredCreditLimit(?string $desiredCreditLimit): self
    {
        $this->desiredCreditLimit = $desiredCreditLimit;
        return $this;
    }
}
