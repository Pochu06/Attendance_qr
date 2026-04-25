<?php

namespace Database\Seeders;

use App\Models\AttendanceEvent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $user = User::query()->updateOrCreate([
            'email' => 'admin@aparri.gov.ph',
        ], [
            'name' => 'LGU Aparri Administrator',
            'password' => Hash::make('password'),
        ]);

        $defaultRoleId = Role::query()
            ->where('name', 'admin')
            ->value('id');

        if ($defaultRoleId !== null) {
            $user->roles()->syncWithoutDetaching([$defaultRoleId]);
        }

        AttendanceEvent::query()->where('title', 'LGU Aparri Daily Attendance')->update([
            'is_active' => false,
        ]);

        AttendanceEvent::query()->updateOrCreate([
            'title' => 'LGU Aparri Daily Attendance',
        ], [
            'description' => 'Default active attendance event for kiosk check-ins.',
            'is_active' => true,
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->endOfDay(),
        ]);
    }
}
