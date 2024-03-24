<?php

declare(strict_types=1);

namespace App\Converters\V1\Png;

use App\Converters\V1\Converter;
use App\Converters\V1\Png\Strategies\PngToDocxStrategy;
use App\Converters\V1\Png\Strategies\PngToOdtStrategy;
use App\Converters\V1\Png\Strategies\PngToPdfStrategy;
use Exception;

class PngConverter extends Converter
{
    public function convert(string $inputPath, string $outputPath, string $destExtension): bool
    {
        $strategy = match ($destExtension) {
            'pdf'   => new PngToPdfStrategy,
            'odt'   => new PngToOdtStrategy,
            'docx'  => new PngToDocxStrategy,
            default => throw new Exception(static::class . ' > Invalid dest file extension'),
        };

        $this->setConvertStrategy($strategy);

        return $this->convertStrategy->handle($inputPath, $outputPath);
    }
}
