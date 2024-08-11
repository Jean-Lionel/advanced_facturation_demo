
<div>
    
    @if(env('APP_USE_ABONEMENT', false))

    <div class="row">
        <div class="col"> 
            <a href="{{ route('rapport_detail') }}" class="btn btn-link">Rapport Détail</a></div>
        <div class="col">
            <a href="{{ route('partage_interet') }}" class="btn btn-link">Partage des Intérêt</a>
        </div>
        <div class="col">
            <a href="{{ route('rapport_revenue') }}" class="btn btn-link">Rapport des revenue Journalière</a>
        </div>
    </div>

    @endif
    
</div>
