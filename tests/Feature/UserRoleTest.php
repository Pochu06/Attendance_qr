<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_be_assigned_roles_through_the_normalized_pivot_table(): void
    {
        $user = User::factory()->create();
        $roles = Role::factory()->count(2)->create();

        $user->roles()->attach($roles->modelKeys());

        $user->load('roles');

        $this->assertCount(2, $user->roles);
        $this->assertEqualsCanonicalizing($roles->modelKeys(), $user->roles->modelKeys());
        $this->assertDatabaseHas('user_roles', [
            'user_id' => $user->id,
            'role_id' => $roles->first()->id,
        ]);
        $this->assertDatabaseHas('user_roles', [
            'user_id' => $user->id,
            'role_id' => $roles->last()->id,
        ]);
    }
}