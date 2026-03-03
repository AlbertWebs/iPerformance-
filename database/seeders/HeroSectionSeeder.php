<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::firstOrCreate(
            ['id' => 1],
            [
                'tagline' => 'HR Consulting & Certification',
                'headline' => 'HR excellence for',
                'headline_highlight' => 'Africa',
                'subtitle' => 'Workshops, training programs, and certifications to build and validate your HR capabilities. Partner with us to elevate your people strategy.',
                'cta_1_text' => 'View workshops',
                'cta_1_url' => 'workshops.index',
                'cta_2_text' => 'Training calendar',
                'cta_2_url' => 'trainings.index',
                'cta_3_text' => 'Contact us',
                'cta_3_url' => 'contact',
                'image' => null,
                'image_alt' => 'HR excellence and professional development',
            ]
        );
    }
}
