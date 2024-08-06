<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure;

use App\Infrastructure\RedisDsnTransformer;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class RedisDsnTransformerTest
 */
class RedisDsnTransformerTest extends KernelTestCase
{
    private RedisDsnTransformer $transformer;

    public function setUp(): void
    {
        $this->transformer = new RedisDsnTransformer();
    }

    #[DataProvider(methodName: 'dataProviderTransform')]
    public function testTransform(string $input, string $expected)
    {
        $this->assertEquals($expected, $this->transformer->transform($input));
    }

    public function dataProviderTransform(): Generator
    {
        yield [
            'input' => '111.111.111.111:6379,222.222.222.222:6379',
            'expected' => 'redis:?host[111.111.111.111:6379]&host[222.222.222.222:6379]&redis_cluster=1'
        ];

        yield [
            'input' => '111.111.111.111:6379',
            'expected' => 'redis://111.111.111.111:6379'
        ];
    }
}
