@php($flashes = ['success' => 'fa-check-circle', 'error' => 'fa-exclamation-circle', 'warning' => 'fa-exclamation-triangle', 'info' => 'fa-info-circle'])
@foreach($flashes as $type => $icon)
    @if(session($type))
        <div class="alert alert-{{ $type === 'error' ? 'danger' : $type }} alert-dismissible fade show d-flex align-items-center shadow-sm mt-3" role="alert">
            <i class="fas {{ $icon }} me-2"></i>
            <div>{{ session($type) }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif
@endforeach
