@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">{{ __('Add New Environment Setting') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('env_settings.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="key" class="font-weight-bold">Key</label>
                                <input type="text" name="key" id="key" class="form-control @error('key') is-invalid @enderror" required>
                                @error('key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="value" class="font-weight-bold">Value</label>
                                <textarea name="value" id="value" rows="5" class="form-control @error('value') is-invalid @enderror"></textarea>
                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('env_settings.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
