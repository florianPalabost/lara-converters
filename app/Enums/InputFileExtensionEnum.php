<?php

declare(strict_types=1);

namespace App\Enums;

enum InputFileExtensionEnum: string
{
    case PDF = 'pdf';
    case DOCX = 'docx';
}
