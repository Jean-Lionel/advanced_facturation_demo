<div class="text-right">
	<a href="{{ route('entreprises.index') }}" class="btn btn-link {{ setActiveRoute('entreprises.*') }}">
        <span class="fa fa-comments-dollar"></span>

        Entreprise</a>
	{{--  <a href="{{ route('obr_declarations.index') }} " class="btn btn-link {{ setActiveRoute('obr_declarations.*') }}">
        <span class="fa fa-file-invoice"></span>
        Déclaration Obr</a>
	<a href="{{ route('obr_declarations_hostory') }}" class="btn btn-link {{ setActiveRoute('obr_declarations_hostory') }}">
        <span class="fa fa-history"></span>
        Historique de déclaration Obr</a>

	<a href="{{ route('obr_log') }}" class="btn btn-link {{ setActiveRoute('obr_log') }}">
        <span class="fa fa-quidditch"></span>
        Reponses de l'OBR </a>  --}}
	<a href="{{ route('backup_database') }}" class="btn btn-link">
        <span class="fas fa-archive"></span>
        Backup </a>
{{--	<a href="{{ route('obr_declarations_cancel') }}" class="btn btn-link">--}}
{{--		Facture Annulé--}}
{{--	</a>--}}
</div>
