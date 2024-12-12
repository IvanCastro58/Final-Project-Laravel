<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $auditLogs = AuditLog::with('employee')
            ->when($search, function ($query, $search) {
                $query->where('description', 'LIKE', "%{$search}%")
                      ->orWhereHas('employee', function ($query) use ($search) {
                          $query->where('name', 'LIKE', "%{$search}%");
                      });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('audit_logs', ['auditLogs' => $auditLogs]);
    }
}
