

<div class="text-right">
	<div>
        <a href="{{ route('facture.credit') }}" class="{{ setActiveRoute('journal_sort_history') }}">
			<span class="fa fa-file-archive"></span>
			<span>Facture à Crédit </span>
		</a>

		<a class="mx-4"  href="{{ route('journal_sort_history') }}" class="{{ setActiveRoute('journal_sort_history') }}">
			<span class="fa fa-file-archive"></span>
			<span>Historique de Facture </span>
		</a>

	</div>
	<button class="btn btn-info noprint" onclick="window.print()" >
		<i class="fa fa-print" aria-hidden="true"></i>
		Imprimer
	</button>
</div>

<h5 class="text-center">Historique des ventes</h5>
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
