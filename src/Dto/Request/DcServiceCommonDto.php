<?php

namespace App\Dto\Request;

use App\Interfaces\ServiceEntityRequestInterface;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DcServiceCommonDto
 * @package App\Dto\Request
 */
#[RequestBody]
abstract class DcServiceCommonDto implements ServiceEntityRequestInterface
{
    #[Assert\Type('boolean')]
    #[Property(description: 'Признак активности', enum: [true, false], example: true)]
    protected ?bool $active = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Код статуса услуги', example: 174)]
    protected ?int $serviceStatusId = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор заявки', example: 1516456507)]
    protected ?int $applicationId = null;

    #[Assert\Type('integer')]
    #[Property(description: '', example: null)]
    protected ?int $insureProfileId = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Тип устройства', example: 1547)]
    protected ?int $insureDeviceTypeId = null;

    #[Assert\Type('string')]
    #[Property(description: 'Модель устройства', example: 'Самсунг')]
    protected ?string $insureDeviceModel = null;

    #[Assert\Type('string')]
    #[Property(description: 'Серийный номер устройства', example: 'IMAI163001234')]
    protected ?string $insureDeviceSerial = null;

    #[Assert\Type('string')]
    #[Property(description: 'Идентификатор партёра', example: '21212111')]
    protected ?string $idPartner = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор агента', example: 450249203)]
    protected ?int $agentId = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор пользователя', example: 12705361)]
    protected ?int $userId = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор анкеты', example: 511355415)]
    protected ?int $profileId = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор банка', example: 511355415)]
    protected ?int $bankId = null;

    #[Assert\Type('float')]
    #[Property(description: 'Цена', example: 5000.00)]
    protected ?float $price = null;

    #[Assert\Type('float')]
    #[Property(description: 'Цена со скидкой', example: 1000.00)]
    protected ?float $priceWithSale = null;

    public function getApplicationId(): ?int
    {
        return $this->applicationId;
    }

    public function setApplicationId(?int $applicationId): self
    {
        $this->applicationId = $applicationId;
        return $this;
    }

    public function getServiceStatusId(): ?int
    {
        return $this->serviceStatusId;
    }

    public function setServiceStatusId(?int $serviceStatusId): self
    {
        $this->serviceStatusId = $serviceStatusId;
        return $this;
    }

    public function getInsureProfileId(): ?int
    {
        return $this->insureProfileId;
    }

    public function setInsureProfileId(?int $insureProfileId): self
    {
        $this->insureProfileId = $insureProfileId;
        return $this;
    }

    public function getInsureDeviceTypeId(): ?int
    {
        return $this->insureDeviceTypeId;
    }

    public function setInsureDeviceTypeId(?int $insureDeviceTypeId): self
    {
        $this->insureDeviceTypeId = $insureDeviceTypeId;
        return $this;
    }

    public function getInsureDeviceModel(): ?string
    {
        return $this->insureDeviceModel;
    }

    public function setInsureDeviceModel(?string $insureDeviceModel): self
    {
        $this->insureDeviceModel = $insureDeviceModel;
        return $this;
    }

    public function getInsureDeviceSerial(): ?string
    {
        return $this->insureDeviceSerial;
    }

    public function setInsureDeviceSerial(?string $insureDeviceSerial): self
    {
        $this->insureDeviceSerial = $insureDeviceSerial;
        return $this;
    }

    public function getIdPartner(): ?string
    {
        return $this->idPartner;
    }

    public function setIdPartner(?string $idPartner): self
    {
        $this->idPartner = $idPartner;
        return $this;
    }

    public function getAgentId(): ?int
    {
        return $this->agentId;
    }

    public function setAgentId(?int $agentId): self
    {
        $this->agentId = $agentId;
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getProfileId(): ?int
    {
        return $this->profileId;
    }

    public function setProfileId(?int $profileId): self
    {
        $this->profileId = $profileId;
        return $this;
    }

    public function getBankId(): ?int
    {
        return $this->bankId;
    }

    public function setBankId(?int $bankId): self
    {
        $this->bankId = $bankId;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getPriceWithSale(): ?float
    {
        return $this->priceWithSale;
    }

    public function setPriceWithSale(?float $priceWithSale): void
    {
        $this->priceWithSale = $priceWithSale;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return $this
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }
}
