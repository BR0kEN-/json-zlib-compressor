<?php declare(strict_types=1);

namespace Json;

class ZlibCompressor
{
    /**
     * @throws \JsonException
     */
    public static function deflate(array $json): string
    {
        return \strtr(
            \base64_encode(
                \addslashes(
                    \gzcompress(
                        \json_encode($json, \JSON_THROW_ON_ERROR),
                        9,
                    ),
                ),
            ),
            '+/=',
            '-_,',
        );
    }

    public static function inflate(string $json): array
    {
        return \json_decode(
            \gzuncompress(
                \stripslashes(
                    \base64_decode(
                        \strtr(
                            $json,
                            '-_,',
                            '+/=',
                        ),
                    ),
                ),
            ),
            true,
            512,
            \JSON_THROW_ON_ERROR,
        );
    }
}
