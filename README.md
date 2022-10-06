# JSON Zlib Compressor

A library to (de-)compress JSON strings using `zlib`.

## Usage

```php
use Json\ZlibCompressor;

$data = [
    'test' => 12,
    'key' => [1, 2, 3],
];

\assert(
    $data === ZlibCompressor::inflate(ZlibCompressor::deflate($data)),
);
```
