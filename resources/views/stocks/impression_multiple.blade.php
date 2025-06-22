@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Impression multiple</h1>

    <form action="" method="GET" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label for="dateDebut" class="form-label">Date du Début</label>
            <input type="date" name="dateDebut" id="dateDebut" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="dateFin" class="form-label">Date de Fin</label>
            <input type="date" name="dateFin" id="dateFin" class="form-control">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Imprimer</button>
        </div>
    </form>
</div>

@endsection
