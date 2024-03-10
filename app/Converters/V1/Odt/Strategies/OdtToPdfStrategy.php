<?php

declare(strict_types=1);

namespace App\Converters\V1\Odt\Strategies;

use App\Converters\V1\ConvertStrategy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class OdtToPdfStrategy implements ConvertStrategy
{
    public function handle(string $inputPath, string $outputPath): bool
    {
        Log::info('Use Odt to Pdf Strategy');

        $command = "libreoffice --headless --convert-to pdf {$inputPath} --outdir {$outputPath}";
        Log::info($command);
        $result = Process::run($command);

        if ($result->successful() === false) {
            Log::error('Error converting file : ' . $inputPath);

            return false;
        }

        return true;
    }
}
