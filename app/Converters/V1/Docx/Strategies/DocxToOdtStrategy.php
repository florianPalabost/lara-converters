<?php

declare(strict_types=1);

namespace App\Converters\V1\Docx\Strategies;

use App\Converters\V1\ConvertStrategy;
use Illuminate\Support\Facades\Log;

class DocxToOdtStrategy implements ConvertStrategy
{
    public function handle(string $inputPath, string $outputPath): bool
    {
        Log::info('Use Docx To Odt Strategy');

        // TODO : Add a command to convert docx to odt

        return true;
    }
}
