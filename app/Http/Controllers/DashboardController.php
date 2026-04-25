<?php

namespace App\Http\Controllers;

use App\Models\AttendanceEvent;
use App\Models\AttendanceRecord;
use App\Models\Employee;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'activeEvent' => AttendanceEvent::query()
                ->active()
                ->withCount('attendanceRecords')
                ->latest('updated_at')
                ->first(),
            'employeeCount' => Employee::query()->count(),
            'eventCount' => AttendanceEvent::query()->count(),
            'recentRecords' => AttendanceRecord::query()
                ->with(['employee', 'attendanceEvent'])
                ->latest('checked_in_at')
                ->limit(5)
                ->get(),
        ]);
    }
}