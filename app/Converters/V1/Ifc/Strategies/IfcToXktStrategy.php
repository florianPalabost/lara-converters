<?php

declare(strict_types=1);

namespace App\Converters\V1\Ifc\Strategies;

use App\Converters\V1\ConvertStrategy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class IfcToIktStrategy implements ConvertStrategy
{
    public function handle(string $inputPath, string $outputPath): bool
    {
        Log::info('Use Ifc To Xkt Strategy');

        $command = "node convert2xkt.js --source {$inputPath} --format ifc --output {$outputPath}";

        if (app()->hasDebugModeEnabled()) {
            $command .= ' --log';
        }

        Log::info("cli command: {$command}");
        $result = Process::run($command);

        if ($result->successful() === false) {
            Log::error('Error converting file : ' . $inputPath);

            return false;
        }

        Log::info('Successfully Converted file to : ' . $outputPath);

        return true;
    }
}
