<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use App\Models\Staff\Staff;
use App\Models\Student\Student;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'staff_id',
        'tenant_id'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}