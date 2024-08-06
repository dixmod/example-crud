<?php

namespace App\Dto\Request;

use App\Interfaces\EntityRequestInterface;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DcServiceLogErrorDto
 */
#[RequestBody]
class DcServiceLogErrorDto implements EntityRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор услуги', example: 515294403)]
    private int $serviceId;

    #[Assert\NotBlank]
    #[Assert\DateTime]
    #[Property(description: 'Дата и время создания', example: '2023-12-18 00:07:10')]
    private string $createdAt;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Property(description: 'Текст ошибки', example: 'Услуга одобрена')]
    private string $errorValue;

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $serviceId): self
    {
        $this->serviceId = $serviceId;
        return $this;
    }

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

    public function getErrorValue(): string
    {
        return $this->errorValue;
    }

    public function setErrorValue(string $errorValue): self
    {
        $this->errorValue = $errorValue;
        return $this;
    }
}
