@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Modifier le type de versement</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('versementType.update', $versementType) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                Nom <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ old('name', $versementType->name) }}"
                                       required
                                       autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-3 form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-end">
                                Description
                            </label>
                            <div class="col-md-6">
                                <textarea id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          name="description"
                                          rows="3">{{ old('description', $versementType->description) }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-0 form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Mettre à jour
                                </button>
                                <a href="{{ route('versementType.show', $versementType) }}" class="btn btn-link">
                                    Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
