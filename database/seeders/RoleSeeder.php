<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's roles.
     */
    public function run(): void
    {
        $timestamp = now();

        Role::query()->upsert([
            [
                'name' => 'admin',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'staff',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'user',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ], ['name'], ['updated_at']);
    }
}