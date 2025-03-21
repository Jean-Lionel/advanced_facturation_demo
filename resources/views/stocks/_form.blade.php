@csrf

<div class="row">

	<div class="card">
		<div class="card-body">

			<div class="col-md-12">
				<h5 class="text-left">Nouveau stock</h5>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="name">Nom</label>
					<input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name" value="{{ old('name') ?? $stocke->name?? ' ' }}">

					{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}

				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="description">Description</label>


					<textarea class="form-control"  row="15" {{$errors->has('description') ? 'is-invalid' : 'is-valid'}} name="description">{{ old('description') ?? $stocke->description?? ' ' }}
					</textarea>

					{!! $errors->first('description', '<small class="help-block invalid-feedback">:message</small>') !!}

				</div>
			</div>

			<div class="col-md-12">
				<input type="submit" value="{{ $btnMessage ?? 'Enregitrer' }}" class="form-control btn-primary">
			</div>

		</div>
	</div>


</div>

