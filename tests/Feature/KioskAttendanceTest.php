<?php

namespace Tests\Feature;

use App\Models\AttendanceEvent;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KioskAttendanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_kiosk_displays_the_active_attendance_event(): void
    {
        AttendanceEvent::factory()->active()->create([
            'title' => 'Municipal Assembly',
        ]);

        $response = $this->get(route('kiosk.show'));

        $response
            ->assertOk()
            ->assertSee('Public Attendance Kiosk')
            ->assertSee('Municipal Assembly');
    }

    public function test_public_kiosk_can_record_attendance_from_an_employee_qr_value(): void
    {
        $event = AttendanceEvent::factory()->active()->create([
            'title' => 'Department Meeting',
        ]);
        $employee = Employee::factory()->create([
            'name' => 'Maria Santos',
            'employee_id' => 'APARRI-01001',
        ]);

        $response = $this->post(route('kiosk.check-in'), [
            'employee_id' => 'APARRI-01001',
        ]);

        $response->assertRedirect(route('kiosk.show'));

        $this->assertDatabaseHas('attendance_records', [
            'attendance_event_id' => $event->id,
            'employee_profile_id' => $employee->id,
        ]);
    }

    public function test_public_kiosk_rejects_unknown_employee_ids(): void
    {
        AttendanceEvent::factory()->active()->create();

        $response = $this->from(route('kiosk.show'))->post(route('kiosk.check-in'), [
            'employee_id' => 'UNKNOWN-EMPLOYEE',
        ]);

        $response
            ->assertRedirect(route('kiosk.show'))
            ->assertSessionHasErrors('employee_id');
    }
}