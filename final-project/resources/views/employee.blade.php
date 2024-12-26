@extends('layouts.admin')

@section('content')
<style>
    td{
        font-size: small;
    }

    .modal-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh; 
    }
</style>
<div class="container-fluid mt-5 flex-grow-1 p-5 content">
    <h2 class="fw-bold">Manage Employee</h2>
    <p class="text-secondary fw-semibold">Here’s where you can view the complete list of admins and employees.</p>
    <div class="d-flex justify-content-between align-items-center my-3">
        <button class="btn btn-info text-white fw-semibold rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            <i class="bi bi-person-plus"></i>
            Add Employee/Admin
        </button>
        <form action="/employee" method="GET" class="d-flex ms-auto">
            <input type="text" name="search" class="form-control rounded-pill me-2 py-2 border-primary" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary rounded-pill"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeLabel">Add Employee or Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sendInvitation') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Invitation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white pt-4 px-4 wrapper-table mt-4">
        <h5 class="fw-bold" style="color: #3B83FB;">Employee List</h5>
        <table class="table table-white mt-3 px-3">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ ucfirst($employee->role) }}</td>
                        <td>
                            @if ($employee->status === 'active')
                                <div class="alert alert-success alert-custom">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    {{ ucfirst($employee->status) }}
                                </div>
                            @elseif ($employee->status === 'pending')
                                <div class="alert alert-warning alert-custom">
                                    <i class="bi bi-clock-history me-1"></i>
                                    {{ ucfirst($employee->status) }}
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No employee/s found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $employees->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('addEmployeeModal'), {
            keyboard: false
        });
        myModal.show();
    </script>
@endif
@endsection
