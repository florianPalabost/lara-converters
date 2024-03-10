<?php

declare(strict_types=1);

namespace App\Converters\V1;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

abstract class Converter
{
    protected ConvertStrategy $convertStrategy;

    abstract public function convert(string $inputPath, string $outputPath, string $destExtension): bool;

    /**
     * Handle the given input paths and return the result.
     *
     * @param array $inputPaths The array of input paths.
     * @param Closure $next The closure to be executed.
     * @param string $destExtension The destination extension.
     * @return array|Collection The result of the closure execution.
     */
    public function handle(array $inputPaths, Closure $next, string $destExtension): array|Collection
    {
        $outputPaths = [];

        foreach ($inputPaths as $inputPath) {
            $filenameWithExtension = basename($inputPath);
            [$filename, $inputExtension] = explode('.', $filenameWithExtension);
            $outputDir = Storage::path('output');
            $outputPath = $outputDir . '/' . $filename . '.' . $destExtension;

            $this->convert($inputPath, $outputDir, $destExtension);

            $outputPaths[] = $outputPath;
        }

        // the return type is not the closure but the array
        return $next($outputPaths);
    }

    public function setConvertStrategy(ConvertStrategy $convertStrategy): self
    {
        $this->convertStrategy = $convertStrategy;

        return $this;
    }
}
