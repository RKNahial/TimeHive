@extends('tenant.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    Welcome to {{ tenant('id') }}'s admin dashboard!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection