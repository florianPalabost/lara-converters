<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\CustomFile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CustomFile
 */
class CustomFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            /** @var string $id the ID of the custom file */
            'id'        => $this->id,

            /** @var string $name the name of the custom file */
            'name'      => $this->name,

            /** @var string $path the path of the custom file */
            'path'      => $this->path,

            /** @var string $mime_type the mime type of the custom file */
            'mime_type' => $this->mime_type,

            /** @var string $extension the extension of the custom file */
            'extension' => $this->extension,

            /** @var int $size the size of the custom file */
            'size'      => $this->size,

            /** @var string $added_by the ID of the user who added the custom file */
            'added_by'  => $this->added_by,
        ];
    }
}
