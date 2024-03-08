<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\Enums\OutputFileExtensionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ConvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO: authorize
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // TODO: in / out formats
        return [
            'file_id'       => ['required', 'uuid', 'exists:custom_files,id'],
            'output_format' => ['required', 'string', new Enum(OutputFileExtensionEnum::class)],
        ];
    }
}
