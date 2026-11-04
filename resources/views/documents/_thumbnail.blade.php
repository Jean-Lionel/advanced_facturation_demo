@if($document->document_file)
    <a href="{{ route('advanced.documents.show', $document) }}" class="d-inline-flex align-items-center justify-content-center border rounded bg-light overflow-hidden"
       style="width:56px;height:56px" title="Aperçu de {{ $document->document_file }}">
        @if($document->file_kind === 'image')
            <img src="{{ $document->file_url }}" loading="lazy" style="width:100%;height:100%;object-fit:cover" alt="">
        @elseif($document->file_kind === 'pdf')
            <canvas class="pdf-thumbnail" width="0" height="0" data-url="{{ $document->file_url }}" style="max-width:100%;max-height:100%"></canvas>
            <i class="fas {{ $document->file_icon }} fa-2x pdf-thumbnail-icon"></i>
        @else
            <i class="fas {{ $document->file_icon }} fa-2x"></i>
        @endif
    </a>
@elseif($document->transactionFile)
    <a href="{{ asset($document->transactionFile->file_url) }}" class="btn btn-sm btn-primary" target="_blank">
        <i class="fas fa-download"></i>
    </a>
@else
    <span class="text-muted">-</span>
@endif
