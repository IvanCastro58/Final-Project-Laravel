@extends('layouts.admin')

@section('content')
<style>
    td{
        font-size: small;
    }
</style>
    <div class="container-fluid mt-5 flex-grow-1 p-5 content">
        <h2 class="fw-bold">Manage Employee</h2>
        <p class="text-secondary fw-semibold">Here’s where you can view the complete list of admins and employees.</p>
        <div class="d-flex justify-content-between align-items-center my-3">
            <form action="/employee" method="GET" class="d-flex ms-auto">
                <input type="text" name="search" class="form-control rounded-pill me-2 py-2 border-primary" placeholder="Search..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary rounded-pill"><i class="bi bi-search"></i></button>
            </form>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ ucfirst($employee->role) }}</td>
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
@endsection
