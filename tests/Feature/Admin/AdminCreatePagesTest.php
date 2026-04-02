<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminCreatePagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionSeeder::class);
        $this->actingAs(User::role('Super Admin')->firstOrFail());
    }

    #[DataProvider('createPageRoutes')]
    public function test_admin_create_pages_render_without_errors(string $routeName): void
    {
        $this->get(route($routeName))->assertOk();
    }

    public static function createPageRoutes(): array
    {
        return [
            ['dashboard.users.create'],
            ['dashboard.categories.create'],
            ['dashboard.trainings.create'],
            ['dashboard.sessions.create'],
            ['dashboard.enrollments.create'],
            ['dashboard.posts.create'],
        ];
    }
}
