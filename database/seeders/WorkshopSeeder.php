<?php

namespace Database\Seeders;

use App\Models\Workshop;
use Illuminate\Database\Seeder;

class WorkshopSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'HR Fundamentals Workshop', 'description' => 'A one-day intensive covering core HR practices and compliance.', 'date' => now()->addDays(14), 'location' => 'Virtual', 'status' => 'upcoming', 'registration_link' => route('register')],
            ['title' => 'Performance Management Masterclass', 'description' => 'Design and implement effective performance management systems.', 'date' => now()->addDays(30), 'location' => 'Physical', 'status' => 'upcoming'],
            ['title' => 'Past Workshop: Recruitment Best Practices', 'description' => 'This workshop was held last quarter.', 'date' => now()->subDays(60), 'location' => 'Virtual', 'status' => 'past'],
        ];

        foreach ($items as $i => $item) {
            Workshop::create(array_merge($item, ['sort_order' => $i, 'is_active' => true]));
        }
    }
}
