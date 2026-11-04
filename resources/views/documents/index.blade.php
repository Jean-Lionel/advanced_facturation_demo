@extends('layouts.advanced')

@section('content')
<div class="container-fluid px-lg-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Documents</h1>
        <a href="{{ route('advanced.documents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Document
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('advanced.documents.index') }}" method="GET" class="row align-items-end">
                <div class="col-md-3 mb-2">
                    <label for="search" class="form-label">Recherche</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nom ou description...">
                </div>
                <div class="col-md-2 mb-2">
                    <label for="date_start" class="form-label">Date Début</label>
                    <input type="date" class="form-control" id="date_start" name="date_start" value="{{ request('date_start') }}">
                </div>
                <div class="col-md-2 mb-2">
                    <label for="date_end" class="form-label">Date Fin</label>
                    <input type="date" class="form-control" id="date_end" name="date_end" value="{{ request('date_end') }}">
                </div>
                <div class="col-md-2 mb-2">
                    <label for="category" class="form-label">Catégorie</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Toutes</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filtrer
                    </button>
                    <a href="{{ route('advanced.documents.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Aperçu</th>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Membre</th>
                            <th>Client</th>
                            <th>Description</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                            @php($items = $documents->get($group->group_key, collect()))
                            @if($items->count() > 1)
                                @php($first = $items->first())
                                <tr class="table-light group-toggle" role="button" data-bs-toggle="collapse" data-bs-target=".group-{{ $loop->index }}" aria-expanded="false">
                                    <td>
                                        <div class="d-flex">
                                            @foreach($items->take(3) as $item)
                                                <div style="margin-left:{{ $loop->first ? 0 : -28 }}px">@include('documents._thumbnail', ['document' => $item])</div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-chevron-right group-chevron me-1"></i>
                                        <strong>{{ $items->count() }} documents</strong>
                                        <small class="d-block text-muted">Même description · cliquez pour afficher</small>
                                    </td>
                                    <td>{{ $items->pluck('document_type')->unique()->count() > 1 ? 'Plusieurs' : $first->document_type }}</td>
                                    <td>
                                        @if($items->pluck('member_id')->unique()->count() > 1)
                                            Plusieurs
                                        @else
                                            {{ $first->member ? $first->member->firstname . ' ' . $first->member->last_name : '-' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($items->pluck('client_id')->unique()->count() > 1)
                                            Plusieurs
                                        @else
                                            {{ $first->client ? $first->client->name : '-' }}
                                        @endif
                                    </td>
                                    <td><strong>{{ $first->description }}</strong></td>
                                    <td>{{ $first->created_at ? $first->created_at->format('d/m/Y H:i') : '-' }}</td>
                                    <td><span class="badge bg-secondary">{{ $items->count() }} fichiers</span></td>
                                </tr>
                                @foreach($items as $document)
                                    @include('documents._row', ['document' => $document, 'rowClass' => 'collapse group-' . $loop->parent->index . ' group-item'])
                                @endforeach
                            @else
                                @foreach($items as $document)
                                    @include('documents._row', ['document' => $document])
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $groups->links() }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .group-item > td:first-child { padding-left: 2rem; }
    .group-item { border-left: 3px solid var(--bs-primary); }
    .group-chevron { transition: transform .2s; }
    .group-toggle[aria-expanded="true"] .group-chevron { transform: rotate(90deg); }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script>
    (function () {
        const canvases = document.querySelectorAll('canvas.pdf-thumbnail');
        if (!canvases.length || !window.pdfjsLib) return;
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.worker.min.js';

        // render the first page of each PDF only when it becomes visible
        function renderThumbnail(canvas) {
            pdfjsLib.getDocument(canvas.dataset.url).promise
                .then(pdf => pdf.getPage(1))
                .then(page => {
                    const viewport = page.getViewport({ scale: 1 });
                    const scaled = page.getViewport({ scale: 112 / Math.max(viewport.width, viewport.height) });
                    canvas.width = scaled.width;
                    canvas.height = scaled.height;
                    return page.render({ canvasContext: canvas.getContext('2d'), viewport: scaled }).promise;
                })
                .then(() => canvas.nextElementSibling?.remove())
                .catch(() => canvas.remove());
        }

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                observer.unobserve(entry.target);
                renderThumbnail(entry.target);
            });
        });
        canvases.forEach(canvas => observer.observe(canvas));
    })();
</script>
@endpush
