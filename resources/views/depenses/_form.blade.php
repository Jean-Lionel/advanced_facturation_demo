@csrf

<div class="row">

	<div class="col-md-12 d-flex justify-content-between align-items-center">
		<h5 class="text-left mb-0">Nouvelle dépense</h5>
		<a href="{{ route('depense-categories.index') }}" class="btn btn-link btn-sm">Gérer les catégories</a>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="name">ACTION</label>
			<input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name" value="{{ old('name', $depense->name ?? '') }}">
			{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="montant">MONTANT</label>
			<input type="number" step="0.01" class="form-control {{ $errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant" name="montant" value="{{ old('montant', $depense->montant ?? '') }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="depense_category_id">CATÉGORIE</label>
			@if ($depenseCategories->isEmpty())
				<div class="alert alert-warning py-2 mb-2">
					Aucune catégorie disponible.
					<a href="{{ route('depense-categories.create') }}">Créer une catégorie</a>
				</div>
			@endif
			<select name="depense_category_id" id="depense_category_id" class="form-control {{ $errors->has('depense_category_id') ? 'is-invalid' : 'is-valid' }}" {{ $depenseCategories->isEmpty() ? 'disabled' : '' }}>
				<option value="">-- Choisir une catégorie --</option>
				@foreach ($depenseCategories as $category)
					<option value="{{ $category->id }}"
						{{ (string) old('depense_category_id', $depense->depense_category_id ?? '') === (string) $category->id ? 'selected' : '' }}>
						{{ $category->name }}
					</option>
				@endforeach
			</select>
			{!! $errors->first('depense_category_id', '<small class="help-block invalid-feedback">:message</small>') !!}
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="date_depense">DATE DE LA DÉPENSE</label>
			<input type="date"
				   class="form-control {{ $errors->has('date_depense') ? 'is-invalid' : 'is-valid' }}"
				   id="date_depense"
				   name="date_depense"
				   value="{{ old('date_depense', isset($depense->date_depense) ? $depense->date_depense->format('Y-m-d') : now()->format('Y-m-d')) }}">
			{!! $errors->first('date_depense', '<small class="help-block invalid-feedback">:message</small>') !!}
		</div>
	</div>

	<div class="col-md-8">
		<div class="form-group">
			<label for="description">DESCRIPTION</label>
			<textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description', $depense->description ?? '') }}</textarea>
			{!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}
		</div>
	</div>

	<div class="col-md-3 offset-2">
		<div class="form-group">
			<label for=""></label>
			<a href="{{ route('depenses.index') }}" class="form-control btn btn-warning text-center">Annuler</a>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<label for=""></label>
			<input type="submit" value="{{ $btnMessage }}" class="form-control btn-primary">
		</div>
	</div>

</div>