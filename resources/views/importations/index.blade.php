@extends('layouts.app')

@section('content')
@include('users._header_config')
<div>

    <form action="{{ route('importations.store') }}" method="post" enctype="multipart/form-data">
        @method('post')
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Choose file</label>
            <input
            type="file"
            class="form-control"
            name="file"
            id=""
            placeholder=""
            aria-describedby="fileHelpId"
            />
            <div id="fileHelpId" class="form-text">Help text</div>
            @error('file')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Valide</button>
    </form>

</div>
@stop
