<?php

declare(strict_types=1);

namespace App\Converters\V1\Docx\Strategies;

use App\Converters\V1\ConvertStrategy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class DocxToPngStrategy implements ConvertStrategy
{
    public function handle(string $inputPath, string $outputPath): bool
    {
        Log::info('Use Docx To Png Strategy');

        $command = "soffice --headless --convert-to png {$inputPath} --outdir {$outputPath}";
        Log::info($command);
        $result = Process::run($command);

        if ($result->successful() === false) {
            Log::error('Error converting file : ' . $inputPath);

            return false;
        }

        Log::info('Successfully Converted file to : ' . $outputPath);

        return true;
    }
}
