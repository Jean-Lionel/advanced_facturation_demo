@extends('layouts.app')

@section('content')

<div >
	<div class="card">
		<div class="text-center card-title">{{ $product->name }}</div>

		<div class="card-body">
			<form action="{{ route('add_quantite_stock') }}" method="post">

				@csrf
				@method('POST')

				<input type="hidden" name="product_id"  value="{{ $product->id }}">

				<!-- Large input -->
				<div class="row">
					<div class="col-md-3">

                        <div class="form-group">
                            <label for="mouvement">Mouvement</label>
                            <select name="" id="" class=" form-control form-control-sm">
                                <option value=""></option>
                                @foreach ($mouvements as $key => $value)
                                 <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
					</div>
					<div class="col-md-3">
                        <label for="quantite">Montant</label>
						<input required="" name="quantite" class="form-control form-control-sm" type="number" value="{{ old('quantite') }}"  placeholder="Exemple : 4">
						{!! $errors->first('quantite', '<small class="help-block invalid-feedback">:message</small>') !!}
					</div>
					<div class="col-md-3">
                        <label for="quantite">QUANTITE</label>
						<input required="" name="quantite" class="form-control form-control-sm" type="number" value="{{ old('quantite') }}"  placeholder="Exemple : 4">
						{!! $errors->first('quantite', '<small class="help-block invalid-feedback">:message</small>') !!}
					</div>
					<div class="pt-3 col-md-3 d-flex ">
                        <div class="pt-3 form-group">
                            <label for=""></label>
                            	<input type="submit" value="Ajouter" class="btn-sm btn-info">
                                <a href="{{ route('products.index') }}" class="ml-3 btn-sm btn-dark">retour</a>
                        </div>

					</div>

				</div>

			</form>
		</div>
	</div>
</div>


@stop
