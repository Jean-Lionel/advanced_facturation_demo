<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DocumentStoreRequest;
use App\Http\Requests\Api\DocumentUpdateRequest;
use App\Http\Resources\Api\DocumentCollection;
use App\Http\Resources\Api\DocumentResource;
use App\Models\Client;
use App\Models\Document;
use App\Models\Member;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\DocumentCollection
     */
    public function index(Request $request)
    {
        $documents = Document::latest()->paginate();
        if ($request->wantsJson()) {
            return new DocumentCollection($documents);
        }
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $members = Member::orderBy('firstname')->get();
        $clients = Client::orderBy('name')->get();
        return view('documents.create', compact('members', 'clients'));
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
        if ($request->wantsJson()) {
            return new DocumentResource($document);
        }
        return view('documents.show', compact('document'));
    }

    /**
     * @param \App\Http\Requests\Api\DocumentUpdateRequest $request
     * @param \App\Models\Document $document
     * @return \App\Http\Resources\Api\DocumentResource
     */
    public function update(DocumentUpdateRequest $request, Document $document)
    {
        $document->update($request->validated());
        if ($request->wantsJson()) {
            return new DocumentResource($document);
        }
        return view('documents.show', compact('document'));
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
