<?php

namespace Database\Seeders;

use App\Enums\EnrollmentStatus;
use App\Enums\PublicationStatus;
use App\Enums\SessionMode;
use App\Enums\SessionStatus;
use App\Models\Category;
use App\Models\Enrollment;
use App\Models\Training;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    public function run(): void
    {
        $trainer = User::role('Trainer')->orderBy('name')->firstOrFail();
        $participant = User::role('Participant')->orderBy('name')->firstOrFail();

        $trainings = [
            [
                'category' => 'Marketing digital',
                'title_fr' => 'Maitriser la publicite sur les reseaux sociaux',
                'title_en' => 'Master social media advertising',
                'short_description_fr' => 'Une formation pratique pour lancer des campagnes Meta et LinkedIn efficaces.',
                'short_description_en' => 'A hands-on course to launch effective Meta and LinkedIn campaigns.',
                'full_description_fr' => 'Apprenez a definir vos audiences, construire vos annonces, suivre les conversions et optimiser votre budget sur plusieurs plateformes sociales.',
                'full_description_en' => 'Learn how to define audiences, craft ad creatives, track conversions, and optimize your budget across multiple social platforms.',
                'price' => 1200,
                'duration_hours' => 16,
                'level' => 'Intermediate',
            ],
            [
                'category' => 'Developpement web',
                'title_fr' => 'Laravel avance pour applications metier',
                'title_en' => 'Advanced Laravel for business applications',
                'short_description_fr' => 'Architecture, API, securite et bonnes pratiques pour projets Laravel professionnels.',
                'short_description_en' => 'Architecture, APIs, security, and best practices for professional Laravel projects.',
                'full_description_fr' => 'Cette formation couvre la structuration dun projet Laravel, les patterns utiles, les tests, lAPI REST et la gestion des performances.',
                'full_description_en' => 'This course covers Laravel project structure, useful patterns, testing, REST APIs, and performance considerations.',
                'price' => 1800,
                'duration_hours' => 24,
                'level' => 'Advanced',
            ],
            [
                'category' => 'Analyse de donnees',
                'title_fr' => 'Power BI pour decideurs',
                'title_en' => 'Power BI for decision makers',
                'short_description_fr' => 'Construisez des tableaux de bord lisibles et utiles pour le pilotage.',
                'short_description_en' => 'Build readable and useful dashboards for decision-making.',
                'full_description_fr' => 'De la modelisation des donnees a la visualisation, cette formation aide a transformer vos chiffres en tableaux de bord exploitables.',
                'full_description_en' => 'From data modeling to visualization, this course helps turn numbers into actionable dashboards.',
                'price' => 950,
                'duration_hours' => 12,
                'level' => 'Beginner',
            ],
        ];

        foreach ($trainings as $index => $data) {
            $category = Category::query()->where('name_fr', $data['category'])->firstOrFail();

            $training = Training::updateOrCreate(
                ['title_en' => $data['title_en']],
                [
                    'category_id' => $category->id,
                    'title_fr' => $data['title_fr'],
                    'title_en' => $data['title_en'],
                    'short_description_fr' => $data['short_description_fr'],
                    'short_description_en' => $data['short_description_en'],
                    'full_description_fr' => $data['full_description_fr'],
                    'full_description_en' => $data['full_description_en'],
                    'price' => $data['price'],
                    'duration_hours' => $data['duration_hours'],
                    'level' => $data['level'],
                    'status' => PublicationStatus::Published->value,
                    'published_at' => now()->subDays($index + 1),
                    'seo_title_fr' => $data['title_fr'].' | TrainUp Academy',
                    'seo_title_en' => $data['title_en'].' | TrainUp Academy',
                    'meta_description_fr' => $data['short_description_fr'],
                    'meta_description_en' => $data['short_description_en'],
                ]
            );

            $session = TrainingSession::updateOrCreate(
                [
                    'training_id' => $training->id,
                    'starts_at' => now()->addDays(10 + ($index * 7))->startOfDay()->addHours(9),
                ],
                [
                    'trainer_id' => $trainer->id,
                    'ends_at' => now()->addDays(11 + ($index * 7))->startOfDay()->addHours(17),
                    'capacity' => 18 + $index,
                    'mode' => match ($index) {
                        0 => SessionMode::Hybrid->value,
                        1 => SessionMode::Online->value,
                        default => SessionMode::InPerson->value,
                    },
                    'city' => match ($index) {
                        0 => 'Casablanca',
                        1 => null,
                        default => 'Rabat',
                    },
                    'meeting_link' => 'https://meet.trainup.ma/session-'.($index + 1),
                    'status' => SessionStatus::Scheduled->value,
                ]
            );

            if ($index === 0) {
                Enrollment::updateOrCreate(
                    [
                        'user_id' => $participant->id,
                        'training_session_id' => $session->id,
                    ],
                    [
                        'reference' => 'INS-ATLAS001',
                        'status' => EnrollmentStatus::Confirmed->value,
                        'confirmed_at' => now()->subDay(),
                    ]
                );
            }
        }
    }
}
