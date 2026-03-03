<?php

namespace Database\Seeders;

use App\Models\PageMeta;
use Illuminate\Database\Seeder;

class PageMetaSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'home' => ['HR Consulting & Certification | iPerformance Africa', 'Workshops, training, and HR certifications for professionals across Africa.'],
            'workshops' => ['HR Workshops | iPerformance Africa', 'Upcoming HR workshops and events.'],
            'trainings' => ['Training Calendar | iPerformance Africa', 'View our upcoming training programs.'],
            'certifications' => ['HR Certifications | iPerformance Africa', 'Recognized HR certifications.'],
            'reviews' => ['Reviews & Testimonials | iPerformance Africa', 'What our clients say.'],
            'contact' => ['Contact Us | iPerformance Africa', 'Get in touch with our team.'],
            'verify' => ['Verify Certificate | iPerformance Africa', 'Verify your certificate.'],
            'services' => ['Services | iPerformance Africa', 'HR consulting and solutions.'],
        ];

        foreach ($pages as $key => $data) {
            PageMeta::updateOrCreate(
                ['page_key' => $key],
                ['meta_title' => $data[0], 'meta_description' => $data[1]]
            );
        }
    }
}
