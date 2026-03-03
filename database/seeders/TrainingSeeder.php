<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    public function run(): void
    {
        $hr = TrainingCategory::where('slug', 'hr-management')->first();
        $items = [
            ['title' => 'Certified HR Professional', 'slug' => 'certified-hr-professional', 'description' => 'Comprehensive HR certification program.', 'start_date' => now()->addDays(20), 'end_date' => now()->addDays(25), 'location' => 'Nairobi', 'registration_link' => route('register'), 'price' => 70000, 'time_slot' => '8:00 AM - 4:00 PM', 'training_category_id' => $hr?->id],
            ['title' => 'Strategic Talent Management', 'slug' => 'strategic-talent-management', 'description' => 'Build and retain top talent.', 'start_date' => now()->addDays(45), 'end_date' => now()->addDays(47), 'location' => 'Virtual', 'training_category_id' => $hr?->id, 'price' => 45000],
        ];

        foreach ($items as $i => $item) {
            Training::updateOrCreate(
                ['slug' => $item['slug']],
                array_merge($item, ['sort_order' => $i, 'is_active' => true])
            );
        }
    }
}
