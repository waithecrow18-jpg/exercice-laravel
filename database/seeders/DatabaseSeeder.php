<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            SiteSettingSeeder::class,
            CategorySeeder::class,
            TrainingSeeder::class,
            BlogPostSeeder::class,
        ]);

        BlogPost::factory(4)->create();
        ContactMessage::factory(5)->create();
        Enrollment::factory(4)->create();
    }
}
