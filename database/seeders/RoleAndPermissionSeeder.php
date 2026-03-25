<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'manage users',
            'manage categories',
            'manage trainings',
            'manage sessions',
            'manage enrollments',
            'publish trainings',
            'view dashboard',
            'manage blog',
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $superAdmin = Role::findOrCreate('Super Admin', 'web');
        $admin = Role::findOrCreate('Admin', 'web');
        $trainer = Role::findOrCreate('Trainer', 'web');
        $participant = Role::findOrCreate('Participant', 'web');

        $superAdmin->syncPermissions(Permission::all());
        $admin->syncPermissions([
            'view dashboard',
            'manage users',
            'manage categories',
            'manage trainings',
            'manage sessions',
            'manage enrollments',
            'manage blog',
            'view reports',
        ]);
        $trainer->syncPermissions([
            'view dashboard',
            'manage sessions',
            'manage enrollments',
        ]);
        $participant->syncPermissions([]);

        $adminUser = User::updateOrCreate(
            ['email' => 'admin@trainup.test'],
            [
                'name' => 'Super Admin',
                'phone' => '+212600000001',
                'preferred_locale' => 'fr',
                'status' => UserStatus::Active->value,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
        $adminUser->syncRoles([$superAdmin]);

        $trainerUser = User::updateOrCreate(
            ['email' => 'trainer@trainup.test'],
            [
                'name' => 'Lead Trainer',
                'phone' => '+212600000002',
                'preferred_locale' => 'fr',
                'status' => UserStatus::Active->value,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
        $trainerUser->syncRoles([$trainer]);

        $participantUser = User::updateOrCreate(
            ['email' => 'participant@trainup.test'],
            [
                'name' => 'Demo Participant',
                'phone' => '+212600000003',
                'preferred_locale' => 'en',
                'status' => UserStatus::Active->value,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
        $participantUser->syncRoles([$participant]);
    }
}
