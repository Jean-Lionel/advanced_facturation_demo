@extends('layouts.app')


@section('content')

@include('products._header_product')

<div class="container m-2 p-4">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">
                Liste des utlisateurs associes a la stock : # {{ $stocke->name}}
            </h4>
            <form class="form-inline" action="" method="post">
                @csrf
                <input type="hidden" name="stock_id" value="{{ $stocke->id }}">
                <div class="form-group mx-sm-3 mb-2">
                    <select class="form-select" name="user_id" aria-label="Default select example">
                        <option selected>Selectionne l'utilisateur</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                      </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Ajoute au Stock</button>
              </form>

        </div>
    </div>
    <ol class="list-group list-group-numbered">
        @forelse ($userstockes as $item)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                <div class="fw-bold">{{ $item->name}}</div>
                {{ $item->email}}
                </div>
                <a href="{{ route('stocke.userremove',['stocke'=>$stocke,'user' => $item])}}" class="btn btn-secondary disabled" tabindex="-1" role="button" >Supprimer</a>

            </li>
        @empty

        @endforelse

      </ol>
</div>

@endsection
