<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id', 'name', 'email', 'position', 'department', 'salary', 'joining_date'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function getTable()
    {
        return 'employees_' . Auth::user()->tenant_id;
    }
}