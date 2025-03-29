<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Model;
use App\Models\Staff\Staff;
use App\Models\Course\Course;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'staff_id',
        'tenant_id'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
