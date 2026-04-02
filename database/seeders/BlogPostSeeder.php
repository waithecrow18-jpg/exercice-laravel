<?php

namespace Database\Seeders;

use App\Enums\PublicationStatus;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::role('Super Admin')->firstOrFail();
        $category = Category::query()->first();

        $posts = [
            [
                'title_fr' => 'Comment choisir une formation adaptee a son equipe',
                'title_en' => 'How to choose the right training for your team',
                'content_fr' => 'Choisir une formation utile commence par lidentification des competences a renforcer, puis par la definition dobjectifs precis et mesurables.',
                'content_en' => 'Choosing a useful training starts with identifying the skills to improve, then defining clear and measurable goals.',
            ],
            [
                'title_fr' => 'Pourquoi le blended learning fonctionne mieux',
                'title_en' => 'Why blended learning works better',
                'content_fr' => 'Le blended learning combine autonomie, pratique et interactions en direct. Il ameliore souvent la retention et lengagement.',
                'content_en' => 'Blended learning combines autonomy, hands-on practice, and live interaction. It often improves retention and engagement.',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::updateOrCreate(
                ['title_en' => $post['title_en']],
                [
                    'category_id' => $category?->id,
                    'author_id' => $author->id,
                    'title_fr' => $post['title_fr'],
                    'title_en' => $post['title_en'],
                    'content_fr' => $post['content_fr'],
                    'content_en' => $post['content_en'],
                    'status' => PublicationStatus::Published->value,
                    'published_at' => now()->subDays(2),
                    'seo_title_fr' => $post['title_fr'].' | Blog',
                    'seo_title_en' => $post['title_en'].' | Blog',
                    'meta_description_fr' => $post['content_fr'],
                    'meta_description_en' => $post['content_en'],
                ]
            );
        }
    }
}
