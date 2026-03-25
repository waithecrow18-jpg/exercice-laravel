<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name_fr' => 'Marketing digital', 'name_en' => 'Digital marketing'],
            ['name_fr' => 'Développement web', 'name_en' => 'Web development'],
            ['name_fr' => 'Gestion de projet', 'name_en' => 'Project management'],
            ['name_fr' => 'Analyse de données', 'name_en' => 'Data analysis'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name_fr' => $category['name_fr']],
                $category
            );
        }
    }
}
