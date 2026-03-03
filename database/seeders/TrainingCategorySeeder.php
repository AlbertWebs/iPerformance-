<?php

namespace Database\Seeders;

use App\Models\TrainingCategory;
use Illuminate\Database\Seeder;

class TrainingCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'HR Management', 'slug' => 'hr-management'],
            ['name' => 'Leadership', 'slug' => 'leadership'],
            ['name' => 'Compliance', 'slug' => 'compliance'],
        ];

        foreach ($categories as $i => $cat) {
            TrainingCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['sort_order' => $i, 'is_active' => true])
            );
        }
    }
}
