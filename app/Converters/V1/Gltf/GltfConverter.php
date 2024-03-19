<?php

declare(strict_types=1);

namespace App\Converters\V1\Gltf;

use App\Converters\V1\Converter;
use App\Converters\V1\Gltf\Strategies\GltfToXktStrategy;
use Exception;

class GltfConverter extends Converter
{
    public function convert(string $inputPath, string $outputPath, string $destExtension): bool
    {
        // guess strategy based on destination extension
        $strategy = match ($destExtension) {
            'xkt'   => app(GltfToXktStrategy::class),
            default => throw new Exception(static::class . ' > Invalid dest file extension'),
        };

        $this->setConvertStrategy($strategy);

        return $this->convertStrategy->handle($inputPath, $outputPath);
    }
}
