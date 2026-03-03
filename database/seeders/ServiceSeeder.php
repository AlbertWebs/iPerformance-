<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'HR Consulting', 'slug' => 'hr-consulting', 'short_description' => 'Strategic HR advisory and policy design.', 'full_description' => 'We help organizations design and implement HR strategies, policies, and practices aligned with business goals.'],
            ['title' => 'Training & Development', 'slug' => 'training-development', 'short_description' => 'Custom and open training programs.', 'full_description' => 'From open enrollment workshops to customized in-house programs, we build capability across your workforce.'],
            ['title' => 'Certification Programs', 'slug' => 'certification-programs', 'short_description' => 'Recognized HR credentials.', 'full_description' => 'Our certification programs validate skills and support career progression for HR professionals.'],
        ];

        foreach ($items as $i => $item) {
            Service::updateOrCreate(
                ['slug' => $item['slug']],
                array_merge($item, ['sort_order' => $i, 'is_active' => true])
            );
        }
    }
}
