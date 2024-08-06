<?php

declare(strict_types=1);

namespace App\Infrastructure;

/**
 * Class RedisDsnTransformer
 */
class RedisDsnTransformer
{
    private const TEMPLATE_CLUSTER_DSN = 'redis:?host[%s]&redis_cluster=1';
    private const TEMPLATE_SIMPLE_DSN = 'redis://%s';
    private const SEPARATOR_CLUSTER_HOST = ']&host[';
    private const SEPARATOR_HOST_DSN = ',';

    public function transform(string $dsn): string
    {
        $hosts = explode(self::SEPARATOR_HOST_DSN, $dsn);

        if (count($hosts) > 1) {
            return $this->clusterDsn($hosts);
        }

        return $this->simpleDsn($dsn);
    }

    private function simpleDsn(string $dsn): string
    {
        return sprintf(self::TEMPLATE_SIMPLE_DSN, $dsn);
    }

    /**
     * @param string[] $hosts
     * @return string
     */
    private function clusterDsn(array $hosts): string
    {
        return sprintf(self::TEMPLATE_CLUSTER_DSN, implode(self::SEPARATOR_CLUSTER_HOST, $hosts));
    }
}
