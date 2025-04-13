<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DocumentStoreRequest;
use App\Http\Requests\Api\DocumentUpdateRequest;
use App\Http\Resources\Api\DocumentCollection;
use App\Http\Resources\Api\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\DocumentCollection
     */
    public function index(Request $request)
    {
        $documents = Document::all();

        return new DocumentCollection($documents);
    }

    /**
     * @param \App\Http\Requests\Api\DocumentStoreRequest $request
     * @return \App\Http\Resources\Api\DocumentResource
     */
    public function store(DocumentStoreRequest $request)
    {
        $document = Document::create($request->validated());

        return new DocumentResource($document);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \App\Http\Resources\Api\DocumentResource
     */
    public function show(Request $request, Document $document)
    {
        return new DocumentResource($document);
    }

    /**
     * @param \App\Http\Requests\Api\DocumentUpdateRequest $request
     * @param \App\Models\Document $document
     * @return \App\Http\Resources\Api\DocumentResource
     */
    public function update(DocumentUpdateRequest $request, Document $document)
    {
        $document->update($request->validated());

        return new DocumentResource($document);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Document $document)
    {
        $document->delete();

        return response()->noContent();
    }
}
