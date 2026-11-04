@extends('layouts.advanced')

@section('content')
<div class="container-fluid px-lg-4 mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Modifier Membre</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('advanced.members.update', $member) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" name="firstname" id="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname', $member->firstname) }}">
                            @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="last_name" class="form-label">Nom</label>
                            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $member->last_name) }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $member->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $member->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $member->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="address" class="form-label">Adresse</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address', $member->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $member->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-lg-6">
                            <label for="organisation_id" class="form-label">Organisation</label>
                            <select name="organisation_id" id="organisation_id" class="form-control @error('organisation_id') is-invalid @enderror">
                                <option value="">Sélectionnez une organisation</option>
                                @foreach($organisations as $organisation)
                                    <option value="{{ $organisation->id }}" {{ old('organisation_id', $member->organisation_id) == $organisation->id ? 'selected' : '' }}>{{ $organisation->name }}</option>
                                @endforeach
                            </select>
                            @error('organisation_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <label for="profile_image" class="form-label">Photo de profil</label>
                            @if($member->profile_image)
                                <div class="mb-2">
                                    <img src="{{ asset($member->profile_image) }}" class="rounded" style="width:64px;height:64px;object-fit:cover" alt="">
                                    <small class="text-muted ms-2">Laissez vide pour garder la photo actuelle.</small>
                                </div>
                            @endif
                            <input type="file" name="profile_image" id="profile_image" class="form-control @error('profile_image') is-invalid @enderror">
                            @error('profile_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', $member->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Actif</label>
                            </div>
                        </div>

                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('advanced.members.show', $member) }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection