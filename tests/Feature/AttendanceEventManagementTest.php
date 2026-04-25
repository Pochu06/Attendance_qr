<?php

namespace Tests\Feature;

use App\Models\AttendanceEvent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceEventManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_an_attendance_event(): void
    {
        $admin = $this->createAdminUser();

        $response = $this
            ->actingAs($admin)
            ->post(route('attendance.events.store'), [
                'title' => 'Flag Ceremony Attendance',
                'description' => 'Monday flag ceremony attendance window.',
                'starts_at' => '2026-04-22 08:00:00',
                'ends_at' => '2026-04-22 09:00:00',
            ]);

        $response
            ->assertRedirect(route('attendance.events.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('attendance_events', [
            'title' => 'Flag Ceremony Attendance',
            'is_active' => false,
        ]);
    }

    public function test_admin_can_switch_the_active_attendance_event(): void
    {
        $admin = $this->createAdminUser();
        $oldEvent = AttendanceEvent::factory()->active()->create([
            'title' => 'Morning Attendance',
        ]);
        $newEvent = AttendanceEvent::factory()->create([
            'title' => 'Seminar Attendance',
        ]);

        $response = $this
            ->actingAs($admin)
            ->patch(route('attendance.events.activate', $newEvent));

        $response->assertRedirect(route('attendance.events.index'));

        $this->assertDatabaseHas('attendance_events', [
            'id' => $oldEvent->id,
            'is_active' => false,
        ]);
        $this->assertDatabaseHas('attendance_events', [
            'id' => $newEvent->id,
            'is_active' => true,
        ]);
    }

    private function createAdminUser(): User
    {
        $user = User::factory()->create();
        $adminRole = Role::factory()->create([
            'name' => 'admin',
        ]);

        $user->roles()->attach($adminRole);

        return $user;
    }
}