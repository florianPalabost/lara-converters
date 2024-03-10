<?php

declare(strict_types=1);

namespace App\Converters\V1\Docx;

use App\Converters\V1\Converter;
use App\Converters\V1\Docx\Strategies\DocxToOdtStrategy;
use App\Converters\V1\Docx\Strategies\DocxToPdfStrategy;
use App\Converters\V1\Docx\Strategies\DocxToPngStrategy;
use Exception;

class DocxConverter extends Converter
{
    public function convert(string $inputPath, string $outputPath, string $destExtension): bool
    {
        // guess strategy based on destination extension
        $strategy = match ($destExtension) {
            'pdf'   => app(DocxToPdfStrategy::class), // new DocxToPdfStrategy,
            'odt'   => app(DocxToOdtStrategy::class),
            'png'   => app(DocxToPngStrategy::class),
            // '7z'    => new CompressFilesStrategy,
            default => throw new Exception(static::class . ' > Invalid dest file extension'),
        };

        $this->setConvertStrategy($strategy);

        return $this->convertStrategy->handle($inputPath, $outputPath);
    }
}
