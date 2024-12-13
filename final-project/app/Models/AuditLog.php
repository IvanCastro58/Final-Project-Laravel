<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'description',
        'performed_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'performed_by');
    }
}
