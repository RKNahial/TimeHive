<?php

namespace App\Models\Staff;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course\Course;
use App\Models\Student\Student;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Add relationships
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}