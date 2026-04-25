<?php

namespace App\Http\Controllers;

use App\Http\Requests\KioskCheckInRequest;
use App\Models\AttendanceEvent;
use App\Models\AttendanceRecord;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class KioskController extends Controller
{
    public function show(): View
    {
        $activeEvent = AttendanceEvent::query()
            ->active()
            ->latest('updated_at')
            ->first();

        return view('kiosk.show', [
            'activeEvent' => $activeEvent,
            'recentRecords' => $activeEvent
                ? AttendanceRecord::query()
                    ->whereBelongsTo($activeEvent)
                    ->with('employee')
                    ->latest('checked_in_at')
                    ->limit(8)
                    ->get()
                : collect(),
        ]);
    }

    public function store(KioskCheckInRequest $request): RedirectResponse
    {
        $activeEvent = AttendanceEvent::query()
            ->active()
            ->latest('updated_at')
            ->first();

        if ($activeEvent === null) {
            return redirect()
                ->route('kiosk.show')
                ->withErrors([
                    'employee_id' => 'No active attendance event is configured by the administrator.',
                ]);
        }

        $employee = Employee::query()
            ->where('employee_id', $request->validated()['employee_id'])
            ->first();

        if ($employee === null) {
            return redirect()
                ->route('kiosk.show')
                ->withErrors([
                    'employee_id' => 'The scanned employee QR is not registered.',
                ]);
        }

        $attendanceRecord = AttendanceRecord::query()->firstOrNew([
            'attendance_event_id' => $activeEvent->id,
            'employee_profile_id' => $employee->id,
        ]);

        $wasExisting = $attendanceRecord->exists;

        $attendanceRecord->checked_in_at = now();
        $attendanceRecord->save();

        return redirect()
            ->route('kiosk.show')
            ->with('status', $wasExisting
                ? $employee->name.' attendance was refreshed for '.$activeEvent->title.'.'
                : $employee->name.' recorded for '.$activeEvent->title.'.');
    }
}