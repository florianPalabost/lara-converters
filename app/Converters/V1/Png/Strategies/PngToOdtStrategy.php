<?php

declare(strict_types=1);

namespace App\Converters\V1\Png\Strategies;

use App\Converters\V1\ConvertStrategy;
use Illuminate\Support\Facades\Log;

class PngToOdtStrategy implements ConvertStrategy
{
    public function handle(string $inputPath, string $outputPath): bool
    {
        Log::info('Use Png To Odt Strategy');
        // Log::info($command);
        // TODO : Add a command to convert docx to odt

        return true;
    }
}
