<?php

declare(strict_types=1);

namespace App\Dto\Request;

use App\Interfaces\EntityRequestInterface;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DcServiceParamDto
 */
#[RequestBody]
class DcServiceParamDto implements EntityRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор услуги', example: 515294403)]
    private int $serviceId;

    #[Assert\Type('string')]
    #[Property(description: 'Выбранный тип подписания', example: 'paper')]
    private ?string $signTypeSelected = null;

    #[Assert\Type('string')]
    #[Property(description: 'Доступные типы подписания', example: 'paper, sms')]
    private ?string $signTypeAllow = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: '{"isFrame":true}')]
    private ?string $customServiceData = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Количество отправок смс-кодов', example: 1)]
    private ?int $smscodeCountSend = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Количество попыток проверок смс-кодов', example: 2)]
    private ?int $smscodeCountCanSend = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Количество проверок смс-кодов', example: 3)]
    private ?int $smscodeCountCheck = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Количество попыток проверок смс-кодов', example: 3)]
    private ?int $smscodeCountCanCheck = null;

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

    /**
     * @param int|null $smscodeCountSend
     * @return $this
     */
    public function setSmscodeCountSend(?int $smscodeCountSend)
    {
        $this->smscodeCountSend = $smscodeCountSend;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSmscodeCountCanSend(): ?int
    {
        return $this->smscodeCountCanSend;
    }

    /**
     * @param int|null $smscodeCountCanSend
     */
    public function setSmscodeCountCanSend(?int $smscodeCountCanSend): void
    {
        $this->smscodeCountCanSend = $smscodeCountCanSend;
    }

    /**
     * @return int|null
     */
    public function getSmscodeCountCheck(): ?int
    {
        return $this->smscodeCountCheck;
    }

    /**
     * @param int|null $smscodeCountCheck
     */
    public function setSmscodeCountCheck(?int $smscodeCountCheck): void
    {
        $this->smscodeCountCheck = $smscodeCountCheck;
    }

    /**
     * @return int|null
     */
    public function getSmscodeCountCanCheck(): ?int
    {
        return $this->smscodeCountCanCheck;
    }

    /**
     * @param int $smscodeCountCanCheck
     */
    public function setSmscodeCountCanCheck(int $smscodeCountCanCheck): void
    {
        $this->smscodeCountCanCheck = $smscodeCountCanCheck;
    }
}
