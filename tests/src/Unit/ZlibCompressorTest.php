<?php declare(strict_types=1);

namespace Json\Tests\Unit;

use Json\ZlibCompressor;
use PHPUnit\Framework\TestCase;

class ZlibCompressorTest extends TestCase
{
    public function testDeflateInflate(): void
    {
        $source = [
            'id' => 1,
            'name' => 'Test',
            'team' => [
                'id' => 1,
                'name' => 'Superheroes',
                'deleted_at' => null,
                'can_be' => [
                    'archived' => true,
                    'restored' => false,
                    'updated' => true,
                ],
            ],
            'domain' => 'example.com',
            'region' => 'US',
            'language' => 'en-US',
            'is_auth_required' => false,
            'auth_provider' => 1,
            'is_template' => true,
            'config_token' => 'my_token_1',
            'ms_env' => 'production',
            'icons' => [
                'square',
            ],
            'config' => null,
            'author' => [
                'id' => 5,
                'name' => 'Jon Doe',
            ],
            'created_at' => '2022-04-11T10:45:48.000000Z',
            'updated_at' => '2022-04-11T10:49:24.000000Z',
            'deleted_at' => null,
            'can_be' => [
                'duplicated' => true,
                'archived' => true,
                'restored' => false,
                'updated' => true,
            ],
        ];

        $deflated = ZlibCompressor::deflate($source);

        // Prove compression efficacy.
        static::assertGreaterThan(\strlen($deflated), \strlen(\json_encode($source, \JSON_THROW_ON_ERROR)));
        // Ensure inflation returns the data that was used for deflation.
        static::assertSame($source, ZlibCompressor::inflate($deflated));
    }
}
