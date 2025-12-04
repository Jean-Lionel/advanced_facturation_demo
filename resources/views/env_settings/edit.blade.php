@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">{{ __('Edit Environment Setting') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('env_settings.update', $envSetting) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="key" class="font-weight-bold">Key</label>
                                <input type="text" name="key" id="key" value="{{ $envSetting->key }}" class="form-control bg-light" readonly>
                                <small class="form-text text-muted">Key cannot be changed.</small>
                            </div>
                            <div class="form-group">
                                <label for="value" class="font-weight-bold">Value</label>
                                <textarea name="value" id="value" rows="5" class="form-control @error('value') is-invalid @enderror">{{ $envSetting->value }}</textarea>
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
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
