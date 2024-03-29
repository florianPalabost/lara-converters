<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\V1;

use App\Models\CustomFile;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

const FILES_ROUTE = '/api/v1/files';

describe('V1 > CustomFileController', function () {
    it('can retrieve custom files', function () {
        CustomFile::factory()->create(3);

        $response = $this->getJson(FILES_ROUTE);

        expect($response->json('data'))->toHaveCount(3);
    });

    it('can retrieve a single custom file', function () {
        $customFile = CustomFile::factory()->create();

        $response = $this->getJson(FILES_ROUTE . "/{$customFile->id}");

        expect($response->json('data'))->toEqual([
            'id'        => $customFile->id,
            'name'      => $customFile->name,
            'path'      => $customFile->path,
            'extension' => $customFile->extension,
            'mime_type' => $customFile->mime_type,
            'added_by'  => $customFile->added_by,
            'size'      => $customFile->size,
        ]);
    });

    it('can store a new custom file', function () {
        $newFileData = [
            'name'      => 'test',
            'path'      => 'test',
            'extension' => 'test',
            'mime_type' => 'test',
            'added_by'  => 'test',
            'size'      => 145,
        ];

        $response = $this->postJson(FILES_ROUTE, $newFileData);

        expect($response->json('data'))->toEqual($newFileData)
            ->and($response->getStatus())->toBe(201);
    });

    it('can update an existing custom file', function (string $property, string $value) {
        $customFile = CustomFile::factory()->create();

        $updateData = [
            $property => $value,
        ];

        $response = $this->putJson(FILES_ROUTE . "/{$customFile->id}", $updateData);

        expect($response->json("data.{$property}"))->toEqual($value);
    })->with([
        'name'     => ['name', 'test'],
        'added_by' => ['added_by', Str::uuid()->toString()],
    ]);

    it('can delete an existing custom file', function () {
        $customFile = CustomFile::factory()->create();

        $response = $this->deleteJson(FILES_ROUTE . "/{$customFile->id}");

        expect($response->getStatus())->toBe(Response::HTTP_NO_CONTENT);
    });
});
