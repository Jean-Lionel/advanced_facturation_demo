@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>{{ __('Environment Settings') }}</h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('env_settings.create') }}" class="btn btn-primary">
                    Add New Setting
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('env_settings.index') }}" method="GET" class="form-inline">
                    <div class="form-group mr-2 w-100">
                        <input type="text" name="search" class="form-control w-100" placeholder="Search by key or value..." value="{{ request('search') }}">
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Key</th>
                                <th scope="col">Value</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $setting)
                                <tr>
                                    <td class="font-weight-bold">{{ $setting->key }}</td>
                                    <td>
                                        @if (Str::contains(strtoupper($setting->key), ['PASSWORD', 'SECRET', 'KEY', 'TOKEN']))
                                            ******
                                        @else
                                            {{ Str::limit($setting->value, 50) }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('env_settings.edit', $setting) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                                        <form action="{{ route('env_settings.destroy', $setting) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $settings->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

