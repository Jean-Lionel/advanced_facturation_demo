
    @extends('layouts.app')

    @section('content')
    @include('maisonLocation._header')
        @livewire('payement.client-non-paye')
    @endsection
