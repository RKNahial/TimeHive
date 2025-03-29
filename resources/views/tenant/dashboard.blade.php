@extends('tenant.layouts.app')

@section('title', 'Department Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Instructors</h5>
                    <h2 class="card-text">{{ $instructorCount ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <h2 class="card-text">{{ $studentCount ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Pending Requirements</h5>
                    <h2 class="card-text">{{ $pendingRequirements ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Active Courses</h5>
                    <h2 class="card-text">{{ $activeCourses ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <!-- Instructor Management -->
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Instructors</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addInstructorModal">
                        Add Instructor
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Courses</th>
                                <th>Students</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($instructors ?? [] as $instructor)
                            <tr>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td>{{ $instructor->courses_count }}</td>
                                <td>{{ $instructor->students_count }}</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info">Edit</button>
                                    <button class="btn btn-sm btn-danger">Deactivate</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No instructors found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Department Overview -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Department Overview</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Recent Activities</h6>
                            <ul class="list-group">
                                <li class="list-group-item">New student registration</li>
                                <li class="list-group-item">Requirements updated</li>
                                <li class="list-group-item">Course schedule modified</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Quick Actions</h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary">View All Students</button>
                                <button class="btn btn-outline-success">Manage Requirements</button>
                                <button class="btn btn-outline-info">Course Management</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Instructor Modal -->
<div class="modal fade" id="addInstructorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Instructor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tenant.instructor.store', ['tenant' => tenant('id')]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Instructor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection