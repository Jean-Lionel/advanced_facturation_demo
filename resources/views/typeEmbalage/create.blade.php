@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Ajouter un Type d\'Emballage') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('typeEmbalage.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                {{ __('Nom') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                {{ __('Description') }}
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                     id="description" name="description" rows="3">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('typeEmbalage.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> {{ __('Retour') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> {{ __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
