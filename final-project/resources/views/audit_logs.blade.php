@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5 flex-grow-1 p-5 content">
        <h2 class="fw-bold">Audit Logs</h2>
        <p class="text-secondary fw-semibold">Here’s where you can view all audit logs for actions performed in the system.</p>
        <div class="d-flex justify-content-between align-items-center my-3">
            <form action="/audit-logs" method="GET" class="d-flex ms-auto">
                <input type="text" name="search" class="form-control rounded-pill me-2 py-2 border-primary" placeholder="Search..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary rounded-pill"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="bg-white pt-4 px-4 wrapper-table mt-4">
            <h5 class="fw-bold" style="color: #3B83FB;">Audit Logs</h5>
            <table class="table table-white mt-3 px-3">
                <thead>
                    <tr>
                        <th>Performed By</th>
                        <th>Action</th>
                        <th>Description</th>      
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($auditLogs as $log)
                        <tr>
                            <td>
                                <span class="fw-semibold" style="font-size: smaller;">{{ $log->employee->name }}</span>
                                <br>
                                <span class="text-secondary" style="font-size: x-small;">{{ ucfirst($log->employee->role) }}</span>
                            </td>
                            <td>
                                <div class="alert {{ $log->action === 'Create' ? 'alert-success' : ($log->action === 'Delete' ? 'alert-danger' : 'alert-info') }} fw-semibold alert-custom">
                                    {{ strtoupper($log->action) }}
                                </div>
                            </td>
                            <td><span style="font-size: small;">{{ $log->description }}</span></td>
                            <td>
                                <span class="fw-semibold" style="font-size: smaller;">{{ $log->created_at->format('d M Y') }}</span>
                                <br>
                                <span class="text-secondary" style="font-size: x-small;">{{ $log->created_at->format('H:i') }}</span>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No audit logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $auditLogs->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
