<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'Certified HR Manager (CHRM)', 'slug' => 'certified-hr-manager', 'description' => 'The CHRM credential validates expertise in HR management.', 'duration' => '6 days', 'is_featured' => true],
            ['title' => 'Certified HR Director', 'slug' => 'certified-hr-director', 'description' => 'For senior HR leaders and directors.', 'duration' => '6 days', 'is_featured' => true],
            ['title' => 'Certified Workplace Counselor', 'slug' => 'certified-workplace-counselor', 'description' => 'Mental health and wellness in the workplace.', 'duration' => '6 days', 'is_featured' => false],
        ];

        foreach ($items as $i => $item) {
            Certification::updateOrCreate(
                ['slug' => $item['slug']],
                array_merge($item, ['sort_order' => $i, 'is_active' => true])
            );
        }
    }
}
