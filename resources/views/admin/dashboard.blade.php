@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('You are logged in as an admin!') }}</p>

                    <a href="{{ route('admin.api_keys.index') }}" class="btn btn-primary">Manage API Keys</a>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-info">View Reports</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
