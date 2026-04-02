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
            'admin_email' => 'salma.bennani@trainup.ma',
            'site_phone' => '+212 661 240 315',
            'home_hero_fr' => 'Developpez les competences de vos equipes avec des parcours concrets.',
            'home_hero_en' => 'Build real skills with practical, modern training programs.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
