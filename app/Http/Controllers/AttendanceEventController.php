<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceEventRequest;
use App\Models\AttendanceEvent;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AttendanceEventController extends Controller
{
    public function index(): View
    {
        return view('admin.attendance-events.index', [
            'attendanceEvents' => AttendanceEvent::query()
                ->latest('created_at')
                ->get(),
            'activeEvent' => AttendanceEvent::query()
                ->active()
                ->latest('updated_at')
                ->first(),
        ]);
    }

    public function store(StoreAttendanceEventRequest $request): RedirectResponse
    {
        AttendanceEvent::query()->create($request->validated());

        return redirect()
            ->route('attendance.events.index')
            ->with('status', 'Attendance event created successfully.');
    }

    public function activate(AttendanceEvent $attendanceEvent): RedirectResponse
    {
        DB::transaction(function () use ($attendanceEvent): void {
            AttendanceEvent::query()->update(['is_active' => false]);

            $attendanceEvent->forceFill([
                'is_active' => true,
            ])->save();
        });

        return redirect()
            ->route('attendance.events.index')
            ->with('status', 'Active attendance event updated.');
    }
}