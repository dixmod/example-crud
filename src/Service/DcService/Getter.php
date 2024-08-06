<?php

namespace App\Service\DcService;

use App\Dto\Request\Find\Service\ByOrdersDto;
use App\Dto\Request\Find\Service\ListSearchDto;
use App\Entity\DcService;
use App\Exception\Http\NotFoundException;
use Exception;

/**
 * Getter = OfflineServiceManager
 */
interface Getter
{
    /**
     * @param $id
     * @return null|DcService
     * @throws Exception
     */
    public function findById($id): ?DcService;

    /**
     * @param int $partnerId
     * @param int $shopId
     * @return DcService
     * @throws NotFoundException
     */
    public function findByPartnerIdInShop(int $partnerId, int $shopId): DcService;

    /**
     * @param int[] $id
     * @return DcService[]
     */
    public function findByIds(array $id): array;

    /**
     * @param ByOrdersDto $request
     * @return DcService[]
     * @throws Exception
     */
    public function findByOrder(ByOrdersDto $request): array;

    /**
     * @param int $orderId
     * @param int $statusId
     * @param array $excludeServiceId
     * @return DcService[]
     */
    public function findStatusByOrder(int $orderId, int $statusId, array $excludeServiceId = []): array;

    /**
     * @param ListSearchDto $listDto
     * @return DcService[]
     */
    public function findByAgentFilter(ListSearchDto $listDto): array;

    /**
     * @param ListSearchDto $listDto
     * @return DcService[]
     */
    public function findListSearch(ListSearchDto $listDto): array;

    /**
     * @param ListSearchDto $listDto
     * @return int
     */
    public function countListSearch(ListSearchDto $listDto): int;

    public function findOneBy(array $filter);

    /**
     * Ищем авторизованные услуги не старше $notOldDays дней
     * @param int $notBankId
     * @param int $notOldDays Не старше дней
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findAuthNotOld(int $notBankId, int $notOldDays): array;

    /**
     * @param int $orderId
     * @param int[] $appIds
     * @return DcService[]
     */
    public function findByOrderAndApp(int $orderId, array $appIds = []): array;

    /**
     * @param int $orderId
     * @param int[] $types
     * @return DcService[]
     */
    public function findByOrderAndType(int $orderId, array $types): array;

    /**
     * @param int $id
     * @return DcService[]
     */
    public function findByAppId(int $id): array;

    /**
     * @param int $appId
     * @param int $notBankId
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByAppAndType(int $appId, int $notBankId): array;

    /**
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $order
     * @return DcService[]
     */
    public function findByDatePrint(string $dateFrom, string $dateTo, string $order): array;

    /**
     * @param string $type
     * @param int $shopId
     * @param array|int $status
     * @param string $dateBeforeSigning
     * @param string $dateAfterSigning
     * @return DcService[]
     */
    public function findAllByTypeAndShop(
        string $type,
        int $shopId,
        array|int $status,
        string $dateBeforeSigning,
        string $dateAfterSigning
    ): array;

    /**
     * @return DcService
     */
    public function findLast(): DcService;

    /**
     * @param int $offset
     */
    public function setOffset(int $offset);

    /**
     * @param int $limit
     */
    public function setLimit(int $limit);

    /**
     * @return int|null
     */
    public function getOffset(): ?int;

    /**
     * @return int|null
     */
    public function getLimit(): ?int;
}
