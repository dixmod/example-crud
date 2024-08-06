<?php

namespace App\Dto\Request\Find\Service;

use App\Dto\Request\Find\Paginator;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ListSearchDto
 * @package App\Dto\Request\Find\Service
 */
class ListSearchDto extends ByAgentFilterDto
{
    #[OA\Property(type: 'array', items: new OA\Items(type: 'integer'))]
    #[Assert\Type('array')]
    private array $profileIds = [];

    #[OA\Property(description: 'Минимальный ID', example: 100500)]
    #[Assert\Type('integer')]
    private int $fromId = 0;

    #[Assert\DateTime]
    #[OA\Property(description: 'Начало даты и время создания', example: '2023-12-18 00:00:00')]
    private ?string $fromCreatedAt = null;

    #[Assert\DateTime]
    #[OA\Property(description: 'Окончание даты и время создания', example: '2023-12-18 23:59:59')]
    private ?string $toCreatedAt = null;

    #[Assert\Type('array')]
    #[OA\Property(type: 'array', items: new OA\Items(type: 'integer'))]
    private array $ids = [];

    #[Assert\Type('array')]
    #[OA\Property(type: 'array', items: new OA\Items(type: 'integer'))]
    private array $orderIds = [];

    #[Assert\Type('array')]
    #[OA\Property(type: 'array', items: new OA\Items(type: 'integer'))]
    private array $notInStatuses = [];

    #[Assert\Type('array')]
    #[OA\Property(type: 'array', items: new OA\Items(type: 'integer'))]
    private array $inStatuses = [];

    #[Assert\Type('boolean')]
    private ?bool $isActive = null;

    #[Assert\Type('boolean')]
    private bool $isNeedNullAgentId = false;

    #[Assert\Type('string')]
    private string $addId = '';

    #[Assert\Type('integer')]
    #[OA\Property(description: 'Идентификатор типа', example: 345)]
    private ?int $insuranceNotBankId = null;

    #[Assert\Valid]
    private ?Paginator $paginator = null;

    public function getProfileIds(): array
    {
        return $this->profileIds;
    }

    public function setProfileIds(array $profileIds): self
    {
        $this->profileIds = $profileIds;
        return $this;
    }

    public function getFromId(): int
    {
        return $this->fromId;
    }

    public function setFromId(int $fromId): self
    {
        $this->fromId = $fromId;
        return $this;
    }

    public function getIds(): array
    {
        return $this->ids;
    }

    public function setIds(array $ids): self
    {
        $this->ids = $ids;
        return $this;
    }

    public function getOrderIds(): array
    {
        return $this->orderIds;
    }

    public function setOrderIds(array $orderIds): self
    {
        $this->orderIds = $orderIds;
        return $this;
    }

    public function getNotInStatuses(): array
    {
        return $this->notInStatuses;
    }

    public function setNotInStatuses(array $notInStatuses): self
    {
        $this->notInStatuses = $notInStatuses;
        return $this;
    }

    public function getInStatuses(): array
    {
        return $this->inStatuses;
    }

    public function setInStatuses(array $inStatuses): self
    {
        $this->inStatuses = $inStatuses;
        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function isNeedNullAgentId(): bool
    {
        return $this->isNeedNullAgentId;
    }

    public function setIsNeedNullAgentId(bool $isNeedNullAgentId): self
    {
        $this->isNeedNullAgentId = $isNeedNullAgentId;
        return $this;
    }

    public function getAddId(): string
    {
        return $this->addId;
    }

    public function setAddId(string $addId): self
    {
        $this->addId = $addId;
        return $this;
    }

    public function getPaginator(): ?Paginator
    {
        return $this->paginator;
    }

    public function setPaginator(?Paginator $paginator): self
    {
        $this->paginator = $paginator;
        return $this;
    }

    public function getFromCreatedAt(): ?DateTimeInterface
    {
        if ($this->fromCreatedAt === null) {
            return null;
        }

        return new DateTimeImmutable($this->fromCreatedAt, new DateTimeZone('Europe/Moscow'));
    }

    public function setFromCreatedAt(?string $fromCreatedAt): self
    {
        $this->fromCreatedAt = $fromCreatedAt;
        return $this;
    }

    public function getToCreatedAt(): ?DateTimeInterface
    {
        if ($this->toCreatedAt === null) {
            return null;
        }

        return new DateTimeImmutable($this->toCreatedAt, new DateTimeZone('Europe/Moscow'));
    }

    public function setToCreatedAt(?string $toCreatedAt): self
    {
        $this->toCreatedAt = $toCreatedAt;
        return $this;
    }

    public function getInsuranceNotBankId(): ?int
    {
        return $this->insuranceNotBankId;
    }

    public function setInsuranceNotBankId(?int $insuranceNotBankId): self
    {
        $this->insuranceNotBankId = $insuranceNotBankId;
        return $this;
    }
}
