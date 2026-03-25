<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'TrainUp Academy',
            'site_tagline' => 'Plateforme bilingue de gestion de formations',
            'admin_email' => 'admin@trainup.test',
            'site_phone' => '+212 600 000 000',
            'home_hero_fr' => 'Développez vos compétences avec des formations concrètes.',
            'home_hero_en' => 'Build practical skills with modern training programs.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
