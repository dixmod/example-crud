<?php

declare(strict_types=1);

namespace App\Service\DcService;

use App\Dto\Request\Find\Service\ByOrdersDto;
use App\Dto\Request\Find\Service\ListSearchDto;
use App\Entity\DcService;
use App\Exception\Http\NotFoundException;
use App\Repository\DcServiceRepository;
use App\Service\BaseGetter;
use DateTime;
use Doctrine\Common\Collections\Criteria;
use Exception;

/**
 * Class Getter
 */
class RepositoryGetter extends BaseGetter implements Getter
{
    private ?int $offset = null;

    private ?int $limit = null;

    /**
     * @param DcServiceRepository $repository
     */
    public function __construct(
        protected DcServiceRepository $repository
    ) {
        $this->commonRepository = $this->repository;
    }

    /**
     * @param $id
     * @return DcService|null
     * @throws NotFoundException
     */
    public function findById($id): ?DcService
    {
        $entity = $this->repository->find($id);

        if (null === $entity) {
            throw new NotFoundException();
        }

        return $entity;
    }

    /**
     * @param int $partnerId
     * @param int $shopId
     * @return DcService
     * @throws NotFoundException
     */
    public function findByPartnerIdInShop(int $partnerId, int $shopId): DcService
    {
        $entity = $this->repository->findOneBy(
            [
                'idPartner' => (string)$partnerId,
                'shopId' => $shopId,
            ],
            static::DEFAULT_ORDER
        );

        if (null === $entity) {
            throw new NotFoundException();
        }

        return $entity;
    }

    /**
     * @param int[] $id
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByIds(array $id): array
    {
        $entities = $this->repository->findBy(
            [
                DcService::PROPERTY_ID => $id,
            ],
            static::DEFAULT_ORDER
        );

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param ByOrdersDto $request
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByOrder(
        ByOrdersDto $request
    ): array {
        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->eq('orderId', $request->getOrderId()));
        if ($request->isOnlyActive()) {
            $criteria->andWhere(Criteria::expr()->eq(DcService::PROPERTY_ACTIVE, true));
        }

        if (count($request->getIsStatuses()) > 0) {
            $criteria->andWhere(Criteria::expr()->in('serviceStatusId', $request->getIsStatuses()));
        }

        if (count($request->getIsNotStatuses()) > 0) {
            $criteria->andWhere(Criteria::expr()->notIn('serviceStatusId', $request->getIsNotStatuses()));
        }

        if (count($request->getNotBankIds()) > 0) {
            $criteria = $this->applyInsuranceNotBankId($criteria, $request->getNotBankIds());
        }

        $entities = $this->repository->matching($criteria)->toArray();

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param int $orderId
     * @param int $statusId
     * @param array $excludeServiceId
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findStatusByOrder(int $orderId, int $statusId, array $excludeServiceId = []): array
    {
        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->eq('orderId', $orderId));
        $criteria->andWhere(Criteria::expr()->eq(DcService::PROPERTY_ACTIVE, true));
        $criteria->andWhere(Criteria::expr()->eq('serviceStatusId', $statusId));

        if (count($excludeServiceId) > 0) {
            $criteria->andWhere(Criteria::expr()->notIn(DcService::PROPERTY_ID, $excludeServiceId));
        }

        $entities = $this->repository->matching($criteria)->toArray();

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param ListSearchDto $listDto
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findListSearch(ListSearchDto $listDto): array
    {
        $criteria = $this->getListSearchCriteria($listDto);
        $criteria->orderBy([DcService::PROPERTY_CREATED_AT =>  Criteria::DESC]);
        $entities = $this->repository->matching($criteria)->toArray();

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param ListSearchDto $listDto
     * @return int
     */
    public function countListSearch(ListSearchDto $listDto): int
    {
        $criteria = $this->getListSearchCriteria($listDto);

        return $this->repository->matching($criteria)->count();
    }

    /**
     * @param ListSearchDto $listDto
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByAgentFilter(ListSearchDto $listDto): array
    {
        return $this->findListSearch($listDto);
    }

    public function findOneBy(array $filter)
    {
        // TODO: Implement findOneBy() method.
    }

    /**
     * Ищем авторизованные услуги не старше $notOldDays дней
     * @param int $notBankId
     * @param int $notOldDays Не старше дней
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findAuthNotOld(int $notBankId, int $notOldDays): array
    {
        $fromDate = new DateTime();
        $fromDate->setTimestamp(time() - ($notOldDays * 86400));

        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->eq('insurancenotbankId', $notBankId));
        $criteria->andWhere(Criteria::expr()->eq('serviceStatusId', DcService::CONTRACT_AUTH));
        $criteria->andWhere(Criteria::expr()->gte(DcService::PROPERTY_CREATED_AT, $fromDate));

        $entities = $this->repository->matching($criteria)->toArray();

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param int $orderId
     * @param int[] $appIds
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByOrderAndApp(int $orderId, array $appIds = []): array
    {
        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->eq('orderId', $orderId));

        if (count($appIds) > 0) {
            $criteria->orWhere(Criteria::expr()->in('applicationId', $appIds));
        }

        $entities = $this->repository->matching($criteria)->toArray();

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param int $orderId
     * @param int[] $types
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByOrderAndType(int $orderId, array $types): array
    {
        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->eq('orderId', $orderId));

        if (count($types) > 0) {
            $criteria->andWhere(Criteria::expr()->in('insurancenotbankId', $types));
        }

        $entities = $this->repository->matching($criteria)->toArray();

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param int $id
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByAppId(int $id): array
    {
        $entities = $this->repository->findBy(
            [
                'applicationId' => $id,
            ],
            static::DEFAULT_ORDER
        );

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param int $appId
     * @param int $notBankId
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByAppAndType(int $appId, int $notBankId): array
    {
        $entities = $this->repository->findBy(
            [
                'applicationId' => $appId,
                'insurancenotbankId' => $notBankId,
            ],
            static::DEFAULT_ORDER
        );

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param string $dateFrom
     * @param string $dateTo
     * @param string $order
     * @return DcService[]
     * @throws NotFoundException
     */
    public function findByDatePrint(string $dateFrom, string $dateTo, string $order): array
    {
        $fromDate = new DateTime();
        $fromDate->setTimestamp(strtotime($dateFrom));

        $toDate = new DateTime();
        $toDate->setTimestamp(strtotime($dateTo));

        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->gt('datePrint', $fromDate));
        $criteria->andWhere(Criteria::expr()->lt('datePrint', $toDate));

        $criteria->orderBy([DcService::PROPERTY_ID => $order]);

        $entities = $this->repository->matching($criteria)->toArray();

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities;
    }

    /**
     * @param string $type
     * @param int $shopId
     * @param array|int $status
     * @param string $dateBeforeSigning
     * @param string $dateAfterSigning
     * @return DcService[]
     * @throws Exception
     */
    public function findAllByTypeAndShop(
        string $type,
        int $shopId,
        array|int $status,
        string $dateBeforeSigning,
        string $dateAfterSigning
    ): array {
        // TODO: ROSTELECOM, не используем
        throw new Exception('ROSTELECOM, не используем');
    }

    /**
     * @return DcService
     * @throws NotFoundException
     */
    public function findLast(): DcService
    {
        $entities = $this->repository->findBy([], self::DEFAULT_ORDER_DESC, 1, 0);

        if (count($entities) === 0) {
            throw new NotFoundException();
        }

        return $entities[0];
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @param ListSearchDto $listDto
     * @return Criteria
     */
    public function getListSearchCriteria(ListSearchDto $listDto): Criteria
    {
        $criteria = new Criteria();

        if ($listDto->getFromCreatedAt() !== null) {
            $criteria->andWhere(
                Criteria::expr()->gte(DcService::PROPERTY_CREATED_AT, $listDto->getFromCreatedAt())
            );
        }

        if ($listDto->getToCreatedAt() !== null) {
            $criteria->andWhere(
                Criteria::expr()->lte(DcService::PROPERTY_CREATED_AT, $listDto->getToCreatedAt())
            );
        }

        if ($listDto->isActive() !== null) {
            $criteria->andWhere(
                Criteria::expr()->eq(DcService::PROPERTY_ACTIVE, $listDto->isActive())
            );
        }

        if ($listDto->getId() > 0) {
            $criteria->andWhere(
                Criteria::expr()->eq(DcService::PROPERTY_ID, $listDto->getId())
            );
        } elseif ($listDto->getFromId() > 0) {
            $criteria->andWhere(
                Criteria::expr()->gt(DcService::PROPERTY_ID, $listDto->getFromId())
            );
        }

        if (count($listDto->getShopIds()) > 0) {
            $criteria->andWhere(
                Criteria::expr()->in(DcService::PROPERTY_SHOP_ID, $listDto->getShopIds())
            );
        }

        if (count($listDto->getInStatuses()) > 0) {
            $criteria->andWhere(
                Criteria::expr()->in('serviceStatusId', $listDto->getInStatuses())
            );
        }

        if (count($listDto->getNotInStatuses()) > 0) {
            $criteria->andWhere(
                Criteria::expr()->notIn('serviceStatusId', $listDto->getNotInStatuses())
            );
        }

        if (count($listDto->getOutletIds()) > 0) {
            $criteria->andWhere(
                Criteria::expr()->in(DcService::PROPERTY_STORE_ID, $listDto->getOutletIds())
            );
        }

        if ($listDto->isNeedNullAgentId()) {
            $criteria->andWhere(
                Criteria::expr()->in(DcService::PROPERTY_AGENT_ID, [null, $listDto->getAgentId()])
            );
        } elseif ($listDto->getAgentId() > 0) {
            $criteria->andWhere(Criteria::expr()->eq(DcService::PROPERTY_AGENT_ID, $listDto->getAgentId()));
        }

        if (count($listDto->getProfileIds()) > 0) {
            $criteria->andWhere(Criteria::expr()->in(DcService::PROPERTY_PROFILE_ID, $listDto->getProfileIds()));
        }

        if (count($listDto->getIds()) > 0) {
            $criteria->andWhere(Criteria::expr()->in(DcService::PROPERTY_ID, $listDto->getIds()));
        }

        if (count($listDto->getOrderIds()) > 0) {
            $criteria->andWhere(
                Criteria::expr()->in(DcService::PROPERTY_ORDER_ID, $listDto->getOrderIds())
            );
        }

        if ($listDto->getAddId() !== '') {
            $criteria->andWhere(
                Criteria::expr()->eq(DcService::PROPERTY_ADD_ID, $listDto->getAddId())
            );
        }

        if ($listDto->getInsuranceNotBankId() !== null) {
            $criteria = $this->applyInsuranceNotBankId($criteria, [$listDto->getInsuranceNotBankId()]);
        }

        if ($this->getLimit() !== null) {
            $criteria->setMaxResults($this->getLimit());
            $criteria->setFirstResult($this->getOffset());
        }

        return $criteria;
    }

    private function applyInsuranceNotBankId(Criteria $criteria, array $insuranceNotBankIds): Criteria
    {
        return $criteria->andWhere(
            Criteria::expr()->in(DcService::PROPERTY_INSURANCENOTBANK_ID, $insuranceNotBankIds)
        );
    }
}
