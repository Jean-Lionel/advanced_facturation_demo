

<div class="text-right">
	<div class="">

        <a href="{{ route('rapport_boutique') }}" class="mx-4 {{ setActiveRoute('rapport_boutique') }}">
            <span class="fa fa-box"></span>
            <span>Rapport Boutique </span>
        </a>
        <a href="{{ route('stocks.controls') }}" class="mx-4 {{ setActiveRoute('stocks.controls') }}">
            <span class="fa fa-box"></span>
            <span>Control des stocks </span>
        </a>

        <a class="mx-4" href="{{ route('facture.credit') }}" class="{{ setActiveRoute('facture.credit') }}">
			<span class="fa fa-file"></span>
			<span>Facture à Crédit </span>
		</a>
        <a class="mx-4" href="{{ route('impression_multiple') }}" class="{{ setActiveRoute('impression_multiple') }}">
			<span class="fa fa-file"></span>
			<span>Impression Multiple des factures </span>
		</a>

		<a class="mx-4"  href="{{ route('journal_sort_history') }}" class="{{ setActiveRoute('journal_sort_history') }}"    >
			<span class="fa fa-file-archive"></span>
			<span>Historique de Facture </span>
		</a>
		<a class="mx-4"  href="{{ route('proformats.index') }}" class="{{ setActiveRoute('proformats') }}">
			<span class="fa fa-briefcase"></span>
			<span>Proformat </span>
		</a>
        <a class="mx-4"  href="{{ route('facture.search') }}" class="{{ setActiveRoute('facture.search') }}">
			<span class="fa fa-search"></span>
			<span>Recherche les factures </span>
		</a>

	</div>
    <div class="noprint">
        <button class="btn btn-info noprint" onclick="window.print()" >
		<i class="fa fa-print" aria-hidden="true"></i>
		Imprimer
	</button>
    </div>
</div>
<div>
	{{-- <form action="" class="form-group row">
		<div class="col-sm-6">
			<label for="">TYPE DE PAIMENENT</label>
		</div>
		<div class="col-sm-6">
			<a class="btn btn-secondary" href="{{ route('paimenet_dette') }}"> Paiment des dettes</a>
		</div>
		<div class="col-sm-6">
			<a class="btn btn-secondary" href="{{ route('canceledInvoince') }}"> Facture Annuler avant la Déclaration</a>
		</div>


	</form> --}}
</div>
