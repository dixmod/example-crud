<?php

namespace App\Dto\Request;

use App\Interfaces\ServiceEntityRequestInterface;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DcServiceUpdateDto
 * @package App\Dto\Request
 */
#[RequestBody]
class DcServiceUpdateDto extends DcServiceCommonDto
{
    #[Assert\Type('integer')]
    #[Property(description: 'Идентификатор изменившего', example: 50687511)]
    private ?int $modifiedBy;

    #[Assert\Type('integer')]
    private ?int $changesReasonId = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время запроса', example: '2023-11-26 13:12:23')]
    private ?string $dateSend = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время ответа', example: '2023-11-26 13:12:23')]
    private ?string $dateResponse = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время запроса подтверждения', example: '2023-11-26 13:12:23')]
    private ?string $dateSendConfirm = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время ответа подтверждения', example: '2023-11-26 13:12:23')]
    private ?string $dateResponseConfirm = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время печати', example: '2023-11-26 13:12:23')]
    private ?string $datePrint = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время подписания', example: '2023-11-26 13:12:23')]
    private ?string $dateSign = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время скана', example: '2023-11-26 13:12:23')]
    private ?string $dateSendScan = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время регистрации', example: '2023-11-26 13:12:23')]
    private ?string $dateRegister = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время отказа', example: '2023-11-26 13:12:23')]
    private ?string $dateCancel = null;

    #[Assert\DateTime]
    #[Property(description: '', example: '2023-11-26 13:12:23')]
    private ?string $dateResponseScan = null;

    #[Assert\DateTime]
    #[Property(description: '', example: '2023-11-26 13:12:23')]
    private ?string $dateSendSign = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время получения sms-кода', example: '2023-11-26 13:12:23')]
    private ?string $dateGetCode = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время отправки sms-кода', example: '2023-11-26 13:12:23')]
    private ?string $dateSendCode = null;

    #[Assert\DateTime]
    #[Property(description: 'Дата и время проверки sms-кода', example: '2023-11-26 13:12:23')]
    private ?string $dateCheckCode = null;

    #[Assert\Type('string')]
    #[Property(description: 'Sms-код', example: 324995)]
    private ?string $smsCode = null;

    #[Assert\Type('numeric')]
    #[Property(description: 'Sms-код', example: 324995)]
    private ?int $countSendCode = null;

    #[Assert\Type('integer')]
    #[Property(description: 'Количество проверок sms-кодов', example: null)]
    private ?int $countCheckCode = null;

    #[Assert\Type('string')]
    #[Property(description: 'Код подтверждения', example: '00130')]
    private ?string $confirmCode = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: '1-E5N1TVM')]
    private ?string $addId = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: '40816015446')]
    private ?string $addId2 = null;

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
    #[Property(description: '', example: '408178100110004927142')]
    private ?string $accountNumber = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: '23000G700040954715')]
    private ?string $contractNumber = null;

    #[Assert\Type('string')]
    private ?string $contractNumberHash = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: '/upload/credit_contract/21686/216860025.pdf')]
    private ?string $contractFile = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: null)]
    private ?string $cardNumber = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: null)]
    private ?string $cardExpiry = null;

    #[Assert\Type('string')]
    #[Property(description: '', example: 'C15-05425894')]
    private ?string $barcode = null;

    public function getModifiedBy(): ?int
    {
        return $this->modifiedBy;
    }

    public function setModifiedBy(?int $modifiedBy): self
    {
        $this->modifiedBy = $modifiedBy;
        return $this;
    }

    public function getChangesReasonId(): ?int
    {
        return $this->changesReasonId;
    }

    public function setChangesReasonId(?int $changesReasonId): self
    {
        $this->changesReasonId = $changesReasonId;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateSend(): ?DateTimeInterface
    {
        if ($this->dateSend === null) {
            return $this->dateSend;
        }

        return new DateTimeImmutable($this->dateSend, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateSend(?string $dateSend): self
    {
        $this->dateSend = $dateSend;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateResponse(): ?DateTimeInterface
    {
        if ($this->dateResponse === null) {
            return null;
        }

        return new DateTimeImmutable($this->dateResponse, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateResponse(?string $dateResponse): self
    {
        $this->dateResponse = $dateResponse;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateSendConfirm(): ?DateTimeInterface
    {
        if ($this->dateSendConfirm === null) {
            return $this->dateSendConfirm;
        }

        return new DateTimeImmutable($this->dateSendConfirm, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateSendConfirm(?string $dateSendConfirm): self
    {
        $this->dateSendConfirm = $dateSendConfirm;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateResponseConfirm(): ?DateTimeInterface
    {
        if ($this->dateResponseConfirm === null) {
            return $this->dateResponseConfirm;
        }

        return new DateTimeImmutable($this->dateResponseConfirm, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateResponseConfirm(?string $dateResponseConfirm): self
    {
        $this->dateResponseConfirm = $dateResponseConfirm;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDatePrint(): ?DateTimeInterface
    {
        if ($this->datePrint === null) {
            return $this->datePrint;
        }

        return new DateTimeImmutable($this->datePrint, new DateTimeZone('Europe/Moscow'));
    }

    public function setDatePrint(?string $datePrint): self
    {
        $this->datePrint = $datePrint;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateSign(): ?DateTimeInterface
    {
        if ($this->dateSign === null) {
            return $this->dateSign;
        }

        return new DateTimeImmutable($this->dateSign, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateSign(?string $dateSign): self
    {
        $this->dateSign = $dateSign;
        return $this;
    }

    public function getDateSendScan(): ?DateTimeInterface
    {
        if ($this->dateSendScan === null) {
            return $this->dateSendScan;
        }

        return new DateTimeImmutable($this->dateSendScan, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateSendScan(?string $dateSendScan): self
    {
        $this->dateSendScan = $dateSendScan;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateRegister(): ?DateTimeInterface
    {
        if ($this->dateRegister === null) {
            return $this->dateRegister;
        }

        return new DateTimeImmutable($this->dateRegister, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateRegister(?string $dateRegister): self
    {
        $this->dateRegister = $dateRegister;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateCancel(): ?DateTimeInterface
    {
        if ($this->dateCancel === null) {
            return $this->dateCancel;
        }

        return new DateTimeImmutable($this->dateCancel, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateCancel(?string $dateCancel): self
    {
        $this->dateCancel = $dateCancel;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateResponseScan(): ?DateTimeInterface
    {
        if ($this->dateResponseScan === null) {
            return $this->dateResponseScan;
        }

        return new DateTimeImmutable($this->dateResponseScan, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateResponseScan(?string $dateResponseScan): self
    {
        $this->dateResponseScan = $dateResponseScan;
        return $this;
    }

    public function getDateSendSign(): ?DateTimeInterface
    {
        if ($this->dateSendSign === null) {
            return $this->dateSendSign;
        }

        return new DateTimeImmutable($this->dateSendSign, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateSendSign(?string $dateSendSign): self
    {
        $this->dateSendSign = $dateSendSign;
        return $this;
    }

    public function getDateGetCode(): ?DateTimeInterface
    {
        if ($this->dateGetCode === null) {
            return $this->dateGetCode;
        }

        return new DateTimeImmutable($this->dateGetCode, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateGetCode(?string $dateGetCode): self
    {
        $this->dateGetCode = $dateGetCode;
        return $this;
    }

    public function getDateSendCode(): ?DateTimeInterface
    {
        if ($this->dateSendCode === null) {
            return $this->dateSendCode;
        }

        return new DateTimeImmutable($this->dateSendCode, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateSendCode(?string $dateSendCode): self
    {
        $this->dateSendCode = $dateSendCode;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getDateCheckCode(): ?DateTimeInterface
    {
        if ($this->dateCheckCode === null) {
            return $this->dateCheckCode;
        }

        return new DateTimeImmutable($this->dateCheckCode, new DateTimeZone('Europe/Moscow'));
    }

    public function setDateCheckCode(?string $dateCheckCode): self
    {
        $this->dateCheckCode = $dateCheckCode;
        return $this;
    }

    public function getSmsCode(): ?string
    {
        return $this->smsCode;
    }

    public function setSmsCode(?string $smsCode): self
    {
        $this->smsCode = $smsCode;
        return $this;
    }

    public function getCountSendCode(): ?int
    {
        return $this->countSendCode;
    }

    public function setCountSendCode(?int $countSendCode): self
    {
        $this->countSendCode = $countSendCode;
        return $this;
    }

    public function getCountCheckCode(): ?int
    {
        return $this->countCheckCode;
    }

    public function setCountCheckCode(?int $countCheckCode): self
    {
        $this->countCheckCode = $countCheckCode;
        return $this;
    }

    public function getConfirmCode(): ?string
    {
        return $this->confirmCode;
    }

    public function setConfirmCode(?string $confirmCode): self
    {
        $this->confirmCode = $confirmCode;
        return $this;
    }

    public function getAddId(): ?string
    {
        return $this->addId;
    }

    public function setAddId(?string $addId): self
    {
        $this->addId = $addId;
        return $this;
    }

    public function getAddId2(): ?string
    {
        return $this->addId2;
    }

    public function setAddId2(?string $addId2): self
    {
        $this->addId2 = $addId2;
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

    public function setDesiredCreditLimit(?string $desiredCreditLimit): self
    {
        $this->desiredCreditLimit = $desiredCreditLimit;
        return $this;
    }

    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(?string $accountNumber): self
    {
        $this->accountNumber = $accountNumber;
        return $this;
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

    public function getContractNumberHash(): ?string
    {
        return $this->contractNumberHash;
    }

    public function setContractNumberHash(?string $contractNumberHash): self
    {
        $this->contractNumberHash = $contractNumberHash;
        return $this;
    }

    public function getContractFile(): ?string
    {
        return $this->contractFile;
    }

    public function setContractFile(?string $contractFile): self
    {
        $this->contractFile = $contractFile;
        return $this;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(?string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function getCardExpiry(): ?string
    {
        return $this->cardExpiry;
    }

    public function setCardExpiry(?string $cardExpiry): self
    {
        $this->cardExpiry = $cardExpiry;
        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): self
    {
        $this->barcode = $barcode;
        return $this;
    }
}
