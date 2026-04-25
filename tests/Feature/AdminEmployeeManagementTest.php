<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEmployeeManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_employee_qr_profiles(): void
    {
        $admin = $this->createAdminUser();

        $response = $this
            ->actingAs($admin)
            ->post(route('employees.store'), [
                'name' => 'Juan Dela Cruz',
                'office' => 'Mayor\'s Office',
                'employee_id' => 'APARRI-00045',
            ]);

        $response
            ->assertRedirect(route('employees.index'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('employees', [
            'name' => 'Juan Dela Cruz',
            'office' => 'Mayor\'s Office',
            'employee_id' => 'APARRI-00045',
        ]);
    }

    public function test_admin_can_view_a_printable_employee_qr_page(): void
    {
        $admin = $this->createAdminUser();
        $employee = \App\Models\Employee::factory()->create([
            'employee_id' => 'APARRI-00088',
        ]);

        $response = $this
            ->actingAs($admin)
            ->get(route('employees.qr.show', $employee));

        $response
            ->assertOk()
            ->assertSee('APARRI-00088')
            ->assertSee('<svg', false)
            ->assertSee('Employee QR Card');
    }

    public function test_non_admin_users_can_not_access_employee_qr_management(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('employees.index'));

        $response->assertForbidden();
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