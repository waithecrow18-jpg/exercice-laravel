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

        $profiles = [
            [
                'role' => $superAdmin,
                'name' => 'Salma Bennani',
                'email' => 'salma.bennani@trainup.ma',
                'legacy_email' => 'admin@trainup.test',
                'password' => 'Salma@TrainUp26!',
                'phone' => '+212661240315',
                'preferred_locale' => 'fr',
                'last_activity_at' => now()->subMinutes(12),
            ],
            [
                'role' => $admin,
                'name' => 'Karim El Mansouri',
                'email' => 'karim.elmansouri@trainup.ma',
                'password' => 'Karim#Ops2026!',
                'phone' => '+212661240421',
                'preferred_locale' => 'fr',
                'last_activity_at' => now()->subMinutes(28),
            ],
            [
                'role' => $trainer,
                'name' => 'Nora Kabbaj',
                'email' => 'nora.kabbaj@trainup.ma',
                'legacy_email' => 'trainer@trainup.test',
                'password' => 'Nora@Trainer26!',
                'phone' => '+212661240532',
                'preferred_locale' => 'fr',
                'last_activity_at' => now()->subMinutes(34),
            ],
            [
                'role' => $trainer,
                'name' => 'Youssef Idrissi',
                'email' => 'youssef.idrissi@trainup.ma',
                'password' => 'Youssef#Skill26!',
                'phone' => '+212661240648',
                'preferred_locale' => 'en',
                'last_activity_at' => now()->subMinutes(41),
            ],
            [
                'role' => $participant,
                'name' => 'Amal Tazi',
                'email' => 'amal.tazi@atlas-industries.ma',
                'legacy_email' => 'participant@trainup.test',
                'password' => 'Amal@Atlas2026!',
                'phone' => '+212661240754',
                'preferred_locale' => 'fr',
                'last_activity_at' => now()->subMinutes(55),
            ],
            [
                'role' => $participant,
                'name' => 'Omar Belghiti',
                'email' => 'omar.belghiti@novacore.ma',
                'password' => 'Omar#Nova2026!',
                'phone' => '+212661240865',
                'preferred_locale' => 'fr',
                'last_activity_at' => now()->subMinutes(63),
            ],
            [
                'role' => $participant,
                'name' => 'Sara Lahlou',
                'email' => 'sara.lahlou@bluehorizon.ma',
                'password' => 'Sara@Blue2026!',
                'phone' => '+212661240976',
                'preferred_locale' => 'en',
                'last_activity_at' => now()->subMinutes(74),
            ],
            [
                'role' => $participant,
                'name' => 'Hamza Chaoui',
                'email' => 'hamza.chaoui@northwind.ma',
                'password' => 'Hamza#North26!',
                'phone' => '+212661241087',
                'preferred_locale' => 'fr',
                'last_activity_at' => now()->subMinutes(86),
            ],
        ];

        foreach ($profiles as $profile) {
            $role = $profile['role'];
            $user = User::query()
                ->where('email', $profile['email'])
                ->when(isset($profile['legacy_email']), fn ($query) => $query->orWhere('email', $profile['legacy_email']))
                ->first();

            if ($user) {
                $user->fill([
                    'name' => $profile['name'],
                    'email' => $profile['email'],
                    'phone' => $profile['phone'],
                    'preferred_locale' => $profile['preferred_locale'],
                    'status' => UserStatus::Active->value,
                    'last_activity_at' => $profile['last_activity_at'],
                    'email_verified_at' => now()->subDays(3),
                    'password' => Hash::make($profile['password']),
                ])->save();
            } else {
                $user = User::create([
                    'name' => $profile['name'],
                    'email' => $profile['email'],
                    'phone' => $profile['phone'],
                    'preferred_locale' => $profile['preferred_locale'],
                    'status' => UserStatus::Active->value,
                    'last_activity_at' => $profile['last_activity_at'],
                    'email_verified_at' => now()->subDays(3),
                    'password' => Hash::make($profile['password']),
                ]);
            }

            $user->syncRoles([$role]);
        }
    }
}
