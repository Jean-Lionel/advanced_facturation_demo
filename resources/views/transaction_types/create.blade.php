@extends('layouts.advanced')

@section('content')
<div class="container-fluid px-lg-4 mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Nouveau Type de Transaction</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('advanced.transaction_types.store') }}" method="POST">
                        @csrf

                        <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('advanced.transaction_types.index') }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection