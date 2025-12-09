@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Reports') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Badges</h5>
                                    <p class="card-text">{{ $badgeCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Assertions</h5>
                                    <p class="card-text">{{ $assertionCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-4">Latest Badges</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestBadges as $badge)
                                <tr>
                                    <td>{{ $badge->name }}</td>
                                    <td>{{ $badge->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="mt-4">Latest Assertions</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Badge</th>
                                <th>Recipient</th>
                                <th>Issued On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestAssertions as $assertion)
                                <tr>
                                    <td>{{ $assertion->badge->name }}</td>
                                    <td>{{ $assertion->recipient_email }}</td>
                                    <td>{{ $assertion->issued_on }}</td>
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
