<?php

namespace App\Entity;

use App\Enum\DateTimeFormatEnum;
use App\Interfaces\EntityResponseInterface;
use App\Repository\DcServiceRepository;
use App\Traits\JsonSerializeTraitRecurse;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DcService
 */
#[ORM\Table(name: 'additional_product_store.dc_service')]
#[ORM\Index(columns: ['modified_at'], name: 'ix_dc_service_modified_at')]
#[ORM\Index(columns: ['created_at'], name: 'ix_dc_service_created_at')]
#[ORM\Entity(repositoryClass: DcServiceRepository::class)]
class DcService implements EntityResponseInterface, DescribeLabelsInterface
{
    use JsonSerializeTraitRecurse {
        jsonSerialize as private baseJsonSerialize;
    }

    public const CONTRACT_SIGNED = 191;
    public const APPROVED = 180; // Нет подтверждения клиента
    public const CONTRACT_AUTH = 174; // Оформлена - Договор авторизован
    public const CONFIRM_ERROR = 427; // Ошибка при подтверждении
    public const PROPERTY_ID = 'id';
    public const PROPERTY_CREATED_AT = 'createdAt';
    public const PROPERTY_CREATED_BY = 'createdBy';
    public const PROPERTY_MODIFIED_AT = 'modifiedAt';
    public const PROPERTY_MODIFIED_BY = 'modifiedBy';
    public const PROPERTY_ACTIVE = 'active';
    public const PROPERTY_SERVICE_NAME = 'serviceName';
    public const PROPERTY_CODE = 'code';
    public const PROPERTY_ORDER_ID = 'orderId';
    public const PROPERTY_APPLICATION_ID = 'applicationId';
    public const PROPERTY_INSURANCENOTBANK_ID = 'insurancenotbankId';
    public const PROPERTY_BANK_ID = 'bankId';
    public const PROPERTY_SERVICE_STATUS = 'serviceStatus';
    public const PROPERTY_PRICE = 'price';
    public const PROPERTY_SHOP_ID = 'shopId';
    public const PROPERTY_STORE_ID = 'storeId';
    public const PROPERTY_AGENT_ID = 'agentId';
    public const PROPERTY_USER_ID = 'userId';
    public const PROPERTY_PROFILE_ID = 'profileId';
    public const PROPERTY_SMS_CODE = 'smsCode';
    public const PROPERTY_COUNT_SEND_CODE = 'countSendCode';
    public const PROPERTY_COUNT_CHECK_CODE = 'countCheckCode';
    public const PROPERTY_DATE_GET_CODE = 'dateGetCode';
    public const PROPERTY_DATE_SEND_CODE = 'dateSendCode';
    public const PROPERTY_DATE_CHECK_CODE = 'dateCheckCode';
    public const PROPERTY_DATE_SEND = 'dateSend';
    public const PROPERTY_DATE_SEND_CONFIRM = 'dateSendConfirm';
    public const PROPERTY_DATE_RESPONSE = 'dateResponse';
    public const PROPERTY_DATE_RESPONSE_CONFIRM = 'dateResponseConfirm';
    public const PROPERTY_DATE_RESPONSE_SCAN = 'dateResponseScan';
    public const PROPERTY_DATE_PRINT = 'datePrint';
    public const PROPERTY_DATE_SIGN = 'dateSign';
    public const PROPERTY_DATE_SEND_SIGN = 'dateSendSign';
    public const PROPERTY_DATE_SEND_SCAN = 'dateSendScan';
    public const PROPERTY_DATE_REGISTER = 'dateRegister';
    public const PROPERTY_DATE_CANCEL = 'dateCancel';
    public const PROPERTY_CONTRACT_FILE = 'contractFile';
    public const PROPERTY_CONTRACT_NUMBER = 'contractNumber';
    public const PROPERTY_CONTRACT_NUMBER_HASH = 'contractNumberHash';
    public const PROPERTY_ACCOUNT_NUMBER = 'accountNumber';
    public const PROPERTY_ADD_ID = 'addId';
    public const PROPERTY_ADD_ID_2 = 'addId2';
    public const PROPERTY_CARD_NUMBER = 'cardNumber';
    public const PROPERTY_CARD_EXPIRY = 'cardExpiry';
    public const PROPERTY_BARCODE = 'barcode';
    public const PROPERTY_CONFIRM_CODE = 'confirmCode';
    public const PROPERTY_DESIRED_CREDIT_LIMIT = 'desiredCreditLimit';
    public const PROPERTY_CREDIT_LIMIT = 'creditLimit';
    public const PROPERTY_CHANGES_REASON_ID = 'changesReasonId';
    public const PROPERTY_S_NAME = 'sName';
    public const PROPERTY_CLIENT_TEL = 'clientTel';
    public const PROPERTY_USLUGA_TEL = 'uslugaTel';
    public const PROPERTY_SCHEME_ID = 'schemeId';
    public const PROPERTY_SCHEME_NAME = 'scheme';
    public const PROPERTY_SERVICE_BARCODE = 'serviceBarcode';
    public const PROPERTY_ID_PARTNER = 'idPartner';
    public const PROPERTY_PRICE_WITH_SALE = 'priceWithSale';
    public const PROPERTY_INSURE_PROFILE_ID = 'insureProfileId';
    public const PROPERTY_INSURE_DEVICE_TYPE = 'insureDeviceType';
    public const PROPERTY_INSURE_DEVICE_MODEL = 'insureDeviceModel';
    public const PROPERTY_INSURE_DEVICE_SERIAL = 'insureDeviceSerial';
    public const PROPERTY_SERVICE_LOG_ERRORS = 'serviceLogErrors';
    public const PROPERTY_SERVICE_LOG_HISTORY = 'serviceLogHistory';
    public const PROPERTY_SERVICE_PARAMS = 'serviceParams';
    public const ENTITY_TITLE = 'Оформленные услуги';

    #[ORM\Column(name: self::PROPERTY_ID, type: 'integer', nullable: false, options: ['comment' => 'Идентификатор'])]
    #[ORM\Id]
    private int $id;

    #[ORM\Column(
        name: 'modified_at',
        type: 'datetime',
        nullable: false,
        options: ['default' => 'CURRENT_TIMESTAMP(6)', 'comment' => 'дата-время изменения (timestamp_x)']
    )]
    private DateTimeInterface $modifiedAt;

    #[ORM\Column(name: 'modified_by', type: 'integer', nullable: true)]
    private ?int $modifiedBy;

    #[ORM\Column(
        name: 'created_at',
        type: 'datetime',
        nullable: false,
        options: ['default' => 'CURRENT_TIMESTAMP(6)']
    )]
    private DateTimeInterface $createdAt;

    #[ORM\Column(name: 'created_by', type: 'integer', nullable: true)]
    private ?int $createdBy;

    #[ORM\Column(name: self::PROPERTY_ACTIVE, type: 'boolean', nullable: false, options: ['default' => '1'])]
    private bool $active = true;

    #[ORM\Column(name: 'service_name', type: 'string', length: 255, nullable: false)]
    private string $serviceName;

    #[ORM\Column(name: self::PROPERTY_CODE, type: 'string', length: 255, nullable: true)]
    private ?string $code;

    #[ORM\Column(name: 'order_id', type: 'integer', nullable: true)]
    private ?int $orderId;

    #[ORM\Column(name: 'insurancenotbank_id', type: 'integer', nullable: true)]
    private ?int $insurancenotbankId;

    #[ORM\Column(name: 'application_id', type: 'integer', nullable: true)]
    private ?int $applicationId;

    #[ORM\Column(name: 'service_status_id', type: 'integer', nullable: true)]
    private ?int $serviceStatusId;

    #[ORM\ManyToOne(targetEntity: DcServiceStatus::class)]
    #[ORM\JoinColumn(name: 'service_status_id', referencedColumnName: DcServiceStatus::PROPERTY_ID, nullable: true)]
    private ?DcServiceStatus $serviceStatus;

    #[ORM\Column(name: 'store_id', type: 'integer', nullable: true)]
    private ?int $storeId;

    #[ORM\Column(name: 'agent_id', type: 'integer', nullable: true)]
    private ?int $agentId;

    #[ORM\Column(name: 'user_id', type: 'integer', nullable: true)]
    private ?int $userId;

    #[ORM\Column(name: 'profile_id', type: 'integer', nullable: true)]
    private ?int $profileId;

    #[ORM\Column(name: 'shop_id', type: 'integer', nullable: true)]
    private ?int $shopId;

    #[ORM\Column(name: 'bank_id', type: 'integer', nullable: true)]
    private ?int $bankId;

    #[ORM\Column(name: 'scheme_id', type: 'integer', nullable: true)]
    private ?int $schemeId;

    #[ORM\ManyToOne(targetEntity: DcServiceScheme::class, fetch:"EAGER")]
    #[ORM\JoinColumn(name: 'scheme_id', referencedColumnName: DcServiceScheme::PROPERTY_ID, nullable: true)]
    private ?DcServiceScheme $scheme = null;

    #[ORM\Column(name: 'changes_reason_id', type: 'integer', nullable: true)]
    private ?int $changesReasonId;

    #[ORM\Column(name: self::PROPERTY_PRICE, type: 'decimal', precision: 18, scale: 4, nullable: true)]
    private ?float $price;

    #[ORM\Column(name: 'price_with_sale', type: 'decimal', precision: 18, scale: 4, nullable: true)]
    private ?float $priceWithSale;

    #[ORM\Column(name: 'date_send', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateSend;

    #[ORM\Column(name: 'date_response', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateResponse;

    #[ORM\Column(name: 'date_send_confirm', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateSendConfirm;

    #[ORM\Column(name: 'date_response_confirm', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateResponseConfirm;

    #[ORM\Column(name: 'date_print', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $datePrint;

    #[ORM\Column(name: 'date_sign', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateSign;

    #[ORM\Column(name: 'date_send_scan', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateSendScan;

    #[ORM\Column(name: 'date_register', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateRegister;

    #[ORM\Column(name: 'date_cancel', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateCancel;

    #[ORM\Column(name: 'date_response_scan', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateResponseScan;

    #[ORM\Column(name: 'date_send_sign', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateSendSign;

    #[ORM\Column(name: 'date_get_code', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateGetCode;

    #[ORM\Column(name: 'date_send_code', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateSendCode;

    #[ORM\Column(name: 'date_check_code', type: 'datetime', nullable: true)]
    private ?DateTimeInterface $dateCheckCode;

    #[ORM\Column(name: 'sms_code', type: 'string', length: 10, nullable: true)]
    private ?string $smsCode;

    #[ORM\Column(name: 'count_send_code', type: 'integer', nullable: true)]
    private ?int $countSendCode;

    #[ORM\Column(name: 'count_check_code', type: 'integer', nullable: true)]
    private ?int $countCheckCode;

    #[ORM\Column(name: 'confirm_code', type: 'text', nullable: true)]
    private ?string $confirmCode;

    #[ORM\Column(name: 'add_id', type: 'text', nullable: true)]
    private ?string $addId;

    #[ORM\Column(name: 'add_id2', type: 'text', nullable: true)]
    private ?string $addId2;

    #[ORM\Column(name: 'credit_limit', type: 'text', nullable: true)]
    private ?string $creditLimit;

    #[ORM\Column(name: 's_name', type: 'text', nullable: true)]
    private ?string $sName;

    #[ORM\Column(name: 'client_tel', type: 'text', nullable: true)]
    private ?string $clientTel;

    #[ORM\Column(name: 'usluga_tel', type: 'text', nullable: true)]
    private ?string $uslugaTel;

    #[ORM\Column(name: 'desired_credit_limit', type: 'text', nullable: true)]
    private ?string $desiredCreditLimit;

    #[ORM\Column(name: 'account_number', type: 'text', nullable: true)]
    private ?string $accountNumber;

    #[ORM\Column(name: 'contract_number', type: 'text', nullable: true)]
    private ?string $contractNumber;

    #[ORM\Column(name: 'contract_number_hash', type: 'text', nullable: true)]
    private ?string $contractNumberHash;

    #[ORM\Column(name: 'contract_file', type: 'text', nullable: true)]
    private ?string $contractFile;

    #[ORM\Column(name: 'card_number', type: 'text', nullable: true)]
    private ?string $cardNumber;

    #[ORM\Column(name: 'card_expiry', type: 'text', nullable: true)]
    private ?string $cardExpiry;

    #[ORM\Column(name: self::PROPERTY_BARCODE, type: 'text', nullable: true)]
    private ?string $barcode;

    #[ORM\Column(name: 'insure_profile_id', type: 'integer', nullable: true)]
    private ?int $insureProfileId;

    #[ORM\Column(name: 'insure_device_type_id', type: 'integer', nullable: true)]
    private ?int $insureDeviceTypeId;

    #[ORM\ManyToOne(targetEntity: DcServiceDeviceType::class)]
    #[ORM\JoinColumn(name: 'insure_device_type_id', referencedColumnName: self::PROPERTY_ID)]
    private ?DcServiceDeviceType $insureDeviceType = null;

    #[ORM\Column(name: 'insure_device_model', type: 'text', nullable: true)]
    private ?string $insureDeviceModel;

    #[ORM\Column(name: 'insure_device_serial', type: 'text', nullable: true)]
    private ?string $insureDeviceSerial;

    #[ORM\Column(name: 'id_partner', type: 'text', nullable: true)]
    private ?string $idPartner;

    /** @var Collection<string, DcServiceLogError> */
    #[ORM\OneToMany(mappedBy: 'service', targetEntity: DcServiceLogError::class)]
    private Collection $serviceLogErrors;

    /** @var Collection<string, DcServiceLogHistory> */
    #[ORM\OneToMany(mappedBy: 'service', targetEntity: DcServiceLogHistory::class)]
    private Collection $serviceLogHistory;

    /** @var DcServiceParam|null */
    #[ORM\OneToOne(mappedBy: 'service', targetEntity: DcServiceParam::class)]
    private ?DcServiceParam $serviceParams = null;

    /** @var Collection<string, DcServiceBarcode> */
    #[ORM\OneToMany(mappedBy: 'service', targetEntity: DcServiceBarcode::class)]
    private Collection $serviceBarcode;

    public function __construct()
    {
        $this->serviceLogErrors = new ArrayCollection();
        $this->serviceLogHistory = new ArrayCollection();
        $this->serviceBarcode = new ArrayCollection();
    }

    public function getServiceLogErrors(): Collection
    {
        return $this->serviceLogErrors;
    }

    public function getServiceLogHistory(): Collection
    {
        return $this->serviceLogHistory;
    }

    public function getServiceParams(): ?DcServiceParam
    {
        return $this->serviceParams;
    }

    public function getServiceBarcode(): Collection
    {
        return $this->serviceBarcode;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getModifiedAt(): DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function getModifiedBy(): ?int
    {
        return $this->modifiedBy;
    }

    public function setModifiedBy(?int $modifiedBy): self
    {
        $this->modifiedBy = $modifiedBy;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
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

    public function getInsurancenotbankId(): ?int
    {
        return $this->insurancenotbankId;
    }

    public function setInsurancenotbankId(?int $insurancenotbankId): self
    {
        $this->insurancenotbankId = $insurancenotbankId;
        return $this;
    }

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

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(?int $storeId): self
    {
        $this->storeId = $storeId;
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

    public function getShopId(): ?int
    {
        return $this->shopId;
    }

    public function setShopId(?int $shopId): self
    {
        $this->shopId = $shopId;
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

    public function getSchemeId(): ?int
    {
        return $this->schemeId;
    }

    public function setSchemeId(?int $schemeId): self
    {
        $this->schemeId = $schemeId;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getPriceWithSale(): ?float
    {
        return $this->priceWithSale;
    }

    public function setPriceWithSale(?float $priceWithSale): self
    {
        $this->priceWithSale = $priceWithSale;
        return $this;
    }

    public function getDateSend(): ?DateTimeInterface
    {
        return $this->dateSend;
    }

    public function setDateSend(?DateTimeInterface $dateSend): self
    {
        $this->dateSend = $dateSend;
        return $this;
    }

    public function getDateResponse(): ?DateTimeInterface
    {
        return $this->dateResponse;
    }

    public function setDateResponse(?DateTimeInterface $dateResponse): self
    {
        $this->dateResponse = $dateResponse;
        return $this;
    }

    public function getDateSendConfirm(): ?DateTimeInterface
    {
        return $this->dateSendConfirm;
    }

    public function setDateSendConfirm(?DateTimeInterface $dateSendConfirm): self
    {
        $this->dateSendConfirm = $dateSendConfirm;
        return $this;
    }

    public function getDateResponseConfirm(): ?DateTimeInterface
    {
        return $this->dateResponseConfirm;
    }

    public function setDateResponseConfirm(?DateTimeInterface $dateResponseConfirm): self
    {
        $this->dateResponseConfirm = $dateResponseConfirm;
        return $this;
    }

    public function getDatePrint(): ?DateTimeInterface
    {
        return $this->datePrint;
    }

    public function setDatePrint(?DateTimeInterface $datePrint): self
    {
        $this->datePrint = $datePrint;
        return $this;
    }

    public function getDateSign(): ?DateTimeInterface
    {
        return $this->dateSign;
    }

    public function setDateSign(?DateTimeInterface $dateSign): self
    {
        $this->dateSign = $dateSign;
        return $this;
    }

    public function getDateSendScan(): ?DateTimeInterface
    {
        return $this->dateSendScan;
    }

    public function setDateSendScan(?DateTimeInterface $dateSendScan): self
    {
        $this->dateSendScan = $dateSendScan;
        return $this;
    }

    public function getDateRegister(): ?DateTimeInterface
    {
        return $this->dateRegister;
    }

    public function setDateRegister(?DateTimeInterface $dateRegister): self
    {
        $this->dateRegister = $dateRegister;
        return $this;
    }

    public function getDateCancel(): ?DateTimeInterface
    {
        return $this->dateCancel;
    }

    public function setDateCancel(?DateTimeInterface $dateCancel): self
    {
        $this->dateCancel = $dateCancel;
        return $this;
    }

    public function getDateResponseScan(): ?DateTimeInterface
    {
        return $this->dateResponseScan;
    }

    public function setDateResponseScan(?DateTimeInterface $dateResponseScan): self
    {
        $this->dateResponseScan = $dateResponseScan;
        return $this;
    }

    public function getDateSendSign(): ?DateTimeInterface
    {
        return $this->dateSendSign;
    }

    public function setDateSendSign(?DateTimeInterface $dateSendSign): self
    {
        $this->dateSendSign = $dateSendSign;
        return $this;
    }

    public function getDateGetCode(): ?DateTimeInterface
    {
        return $this->dateGetCode;
    }

    public function setDateGetCode(?DateTimeInterface $dateGetCode): self
    {
        $this->dateGetCode = $dateGetCode;
        return $this;
    }

    public function getDateSendCode(): ?DateTimeInterface
    {
        return $this->dateSendCode;
    }

    public function setDateSendCode(?DateTimeInterface $dateSendCode): self
    {
        $this->dateSendCode = $dateSendCode;
        return $this;
    }

    public function getDateCheckCode(): ?DateTimeInterface
    {
        return $this->dateCheckCode;
    }

    public function setDateCheckCode(?DateTimeInterface $dateCheckCode): self
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getServiceStatus(): ?DcServiceStatus
    {
        return $this->serviceStatus;
    }

    public function setServiceStatus(?DcServiceStatus $serviceStatus): self
    {
        $this->serviceStatus = $serviceStatus;

        return $this;
    }

    public function getInsureDeviceType(): ?DcServiceDeviceType
    {
        return $this->insureDeviceType;
    }

    public function setInsureDeviceType(?DcServiceDeviceType $insureDeviceType): self
    {
        $this->insureDeviceType = $insureDeviceType;

        return $this;
    }

    public function getScheme(): ?DcServiceScheme
    {
        return $this->scheme;
    }

    public function setScheme(?DcServiceScheme $schemeName): self
    {
        $this->scheme = $schemeName;
        return $this;
    }

    /**
     * @TODO: Refactoring to serializer
     */
    public function jsonSerialize(): array
    {
        $data = $this->baseJsonSerialize();

        $data[self::PROPERTY_CREATED_AT] = $this->createdAt->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_MODIFIED_AT] = $this->modifiedAt->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_PRINT] = $this->datePrint?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_GET_CODE] = $this->dateGetCode?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_SEND_CODE] = $this->dateSendCode?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_CHECK_CODE] = $this->dateCheckCode?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_CANCEL] = $this->dateCancel?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_SEND] = $this->dateSend?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_RESPONSE] = $this->dateResponse?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_SEND_CONFIRM] = $this->dateSendConfirm?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_SIGN] = $this->dateSign?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_SEND_SCAN] = $this->dateSendScan?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_REGISTER] = $this->dateRegister?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_RESPONSE_SCAN] = $this->dateResponseScan?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_SEND_SIGN] = $this->dateSendSign?->format(DateTimeFormatEnum::DATE_TIME);
        $data[self::PROPERTY_DATE_RESPONSE_CONFIRM]
            = $this->dateResponseConfirm?->format(DateTimeFormatEnum::DATE_TIME);

        return $data;
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return
            [
                self::PROPERTY_ID => 'Идентификатор',
                self::PROPERTY_CREATED_AT => 'Создана',
                self::PROPERTY_CREATED_BY => 'Создана пользователем',
                self::PROPERTY_MODIFIED_AT => 'Изменена',
                self::PROPERTY_MODIFIED_BY => 'Изменена пользователем',
                self::PROPERTY_ACTIVE => 'Активность',
                self::PROPERTY_SERVICE_NAME => 'Название услуги',
                self::PROPERTY_CODE => 'Символьный код',
                self::PROPERTY_ORDER_ID => 'Заказ',
                self::PROPERTY_APPLICATION_ID => 'Заявка',
                self::PROPERTY_INSURANCENOTBANK_ID => 'Тип услуги',
                self::PROPERTY_BANK_ID => 'Банк',
                self::PROPERTY_SERVICE_STATUS => 'Статус',
                self::PROPERTY_PRICE => 'Цена',
                self::PROPERTY_SHOP_ID => 'Магазин',
                self::PROPERTY_STORE_ID => 'Торговая точка',
                self::PROPERTY_AGENT_ID => 'Агент',
                self::PROPERTY_USER_ID => 'Пользователь',
                self::PROPERTY_PROFILE_ID => 'Анкета пользователя',
                self::PROPERTY_SMS_CODE => 'СМС-код',
                self::PROPERTY_COUNT_SEND_CODE => 'Кол-во отправок СМС-кода',
                self::PROPERTY_COUNT_CHECK_CODE => 'Кол-во проверок СМС-кода',
                self::PROPERTY_DATE_GET_CODE => 'Дата запроса СМС-кода',
                self::PROPERTY_DATE_SEND_CODE => 'Дата отправки СМС-кода',
                self::PROPERTY_DATE_CHECK_CODE => 'Дата ввода СМС-кода',

                self::PROPERTY_DATE_SEND => 'Дата отправки на рассмотрение',
                self::PROPERTY_DATE_SEND_CONFIRM => 'Дата отправки подтверждения',
                self::PROPERTY_DATE_RESPONSE => 'Дата получения решения',
                self::PROPERTY_DATE_RESPONSE_CONFIRM => 'Дата проверки подтверждения',
                self::PROPERTY_DATE_RESPONSE_SCAN => 'Дата проверки сканов',
                self::PROPERTY_DATE_PRINT => 'Дата формирования документов',
                self::PROPERTY_DATE_SIGN => 'Дата подписания',
                self::PROPERTY_DATE_SEND_SIGN => 'Дата отправки о подписании',
                self::PROPERTY_DATE_SEND_SCAN => 'Дата отправки сканов',
                self::PROPERTY_DATE_REGISTER => 'Дата финального ответа',
                self::PROPERTY_DATE_CANCEL => 'Дата отказа клиента',

                self::PROPERTY_CONTRACT_FILE => 'Файл договора',
                self::PROPERTY_CONTRACT_NUMBER => 'Номер договора',
                self::PROPERTY_CONTRACT_NUMBER_HASH => 'Хэш номера договора',
                self::PROPERTY_ACCOUNT_NUMBER => 'Номер счета',
                self::PROPERTY_ADD_ID => 'ID оператора',
                self::PROPERTY_ADD_ID_2 => 'ID оператора 2',
                self::PROPERTY_CARD_NUMBER => 'Номер карты',
                self::PROPERTY_CARD_EXPIRY => 'Срок действия карты',
                self::PROPERTY_BARCODE => 'Штрих-код',
                self::PROPERTY_CONFIRM_CODE => 'Код подтверждения',
                self::PROPERTY_DESIRED_CREDIT_LIMIT => 'Желаемая сумма кредита',
                self::PROPERTY_CREDIT_LIMIT => 'Кредитный лимит',
                self::PROPERTY_CHANGES_REASON_ID => 'Причина возврата заявки на проверку данных',
                self::PROPERTY_S_NAME => 'Текст для поиска',
                self::PROPERTY_CLIENT_TEL => 'Телефон клиента для поиска',
                self::PROPERTY_USLUGA_TEL => 'Телефон оформления услуги для поиска',
                self::PROPERTY_SCHEME_ID => 'Идентификатор схемы оформления',
                self::PROPERTY_SCHEME_NAME => 'Схема оформления',
                self::PROPERTY_SERVICE_BARCODE => 'Штрих-коды',
                self::PROPERTY_ID_PARTNER => 'ID услуги у партнера',
                self::PROPERTY_PRICE_WITH_SALE => 'Цена со скидкой',
                self::PROPERTY_INSURE_PROFILE_ID => 'Застрахованный клиент',
                self::PROPERTY_INSURE_DEVICE_TYPE => 'Тип устройства',
                self::PROPERTY_INSURE_DEVICE_MODEL => 'Модель',
                self::PROPERTY_INSURE_DEVICE_SERIAL => 'Серийный номер',

                self::PROPERTY_SERVICE_LOG_ERRORS => 'Лог ошибок',
                self::PROPERTY_SERVICE_LOG_HISTORY => 'История',
                self::PROPERTY_SERVICE_PARAMS => 'Дополнительные свойства',
            ];
    }
}
