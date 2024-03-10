<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

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
        // @see https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
        $mappingMimetypes = [
            'pdf'  => 'application/pdf',
            'odt'  => 'application/vnd.oasis.opendocument.text',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'csv'  => 'text/csv',
            'txt'  => 'text/plain',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
        ];

        return [
            'file_input' => ['required', 'file', 'mimetypes:' . implode(',', $mappingMimetypes)],
            'name'       => ['required', 'string'],
            'added_by'   => ['required', 'uuid'],
        ];
    }
}
