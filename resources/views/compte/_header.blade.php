@if (env('APP_USE_ABONEMENT', false))
<nav class="app-tabs noprint" aria-label="Commissionnaires">
    <a href="{{ route('commissionnaires') }}">
        <i class="fa fa-home"></i> Commissionnaire
    </a>
</nav>
@endif
