
@extends('layouts.app')

@section('content')
@include('maisonLocation._header')
<div>
    @livewire('location.payment-mensuel')
</div>
@endsection

