<?php

declare(strict_types=1);

namespace App\Converters\V1;

interface ConvertStrategy
{
    public function handle(string $inputPath, string $outputPath): bool;
}
