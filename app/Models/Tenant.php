<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Method to create a unique employees table for each tenant
    public function createEmployeeTable()
    {
        $tableName = 'employees_' . $this->id;

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('position');
                $table->string('department');
                $table->decimal('salary', 10, 2);
                $table->date('joining_date');
                $table->timestamps();
            });
        }
    }
}
