@extends('layouts.advanced')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Modifier Membre</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('advanced.members.update', $member) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Les mêmes champs que dans create.blade.php mais avec les valeurs pré-remplies -->
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" name="firstname" id="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname', $member->firstname) }}">
                            @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ... autres champs ... -->

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('advanced.members.index') }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
