<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomFileRequest;
use App\Http\Resources\V1\CustomFileResource;
use App\Models\CustomFile;
use App\Utils\MyArr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CustomFileController extends Controller
{
    /**
     * Get all custom files.
     *
     * @return AnonymousResourceCollection<CustomFileResource>
     */
    public function index(): AnonymousResourceCollection
    {
        return CustomFileResource::collection(CustomFile::all());
    }

    public function show(CustomFile $customFile): CustomFileResource
    {
        return new CustomFileResource($customFile);
    }

    public function store(StoreCustomFileRequest $request): CustomFileResource
    {
        /** @var array $validated */
        $validated = $request->validated();
        $file = $request->file('file_input');
        $extension = $file->extension();

        $path = $file->storeAs(
            path: 'input',
            name: MyArr::has($validated, 'name') ? "{$validated['name']}.{$extension}" : $file->hashName()
        );

        $argForNewModelFile = [
            'name'      => MyArr::getString($validated, 'name'),
            'path'      => $path,
            'extension' => $extension,
            'mime_type' => $file->getMimeType(),
            'added_by'  => Str::uuid()->toString(),
            'size'      => $file->getSize(),
        ];

        $created = CustomFile::create($argForNewModelFile);

        // @status 201
        return new CustomFileResource($created);
    }

    public function update(Request $request, CustomFile $file): CustomFileResource
    {
        $file->update($request->all());

        return new CustomFileResource($file);
    }

    public function destroy(CustomFile $file): Response
    {
        $file->delete();

        return response()->noContent();
    }
}
