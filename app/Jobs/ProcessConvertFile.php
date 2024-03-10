<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Converters\V1\ConverterFactory;
use App\Models\CustomFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProcessConvertFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public CustomFile $customFile,
        public string $outputFormat
    ) {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Start job for file: ' . $this->customFile->name);

        try {
            $pipes = ConverterFactory::createPipeline($this->customFile->extension, $this->outputFormat);

            $processedFile = Pipeline::send([Storage::path($this->customFile->path)])
                ->through($pipes)
                ->thenReturn();
        }
        catch (Throwable $e) {
            Log::error('Error Converting file: ' . $this->customFile->name . ' Error : ' . $e->getMessage());
        }

        Log::info('Successfully Converted file');
    }
}
