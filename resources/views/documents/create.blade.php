@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Nouveau Document</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('advanced.documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="document_type" class="form-label">Type de document</label>
                            <select name="document_type" id="document_type" class="form-control @error('document_type') is-invalid @enderror">
                                @foreach(TYPE_DOCUMENTS as $key => $value)
                                    <option value="{{ $key }}" {{ old('document_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('document_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="member_id" class="form-label">Membre</label>
                            <select name="member_id" id="member_id" class="form-control @error('member_id') is-invalid @enderror">
                                <option value="">Sélectionnez un membre</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->firstname }} {{ $member->last_name }} - {{ $member->organisation->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror">
                                <option value="">Sélectionnez un client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fichiers <span class="badge bg-primary-subtle text-primary ms-1"><i class="fas fa-layer-group"></i> Plusieurs fichiers possibles</span></label>
                            <label for="files" id="dropzone" class="dropzone d-block text-center rounded-3 p-4 @error('files') is-invalid @enderror @error('files.*') is-invalid @enderror">
                                <input type="file" name="files[]" id="files" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.txt,.jpg,.jpeg,.png,.gif,.webp" class="dropzone-input" required>
                                <div class="dropzone-full">
                                    <div class="dropzone-icons mb-2">
                                        <i class="fas fa-file-pdf text-danger"></i>
                                        <i class="fas fa-file-word text-primary"></i>
                                        <i class="fas fa-cloud-upload-alt text-primary dropzone-main-icon"></i>
                                        <i class="fas fa-file-excel text-success"></i>
                                        <i class="fas fa-file-image text-warning"></i>
                                    </div>
                                    <h5 class="mb-1">Glissez-déposez vos fichiers ici</h5>
                                    <p class="text-muted mb-3">ou</p>
                                    <span class="btn btn-primary"><i class="fas fa-folder-open me-1"></i> Parcourir les fichiers</span>
                                    <p class="small text-muted mt-3 mb-0">
                                        Sélectionnez <strong>un ou plusieurs fichiers</strong> en même temps (Ctrl / Maj + clic) : un document sera créé par fichier.<br>
                                        PDF, Word, Excel, CSV, TXT, JPG, PNG, GIF, WEBP — {{ ini_get('upload_max_filesize') }} max. par fichier
                                    </p>
                                </div>
                                <div class="dropzone-compact">
                                    <i class="fas fa-plus-circle text-primary me-1"></i>
                                    <strong>Ajouter d'autres fichiers</strong>
                                    <span class="text-muted">— glissez-les ici ou cliquez pour parcourir</span>
                                </div>
                                <div class="dropzone-over">
                                    <i class="fas fa-file-download fa-2x text-primary mb-2"></i>
                                    <h5 class="mb-0 text-primary">Déposez les fichiers pour les ajouter</h5>
                                </div>
                            </label>
                            @error('files')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('files.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div id="files-rejected" class="alert alert-warning py-2 mt-2 mb-0 d-none small"></div>
                        </div>

                        <div id="files-toolbar" class="d-none justify-content-between align-items-center mb-2">
                            <strong id="files-count"></strong>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-secondary" data-view="grid" title="Vue grille"><i class="fas fa-th-large"></i></button>
                                <button type="button" class="btn btn-outline-secondary" data-view="list" title="Vue liste"><i class="fas fa-list"></i></button>
                            </div>
                        </div>

                        <div id="files-preview" class="mb-3"></div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('advanced.documents.index') }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" id="submit-btn" class="btn btn-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .dropzone { position: relative; border: 2px dashed #adb5bd; background: #f8f9fa; cursor: pointer; transition: border-color .15s, background-color .15s; }
    .dropzone:hover { border-color: var(--bs-primary); background: #f1f6ff; }
    .dropzone.is-invalid { border-color: var(--bs-danger); }
    .dropzone-input { position: absolute; width: 1px; height: 1px; opacity: 0; bottom: 0; left: 50%; }
    .dropzone-icons i { font-size: 1.75rem; margin: 0 .35rem; opacity: .8; vertical-align: middle; }
    .dropzone-icons .dropzone-main-icon { font-size: 3rem; opacity: 1; }
    .dropzone-compact, .dropzone-over { display: none; }
    .dropzone.has-files { padding: .9rem !important; }
    .dropzone.has-files .dropzone-full { display: none; }
    .dropzone.has-files .dropzone-compact { display: block; }
    .dropzone.is-dragover { border-color: var(--bs-primary); border-style: solid; background: #e7f0ff; }
    .dropzone.is-dragover .dropzone-full, .dropzone.is-dragover .dropzone-compact { display: none; }
    .dropzone.is-dragover .dropzone-over { display: block; padding: 1.5rem 0; }
</style>
@endpush

@push('scripts')
<script>
    (function () {
        const input = document.getElementById('files');
        const preview = document.getElementById('files-preview');
        const submitBtn = document.getElementById('submit-btn');
        let selected = [];

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatSize(bytes) {
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' Ko';
            return (bytes / (1024 * 1024)).toFixed(1) + ' Mo';
        }

        function syncInput() {
            const transfer = new DataTransfer();
            selected.forEach(item => transfer.items.add(item.file));
            input.files = transfer.files;
        }

        // beyond this number of files the preview switches to a compact list
        const LIST_THRESHOLD = 4;
        const toolbar = document.getElementById('files-toolbar');
        const count = document.getElementById('files-count');
        let chosenView = null;

        function fileIcon(file) {
            const extension = file.name.split('.').pop().toLowerCase();
            if (file.type.startsWith('image/')) return 'fa-file-image text-success';
            if (extension === 'pdf') return 'fa-file-pdf text-danger';
            if (['doc', 'docx'].includes(extension)) return 'fa-file-word text-primary';
            if (['xls', 'xlsx', 'csv'].includes(extension)) return 'fa-file-excel text-success';
            if (extension === 'txt') return 'fa-file-alt text-secondary';
            return 'fa-file text-muted';
        }

        function actions(item, index) {
            return `<div class="text-nowrap">
                        <a href="${item.url}" target="_blank" class="btn btn-sm btn-outline-info" title="Ouvrir"><i class="fas fa-eye"></i></a>
                        <button type="button" class="btn btn-sm btn-outline-danger" data-remove="${index}" title="Retirer"><i class="fas fa-times"></i></button>
                    </div>`;
        }

        function nameInput(item, extraClass) {
            return `<input type="text" name="names[]" class="form-control form-control-sm ${extraClass}" value="${escapeHtml(item.name)}" placeholder="Nom du document" required>`;
        }

        function gridItem(item, index) {
            const file = item.file;
            let media;
            if (file.type.startsWith('image/')) {
                media = `<img src="${item.url}" class="card-img-top" style="height:180px;object-fit:cover" alt="">`;
            } else if (file.type === 'application/pdf') {
                media = `<embed src="${item.url}#toolbar=0" type="application/pdf" style="width:100%;height:180px">`;
            } else {
                media = `<div class="d-flex align-items-center justify-content-center bg-light" style="height:180px"><i class="fas ${fileIcon(file)} fa-4x"></i></div>`;
            }

            const col = document.createElement('div');
            col.className = 'col-md-6';
            col.innerHTML = `
                <div class="card h-100">
                    ${media}
                    <div class="card-body p-2">
                        ${nameInput(item, 'mb-1')}
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted text-truncate me-2" title="${escapeHtml(file.name)}">${escapeHtml(file.name)} (${formatSize(file.size)})</small>
                            ${actions(item, index)}
                        </div>
                    </div>
                </div>`;
            return col;
        }

        function listItem(item, index) {
            const file = item.file;
            const thumb = file.type.startsWith('image/')
                ? `<img src="${item.url}" class="rounded" style="width:40px;height:40px;object-fit:cover" alt="">`
                : `<div class="d-flex align-items-center justify-content-center" style="width:40px;height:40px"><i class="fas ${fileIcon(file)} fa-2x"></i></div>`;

            const row = document.createElement('li');
            row.className = 'list-group-item d-flex align-items-center gap-2 py-2';
            row.innerHTML = `
                <span class="text-muted small" style="width:1.5rem">${index + 1}</span>
                ${thumb}
                <div class="flex-grow-1" style="min-width:0">
                    ${nameInput(item, '')}
                    <small class="text-muted text-truncate d-block" title="${escapeHtml(file.name)}">${escapeHtml(file.name)} (${formatSize(file.size)})</small>
                </div>
                ${actions(item, index)}`;
            return row;
        }

        function render() {
            const view = chosenView || (selected.length > LIST_THRESHOLD ? 'list' : 'grid');

            preview.innerHTML = '';
            preview.className = view === 'list' ? 'list-group mb-3 overflow-auto' : 'row g-3 mb-3';
            preview.style.maxHeight = view === 'list' ? '450px' : '';

            selected.forEach((item, index) => {
                const element = view === 'list' ? listItem(item, index) : gridItem(item, index);
                element.querySelector('input[name="names[]"]').addEventListener('input', e => item.name = e.target.value);
                preview.appendChild(element);
            });

            dropzone.classList.toggle('has-files', selected.length > 0);
            toolbar.classList.toggle('d-none', selected.length === 0);
            toolbar.classList.toggle('d-flex', selected.length > 0);
            count.textContent = `${selected.length} fichier(s) sélectionné(s)`;
            toolbar.querySelectorAll('[data-view]').forEach(btn => btn.classList.toggle('active', btn.dataset.view === view));

            submitBtn.textContent = selected.length > 1 ? `Créer ${selected.length} documents` : 'Créer';
        }

        toolbar.addEventListener('click', e => {
            const btn = e.target.closest('[data-view]');
            if (!btn) return;
            chosenView = btn.dataset.view;
            render();
        });

        const dropzone = document.getElementById('dropzone');
        const rejected = document.getElementById('files-rejected');
        const accepted = input.accept.split(',');
        const maxSize = {{ \Illuminate\Http\UploadedFile::getMaxFilesize() }};

        function addFiles(files) {
            const refused = [];
            Array.from(files).forEach(file => {
                const extension = '.' + file.name.split('.').pop().toLowerCase();
                if (!accepted.includes(extension)) {
                    refused.push(`${escapeHtml(file.name)} (format non accepté)`);
                    return;
                }
                if (file.size > maxSize) {
                    refused.push(`${escapeHtml(file.name)} (trop volumineux : ${formatSize(file.size)})`);
                    return;
                }
                const exists = selected.some(item => item.file.name === file.name && item.file.size === file.size);
                if (!exists) {
                    selected.push({ file, url: URL.createObjectURL(file), name: file.name.replace(/\.[^.]+$/, '') });
                }
            });

            rejected.classList.toggle('d-none', refused.length === 0);
            rejected.innerHTML = refused.length
                ? `<i class="fas fa-exclamation-triangle me-1"></i> Fichier(s) ignoré(s) : ${refused.join(', ')}`
                : '';

            syncInput();
            render();
        }

        // add newly picked files to the ones already selected
        input.addEventListener('change', () => addFiles(input.files));

        // drag & drop
        let dragDepth = 0;
        dropzone.addEventListener('dragenter', e => {
            e.preventDefault();
            dragDepth++;
            dropzone.classList.add('is-dragover');
        });
        dropzone.addEventListener('dragover', e => e.preventDefault());
        dropzone.addEventListener('dragleave', () => {
            if (--dragDepth <= 0) {
                dragDepth = 0;
                dropzone.classList.remove('is-dragover');
            }
        });
        dropzone.addEventListener('drop', e => {
            e.preventDefault();
            dragDepth = 0;
            dropzone.classList.remove('is-dragover');
            addFiles(e.dataTransfer.files);
        });

        // a file dropped next to the zone must not open it in the browser
        ['dragover', 'drop'].forEach(type => window.addEventListener(type, e => e.preventDefault()));

        preview.addEventListener('click', e => {
            const btn = e.target.closest('[data-remove]');
            if (!btn) return;
            const [removed] = selected.splice(Number(btn.dataset.remove), 1);
            URL.revokeObjectURL(removed.url);
            syncInput();
            render();
        });
    })();
</script>
@endpush