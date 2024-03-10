<?php

declare(strict_types=1);

namespace App\Converters\V1\Odt;

use App\Converters\V1\Converter;
use App\Converters\V1\Odt\Strategies\OdtToDocxStrategy;
use App\Converters\V1\Odt\Strategies\OdtToPdfStrategy;
use Exception;

class OdtConverter extends Converter
{
    public function convert(string $inputPath, string $outputPath, string $destExtension): bool
    {
        $strategy = match ($destExtension) {
            'docx'  => new OdtToDocxStrategy,
            'pdf'   => new OdtToPdfStrategy,
            // '7z'    => new CompressFilesStrategy,
            default => throw new Exception('Pdf Converter > Invalid dest file extension'),
        };

        $this->setConvertStrategy($strategy);

        return $this->convertStrategy->handle($inputPath, $outputPath);
    }
}
