<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\Enums\InputFileExtensionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreCustomFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string'],
            'path'      => ['required', 'string'],
            'mime_type' => ['required', 'string'],
            'extension' => ['required', new Enum(InputFileExtensionEnum::class)],
            'size'      => ['required', 'integer'],
            'added_by'  => ['required', 'uuid'],
        ];
    }
}
