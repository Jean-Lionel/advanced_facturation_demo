@extends('layouts.advanced')

@section('content')
<div class="container-fluid px-lg-4 mt-4">
    <div class="row justify-content-center">
        <div class="{{ $siblings->count() > 1 ? 'col-lg-9' : 'col-12' }}">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-0 me-auto">{{ $document->name }}</h4>
                    @if($siblings->count() > 1)
                        <div class="btn-group btn-group-sm">
                            <a href="{{ $previous ? route('advanced.documents.show', $previous) : '#' }}" id="previous-document"
                               class="btn btn-outline-secondary {{ $previous ? '' : 'disabled' }}" title="Document précédent (←)">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="btn btn-outline-secondary disabled">{{ $siblings->search(fn ($sibling) => $sibling->id === $document->id) + 1 }} / {{ $siblings->count() }}</span>
                            <a href="{{ $next ? route('advanced.documents.show', $next) : '#' }}" id="next-document"
                               class="btn btn-outline-secondary {{ $next ? '' : 'disabled' }}" title="Document suivant (→)">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Fichier:</strong>
                        <div class="mt-2">
                            @if($document->document_file)
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas {{ $document->file_icon }} fa-2x me-2"></i>
                                    <span class="me-auto text-break">{{ $document->document_file }}</span>
                                    <a href="{{ $document->file_url }}" class="btn btn-sm btn-outline-secondary me-2" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> Ouvrir
                                    </a>
                                    <a href="{{ $document->file_url }}" class="btn btn-sm btn-primary" download>
                                        <i class="fas fa-download"></i> Télécharger
                                    </a>
                                </div>

                                <div class="border rounded bg-light">
                                    @switch($document->file_kind)
                                        @case('image')
                                            <div class="text-center p-2">
                                                <img src="{{ $document->file_url }}" class="img-fluid" style="max-height:80vh" alt="{{ $document->name }}">
                                            </div>
                                            @break
                                        @case('pdf')
                                            <iframe src="{{ $document->file_url }}" width="100%" style="height:80vh" class="d-block border-0"></iframe>
                                            @break
                                        @case('word')
                                        @case('excel')
                                        @case('text')
                                            <div id="file-viewer" class="bg-white overflow-auto p-2" style="max-height:80vh"
                                                 data-url="{{ $document->file_url }}" data-kind="{{ $document->file_kind }}" data-extension="{{ $document->file_extension }}">
                                                <div class="text-center text-muted p-4"><i class="fas fa-spinner fa-spin"></i> Chargement de l'aperçu...</div>
                                            </div>
                                            @break
                                        @default
                                            <div class="text-center text-muted p-4">
                                                <i class="fas {{ $document->file_icon }} fa-4x mb-2"></i>
                                                <p class="mb-0">Aperçu non disponible pour ce type de fichier. Utilisez le bouton Télécharger.</p>
                                            </div>
                                    @endswitch
                                </div>
                            @elseif($document->transactionFile)
                                <a href="{{ asset($document->transactionFile->file_url) }}" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            @else
                                <p class="text-muted">Aucun fichier</p>
                            @endif
                        </div>
                    </div>

                    <div class="border-top pt-3 mb-3">
                        <div class="row g-3">
                            <div class="col-sm-6 col-lg-3">
                                <small class="text-muted d-block">Type de document</small>
                                <span>{{ $document->document_type ?: '-' }}</span>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <small class="text-muted d-block">Membre</small>
                                <span>{{ $document->member ? $document->member->firstname . ' ' . $document->member->last_name : '-' }}</span>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <small class="text-muted d-block">Client</small>
                                <span>{{ $document->client ? $document->client->name : '-' }}</span>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <small class="text-muted d-block">Date de création</small>
                                <span>{{ $document->created_at ? $document->created_at->format('d/m/Y H:i') : '-' }}</span>
                            </div>
                            <div class="col-12">
                                <small class="text-muted d-block">Description</small>
                                <p class="mb-0" style="white-space:pre-line">{{ $document->description ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Membres associés:</strong>
                        <ul class="list-group">
                            @foreach($document->members as $member)
                                <li class="list-group-item">
                                    {{ $member->firstname }} {{ $member->last_name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @if($siblings->count() > 1)
            <div class="col-lg-3 mt-3 mt-lg-0">
                <div class="card sticky-top" style="top:1rem">
                    <div class="card-header">
                        <strong>{{ $siblings->count() }} documents</strong>
                        <small class="d-block text-muted text-truncate" title="{{ $document->description }}">{{ $document->description }}</small>
                    </div>
                    <div class="list-group list-group-flush overflow-auto" style="max-height:calc(100vh - 8rem)">
                        @foreach($siblings as $sibling)
                            <a href="{{ route('advanced.documents.show', $sibling) }}"
                               class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ $sibling->id === $document->id ? 'active' : '' }}"
                               @if($sibling->id === $document->id) aria-current="true" id="current-document" @endif>
                                <span class="d-inline-flex align-items-center justify-content-center border rounded bg-light overflow-hidden flex-shrink-0" style="width:44px;height:44px">
                                    @if($sibling->file_kind === 'image')
                                        <img src="{{ $sibling->file_url }}" loading="lazy" style="width:100%;height:100%;object-fit:cover" alt="">
                                    @else
                                        <i class="fas {{ $sibling->file_icon }} fa-lg"></i>
                                    @endif
                                </span>
                                <span class="flex-grow-1" style="min-width:0">
                                    <span class="d-block text-truncate">{{ $sibling->name }}</span>
                                    <small class="d-block text-truncate {{ $sibling->id === $document->id ? '' : 'text-muted' }}">
                                        {{ $sibling->file_extension ? strtoupper($sibling->file_extension) . ' · ' : '' }}{{ $sibling->created_at ? $sibling->created_at->format('d/m/Y H:i') : '' }}
                                    </small>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/docx-preview@0.3.2/dist/docx-preview.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
    (function () {
        // keep the current document visible in the list without scrolling the page
        const current = document.getElementById('current-document');
        if (current) current.parentElement.scrollTop = current.offsetTop - current.parentElement.offsetTop - 60;

        // ← / → to move between documents of the list
        document.addEventListener('keydown', e => {
            if (['INPUT', 'TEXTAREA', 'SELECT'].includes(document.activeElement.tagName)) return;
            const link = document.getElementById(e.key === 'ArrowLeft' ? 'previous-document' : e.key === 'ArrowRight' ? 'next-document' : null);
            if (link && !link.classList.contains('disabled')) window.location = link.href;
        });
    })();

    (function () {
        const viewer = document.getElementById('file-viewer');
        if (!viewer) return;

        const { url, kind, extension } = viewer.dataset;

        function unavailable(message) {
            viewer.innerHTML = `<div class="text-center text-muted p-4"><i class="fas fa-eye-slash fa-3x mb-2"></i><p class="mb-0">${message}</p></div>`;
        }

        if (kind === 'word' && extension === 'doc') {
            unavailable("L'aperçu des anciens fichiers Word (.doc) n'est pas pris en charge. Utilisez le bouton Télécharger.");
            return;
        }

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error(response.status);
                return kind === 'text' ? response.text() : response.arrayBuffer();
            })
            .then(data => {
                viewer.innerHTML = '';
                if (kind === 'word') {
                    return docx.renderAsync(data, viewer, null, { inWrapper: true, ignoreWidth: false });
                }
                if (kind === 'excel') {
                    const workbook = XLSX.read(data, { type: 'array' });
                    const tabs = document.createElement('ul');
                    tabs.className = 'nav nav-tabs mb-2';
                    const content = document.createElement('div');
                    content.className = 'table-responsive';
                    workbook.SheetNames.forEach((sheetName, index) => {
                        const tab = document.createElement('li');
                        tab.className = 'nav-item';
                        tab.innerHTML = `<button type="button" class="nav-link ${index === 0 ? 'active' : ''}"></button>`;
                        tab.firstChild.textContent = sheetName;
                        tab.firstChild.addEventListener('click', () => {
                            tabs.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                            tab.firstChild.classList.add('active');
                            showSheet(sheetName);
                        });
                        tabs.appendChild(tab);
                    });
                    function showSheet(sheetName) {
                        content.innerHTML = XLSX.utils.sheet_to_html(workbook.Sheets[sheetName]);
                        content.querySelector('table')?.classList.add('table', 'table-sm', 'table-bordered', 'bg-white');
                    }
                    if (workbook.SheetNames.length > 1) viewer.appendChild(tabs);
                    viewer.appendChild(content);
                    showSheet(workbook.SheetNames[0]);
                    return;
                }
                const pre = document.createElement('pre');
                pre.className = 'mb-0';
                pre.style.whiteSpace = 'pre-wrap';
                pre.textContent = data;
                viewer.appendChild(pre);
            })
            .catch(() => unavailable("Impossible d'afficher l'aperçu de ce fichier. Utilisez le bouton Télécharger."));
    })();
</script>
@endpush
