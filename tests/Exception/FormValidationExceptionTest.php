<?php

declare(strict_types=1);

namespace App\Tests\Exception;

use App\Exception\Http\FormValidationException;
use Generator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Class FormValidationExceptionTest
 */
class FormValidationExceptionTest extends KernelTestCase
{
    #[DataProvider('dataProviderParsingMessage')]
    public function testParsingMessage(string $message, array $expected): void
    {
        $exception = new FormValidationException($message);
        $this->assertEquals($expected, $exception->getData());
    }

    /**
     * @return Generator
     */
    public static function dataProviderParsingMessage(): Generator
    {
        yield [
            'message' => 'active: This value should be of type bool.',
            'expected' => [
                'fields' => [
                    'active' => 'This value should be of type bool.',
                ],
            ],
        ];

        yield [
            'message' => 'active: This value should be of type bool.' . PHP_EOL .
                'insureProfileId: This value should be of type int.',
            'expected' => [
                'fields' => [
                    'active' => 'This value should be of type bool.',
                    'insureProfileId' => 'This value should be of type int.',
                ],
            ],
        ];

        yield [
            'message' => 'active:' . PHP_EOL . 'This value should be of type bool.' . PHP_EOL .
                'insureProfileId:' . PHP_EOL . 'This value should be of type int.',
            'expected' => [
                'fields' => [
                    'active' => 'This value should be of type bool.',
                    'insureProfileId' => 'This value should be of type int.',
                ],
            ],
        ];
    }
}
