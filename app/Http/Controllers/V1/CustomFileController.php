<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomFileRequest;
use App\Http\Resources\CustomFileResource;
use App\Models\CustomFile;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Request;
use Symfony\Component\HttpFoundation\Response;

class CustomFileController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }

    /**
     * Get all custom files.
     *
     * @return AnonymousResourceCollection<<CustomFileResource>
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
        $customFile = CustomFile::create($request->validated());

        // @status 201
        return new CustomFileResource($customFile);
    }

    public function update(Request $request, CustomFile $customFile): CustomFileResource
    {
        $customFile->update($request->all());

        return new CustomFileResource($customFile);
    }

    public function destroy(CustomFile $customFile): Response
    {
        $customFile->delete();

        return response()->noContent();
    }
}
