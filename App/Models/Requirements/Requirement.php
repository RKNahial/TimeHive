<?php

namespace App\Models\Requirements;

use Illuminate\Database\Eloquent\Model;
use App\Models\Staff\Staff;
use App\Models\Student\Student;

class Requirement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'staff_id',
        'student_id',
        'tenant_id'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}