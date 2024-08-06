<?php

declare(strict_types=1);

namespace App\Dto\Request;

use App\Interfaces\EntityRequestInterface;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DcServiceLogHistoryDto
 */
#[RequestBody]
class DcServiceLogHistoryDto implements EntityRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор услуги', example: 515294403)]
    private int $serviceId;

    #[ORM\Column(type: 'datetime')]
    #[Assert\NotBlank]
    #[Assert\DateTime]
    #[Property(description: 'Дата и время создания', example: '2023-12-18 00:07:10')]
    private string $createdAt;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Property(description: 'Текст записи в лог', example: 'Услуга одобрена')]
    private string $historyValue;

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

    public function getHistoryValue(): string
    {
        return $this->historyValue;
    }

    public function setHistoryValue(string $historyValue): self
    {
        $this->historyValue = $historyValue;
        return $this;
    }
}
