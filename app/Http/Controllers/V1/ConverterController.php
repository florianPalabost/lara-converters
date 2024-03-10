<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Enums\OutputFileExtensionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ConvertRequest;
use App\Jobs\ProcessConvertFile;
use App\Models\CustomFile;
use App\Utils\MyArr;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\HttpFoundation\Response;

class ConverterController extends Controller
{
    public function convert(ConvertRequest $request, CustomFile $file): JsonResource
    {
        $input = $request->validated();

        abort_if(empty($input), Response::HTTP_UNPROCESSABLE_ENTITY);

        $outputFormat = OutputFileExtensionEnum::tryFrom(MyArr::getString($input, 'output_format'))?->value;

        abort_if($outputFormat === null, Response::HTTP_UNPROCESSABLE_ENTITY);

        // TODO use laravel-status to get job uuid
        $jobId = Queue::push(new ProcessConvertFile($file, $outputFormat));

        return new JsonResource([
            'job_id' => $jobId,
        ]);
    }
}
