<?php

declare(strict_types=1);

namespace App\Converters\V1\Odt\Strategies;

use App\Converters\V1\ConvertStrategy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class OdtToDocxStrategy implements ConvertStrategy
{
    public function handle(string $inputPath, string $outputPath): bool
    {
        Log::info('Use Odt to Docx Strategy');

        $command = 'soffice --headless --convert-to "docx:MS Word 2007 XML" "' . $inputPath . '" --outdir ' . $outputPath;
        Log::info($command);
        $result = Process::run($command);

        if ($result->successful() === false) {
            Log::error('Error converting file : ' . $result->errorOutput());
        }

        Log::info('Successfully Converted file to : ' . $outputPath);

        return true;
    }
}
