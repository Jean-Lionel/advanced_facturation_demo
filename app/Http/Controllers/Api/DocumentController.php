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
use App\Models\TransactionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\DocumentCollection
     */
    public function index(Request $request)
    {
        $query = Document::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_start')) {
            $query->whereDate('created_at', '>=', $request->input('date_start'));
        }

        if ($request->filled('date_end')) {
            $query->whereDate('created_at', '<=', $request->input('date_end'));
        }

        if ($request->has('category') && $request->filled('category')) {
            $query->where('document_type', $request->input('category'));
        }

        if ($request->wantsJson()) {
            return $query->latest()->paginate()->withQueryString();
        }

        // documents with the same description are shown together: paginate on groups, not on documents
        $groupKey = "CASE WHEN TRIM(COALESCE(description, '')) = '' THEN CONCAT('doc-', id) ELSE CONCAT('desc:', LOWER(TRIM(description))) END";
        $groups = (clone $query)
            ->selectRaw("{$groupKey} as group_key, MAX(created_at) as last_created_at")
            ->groupBy('group_key')
            ->orderByDesc('last_created_at')
            ->paginate(15)
            ->withQueryString();

        $documents = (clone $query)
            ->select('documents.*')
            ->selectRaw("{$groupKey} as group_key")
            ->with(['member', 'client', 'transactionFile'])
            ->whereIn(DB::raw($groupKey), $groups->pluck('group_key'))
            ->latest()
            ->get()
            ->groupBy('group_key');

        $categories = Document::select('document_type')->distinct()->whereNotNull('document_type')->pluck('document_type');

        return view('documents.index', compact('groups', 'documents', 'categories'));
    }

    public function create()
    {
        $members = Member::orderBy('firstname')->get();
        $clients = Client::orderBy('name')->get();
        return view('documents.create', compact('members', 'clients'));
    }

    public function edit(Document $document)
    {
        $members = Member::orderBy('firstname')->get();
        $clients = Client::orderBy('name')->get();
        return view('documents.edit', compact('document', 'members', 'clients'));
    }
    /**
     * @param \App\Http\Requests\Api\DocumentStoreRequest $request
     * @return \App\Http\Resources\Api\DocumentResource
     */
    public function store(DocumentStoreRequest $request)
    {

        $data = [
            ...$request->except(['file', 'files', 'names']),
            'user_id' => auth()->user()->id,
        ];

        //multiple files: one document per file
        if ($request->hasFile('files')) {
            $names = $request->input('names', []);
            foreach ($request->file('files') as $index => $file) {
                $document = Document::create([
                    ...$data,
                    'name' => $names[$index] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                ]);
                $document->document_file = $this->storeFile($file);
                $document->save();
            }

            return redirect()->route('advanced.documents.index')->with('success', count($request->file('files')) . ' document(s) ajouté(s) avec succès');
        }

        $document = Document::create($data);
        //file
        if ($request->hasFile('file')) {
            $document->document_file = $this->storeFile($request->file('file'));
            $document->save();
        }

        return redirect()->route('advanced.documents.index')->with('success', 'Document ajouté avec succès');
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    private function storeFile($file)
    {
        $file_name = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $pathFile = $file->move('documents', $file_name);

        return $pathFile->getBasename();
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

        // other documents with the same description, listed on the right for navigation
        $siblings = collect();
        if (trim((string) $document->description) !== '') {
            $siblings = Document::whereRaw('LOWER(TRIM(description)) = LOWER(TRIM(?))', [$document->description])
                ->latest()
                ->orderByDesc('id')
                ->get();
        }

        $position = $siblings->search(fn ($sibling) => $sibling->id === $document->id);
        $previous = $position !== false ? $siblings->get($position - 1) : null;
        $next = $position !== false ? $siblings->get($position + 1) : null;

        return view('documents.show', compact('document', 'siblings', 'previous', 'next'));
    }

    /**
     * @param \App\Http\Requests\Api\DocumentUpdateRequest $request
     * @param \App\Models\Document $document
     * @return \App\Http\Resources\Api\DocumentResource
     */
    public function update(DocumentUpdateRequest $request, Document $document)
    {
        $document->update($request->safe()->except('file'));

        if ($request->hasFile('file')) {
            $document->document_file = $this->storeFile($request->file('file'));
            $document->save();
        }

        if ($request->wantsJson()) {
            return new DocumentResource($document);
        }

        return redirect()->route('advanced.documents.show', $document)->with('success', 'Document mis à jour avec succès');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Document $document)
    {
        $document->delete();

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('advanced.documents.index')->with('success', 'Document supprimé avec succès');
    }
}
