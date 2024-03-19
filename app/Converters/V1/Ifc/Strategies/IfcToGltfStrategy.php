<?php

declare(strict_types=1);

namespace App\Converters\V1\Ifc\Strategies;

use App\Converters\V1\ConvertStrategy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class IfcToGltfStrategy implements ConvertStrategy
{
    public function handle(string $inputPath, string $outputPath): bool
    {
        Log::info('Use Ifc To Gltf Strategy');

        $convertPath = Storage::disk('converters')->path('xeokit');
        // TODO add manifest to -m  option
        $command = "{$convertPath}/ifc2gltfcxconverter -i \"{$inputPath}\" -o \"{$outputPath}\" -m \"{$outputPath}\" -e 3 -s 10";

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
