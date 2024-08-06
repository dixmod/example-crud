<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Redis;
use RedisArray;
use RedisCluster;
use Symfony\Component\Cache\Adapter\RedisAdapter as SymfonyRedisAdapter;

/**
 * Class RedisAdapter
 */
class RedisAdapter
{
    public function __construct(
        private readonly RedisDsnTransformer $transformer,
    ) {
    }

    /**
     * @param string $dsn
     * @param array<string, string|bool|int|null> $options
     * @return Redis|RedisArray|RedisCluster
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function createConnection(
        #[\SensitiveParameter] string $dsn,
        array $options = []
    ): Redis|RedisArray|RedisCluster {
        return SymfonyRedisAdapter::createConnection($this->transformer->transform($dsn), $options);
    }
}
