<?php

declare(strict_types=1);

namespace App\Converters\V1;

use App\Converters\V1\Docx\DocxConverter;
use App\Converters\V1\Gltf\GltfConverter;
use App\Converters\V1\Ifc\IfcConverter;
use App\Converters\V1\Odt\OdtConverter;
use App\Converters\V1\Pdf\PdfConverter;
use App\Converters\V1\Png\PngConverter;
use App\Models\CustomFile;
use Exception;
use Illuminate\Support\Arr;

class ConverterFactory
{
    /**
     * Creates a converter based on the file extension.
     *
     * @param CustomFile $customFile The custom file object.
     * @return Converter The created converter.
     *
     * @throws Exception If the file extension is invalid.
     */
    public static function createConverter(CustomFile $customFile): Converter
    {
        return match ($customFile->extension) {
            'odt'   => new OdtConverter,
            'docx'  => new DocxConverter,
            'pdf'   => new PdfConverter,
            default => throw new Exception('Invalid file extension')
        };
    }

    /**
     * Generate a pipeline for file conversion based on the input and destination extensions.
     *
     * @param string $inputExtension The input file extension.
     * @param string $destExtension The destination file extension.
     * @return array<string,string[]> The array of pipes for the conversion pipeline.
     *
     * @throws Exception If the input or destination file extension is invalid.
     */
    public static function createPipeline(string $inputExtension, string $destExtension): array
    {
        $converters = self::getMappingInputOutputConverters();

        if (! Arr::has($converters, $inputExtension)) {
            throw new Exception('Invalid input file extension');
        }

        if (! Arr::has($converters[$inputExtension], $destExtension)) {
            throw new Exception('Invalid destination file extension');
        }

        return $converters[$inputExtension][$destExtension];
    }

    /**
     * Returns an array of mapping input-output converters.
     *
     * @return array<string,array<string,string[]>> Returns an array of converters and their mappings.
     */
    private static function getMappingInputOutputConverters(): array
    {
        return [
            'ifc'  => [
                'xkt' => [
                    IfcConverter::class . ':gltf',
                    GltfConverter::class . ':xkt',
                ],
            ],
            'gltf' => [
                'xkt' => [
                    GltfConverter::class . ':xkt',
                ],
            ],
            'odt'  => [
                'pdf'  => [
                    OdtConverter::class . ':docx',
                    DocxConverter::class . ':pdf',
                ],
                'docx' => [
                    OdtConverter::class . ':docx',
                ],
                'png'  => [
                    OdtConverter::class . ':png',
                ],
            ],
            'docx' => [
                'pdf' => [
                    DocxConverter::class . ':pdf',
                ],
                'odt' => [
                    DocxConverter::class . ':odt',
                ],
                'png' => [
                    DocxConverter::class . ':png',
                ],
            ],
            'png'  => [
                'pdf'  => [
                    PngConverter::class . ':pdf',
                ],
                'docx' => [
                    PngConverter::class . ':docx',
                ],
                'odt'  => [
                    PngConverter::class . ':odt',
                ],
            ],
        ];
    }
}
