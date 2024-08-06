<?php

namespace App\Service;

use App\Entity\DcService;
use App\Exception\Http\NotFoundException;
use App\Service\DcService\RepositoryGetter;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\RedisSessionHandler;

/**
 * Class HealthChecker
 * @package App\Service
 */
class HealthChecker
{
    private const CHECK_SERVICE_ID = 482930135;
    private const VALUE_OK = 'OK';
    private const NAME_KEY = 'additional_product_store_test';

    public function __construct(
        private readonly CacheItemPoolInterface $cache,
        private readonly RepositoryGetter $getter,
        private readonly RedisSessionHandler $sessionHandler
    ) {
    }

    /**
     * @return bool
     * @throws InvalidArgumentException
     */
    public function checkRedis(): bool
    {
        $cacheItem = $this->cache->getItem(self::NAME_KEY);
        $cacheItem->set(self::VALUE_OK);
        $cacheItem->expiresAfter(6);
        $this->cache->save($cacheItem);
        $cacheItem = $this->cache->getItem(self::NAME_KEY);

        return (string)$cacheItem->get() === self::VALUE_OK;
    }

    /**
     * @return DcService|null
     * @throws NotFoundException
     */
    public function checkDb(): ?DcService
    {
        return $this->getter->findById(self::CHECK_SERVICE_ID);
    }

    public function checkSessionRedis(): bool
    {
        $this->sessionHandler->write(self::NAME_KEY, self::VALUE_OK);
        return $this->sessionHandler->read(self::NAME_KEY) === self::VALUE_OK;
    }
}
