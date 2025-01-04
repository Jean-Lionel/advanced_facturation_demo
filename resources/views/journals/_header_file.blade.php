
<div>

    @if(env('APP_USE_ABONEMENT', false))
        @include('compte._header')

    <div class="row mb-2">
        <div class="col">
            <a href="{{ route('rapport_detail') }}" class="btn btn-link mr-2 {{ setActiveRoute('rapport_detail') }}"><span class="fas fa-file-invoice px-2"></span>Rapport Détail</a></div>
        <div class="col">
            <a href="{{ route('partage_interet') }}" class="btn btn-link mr-2 {{ setActiveRoute('partage_interet') }}"><span class="fas fa-solid fa-bezier-curve px-2"></span>Partage des Intérêt</a>
        </div>
        <div class="col">
            <a href="{{ route('rapport_revenue') }}" class="btn btn-link mr-2 {{ setActiveRoute('rapport_revenue') }}"><span class="fas fa-file-invoice px-2"></span>Rapport des revenue Journalière</a>
        </div>
    </div>

    @endif

</div>
