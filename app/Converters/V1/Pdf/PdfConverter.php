<?php

declare(strict_types=1);

namespace App\Converters\V1\Pdf;

use App\Converters\V1\Converter;
use Exception;

class PdfConverter extends Converter
{
    public function convert(string $inputPath, string $outputPath, string $destExtension): bool
    {
        $strategy = match ($destExtension) {
            // '7z'    => new CompressFilesStrategy,
            default => throw new Exception('Pdf Converter > Invalid dest file extension'),
        };

        $this->setConvertStrategy($strategy);

        return $this->convertStrategy->handle($inputPath, $outputPath);
    }
}
