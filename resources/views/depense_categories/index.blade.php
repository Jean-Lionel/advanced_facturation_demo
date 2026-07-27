@extends('layouts.app')

@section('content')
<div class="app-page">
    <div class="app-card">
        <header class="app-card-header">
            <h2 class="app-card-heading">Catégories de dépenses</h2>
            <div class="app-toolbar-actions">
                <a href="{{ route('depenses.index') }}" class="app-btn-ghost">Retour aux dépenses</a>
                <a href="{{ route('depense-categories.create') }}" class="btn btn-primary btn-sm">Ajouter</a>
            </div>
        </header>

        <div class="app-card-body--flush">
            <div class="app-table-wrap">
                <table class="table table-sm app-table">
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
        </div>

        <div class="app-pagination">
            {{ $depenseCategories->links() }}
        </div>
    </div>
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
