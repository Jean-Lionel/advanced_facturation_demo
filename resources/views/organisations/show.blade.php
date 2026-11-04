@extends('layouts.advanced')

@section('content')
<div class="container-fluid px-lg-4 mt-4">
    <div class="row justify-content-center">
    <div>
                @livewire('organisation.add-member', ['organisation' => $organisation])
            </div>
    </div>
</div>
@endsection
