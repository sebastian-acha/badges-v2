@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('API Keys') }}</div>

                <div class="card-body">
                    <a href="{{ route('admin.api_keys.create') }}" class="btn btn-primary mb-3">Create API Key</a>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Key</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keys as $key)
                                <tr>
                                    <td>{{ $key->name }}</td>
                                    <td><code>{{ $key->key }}</code></td>
                                    <td>
                                        <form action="{{ route('admin.api_keys.destroy', $key) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
