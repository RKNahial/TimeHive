<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff\Staff;
use App\Models\Student\Student;
use App\Models\Requirements\Requirement;
use App\Models\Course\Course;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $data = [
            'instructorCount' => Staff::count(),
            'studentCount' => Student::count(),
            'pendingRequirements' => Requirement::where('status', 'pending')->count(),
            'activeCourses' => Course::where('status', 'active')->count(),
            'instructors' => Staff::withCount(['courses', 'students'])->get()
        ];

        return view('tenant.dashboard', $data);
    }

    public function staffDashboard()
    {
        return view('tenant.staff.dashboard');
    }
}