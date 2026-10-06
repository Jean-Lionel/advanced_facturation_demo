@extends('layouts.app')

@section('content')

<div>
    <div class="row">
        <div class="col-md-6 d-flex justify-content-between">
            <a href="{{ route('depense-categories.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            <h4 class="text-center">Catégories de dépenses</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('depenses.index') }}" class="btn btn-link btn-sm">Retour aux dépenses</a>
        </div>
    </div>

    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($depenseCategories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('depense-categories.edit', $category) }}" class="btn btn-outline-primary btn-sm">Modifier</a>
                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete(event, {{ $category->id }})">Supprimer</button>
                    <form id="delete-form-{{ $category->id }}" action="{{ route('depense-categories.destroy', $category) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="col-md-12" style="height: 20px; overflow: hidden;">
    {{ $depenseCategories->links() }}
</div>

@endsection

@section('javascript')
<script>
    function confirmDelete(event, id) {
        event.preventDefault();
        if (confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection