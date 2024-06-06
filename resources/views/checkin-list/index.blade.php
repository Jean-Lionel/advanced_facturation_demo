@extends('layouts.app')

@section('content')
    <form action="" method="post">
        @include('rooms._header_room')
    </form>
    <div class="d-flex">
        <h5 class="text text-primary col-2">Listes Checkins</h5>
        <form action="" class="col-10 d-flex">
            <input type="text" name="checkCode" id="" class="form-control col-3" placeholder="Code Checkin">
            <div class="col-1"></div>
            <input type="date" name="checkDateIn" id="" class="col-2 form-control">
            <div class="col-1"></div>
            <input type="date" name="checkDateOut" id="" class="col-2 form-control">
            <div class="col-1"></div>
            <button class="btn btn-info col-1">Chercher</button>
        </form>
    </div>
    <hr class="text text-info" />
    <div class="container-fluid">
        @if (count($checkins) > 0)
            <table class="table table-striped">
                <thead class="text text-center">
                    <tr>
                        <th>Code Checkin</th>
                        <th>Client</th>
                        <th>Chambre</th>
                        <th>Date Entree</th>
                        <th>Date Sortie</th>
                        <th>Statut</th>
                        <th>Cree Par</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text text-center">
                    @foreach ($checkins as $item)
                        <tr>
                            <td><b class="text text-success"><i>{{ $item->file_number }}</i></b></td>
                            <td>{{ $item->clients->name }}</td>
                            <td>{{ $item->rooms->room_name }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->room_date_checkin)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->room_date_checkout)) }}</td>
                            <td
                                class="text text-center alert {{ $item->room_file_status == 0 ? 'alert-success' : 'alert-danger' }}">
                                {{ $item->room_file_status == 0 ? 'Checkin' : 'Checkout' }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td class="d-flex justify-content-center">
                                @if ($item->room_file_status == 0)
                                    <button class="btn bnt-info"><i class="fa fa-edit btn btn-sm btn-warning"></i>
                                    </button>
                                @endif
                                <button class="btn bnt-info"><i class="fa fa-eye btn btn-sm btn-danger"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class="text text-success" />
            <div class="d-flex justify-content-end">
                {{ $checkins->links() }}
            </div>
        @endif
        @empty($checkins)
            <table class="table table-striped">
                <tr>Aucune Checkin Disponible</tr>
            </table>
        @endempty

    </div>
@endsection
