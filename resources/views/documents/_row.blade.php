<tr class="{{ $rowClass ?? '' }}">
    <td>@include('documents._thumbnail', ['document' => $document])</td>
    <td>
        {{ $document->name }}
        @if($document->document_file)
            <small class="d-block text-muted text-break">{{ $document->document_file }}</small>
        @endif
    </td>
    <td>{{ $document->document_type }}</td>
    <td>{{ $document->member ? $document->member->firstname . ' ' . $document->member->last_name : '-' }}</td>
    <td>{{ $document->client ? $document->client->name : '-' }}</td>
    <td>{{ $document->description }}</td>
    <td>{{ $document->created_at ? $document->created_at->format('d/m/Y H:i') : '-' }}</td>
    <td>
        <div class="btn-group">
            <a href="{{ route('advanced.documents.show', $document) }}" class="btn btn-sm btn-info" title="Aperçu">
                <i class="fas fa-eye"></i>
            </a>
            @if($document->document_file)
                <a href="{{ $document->file_url }}" class="btn btn-sm btn-primary" download title="Télécharger">
                    <i class="fas fa-download"></i>
                </a>
            @endif
            <a href="{{ route('advanced.documents.edit', $document) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('advanced.documents.destroy', $document) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
