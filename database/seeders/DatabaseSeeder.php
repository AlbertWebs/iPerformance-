<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            TestUserSeeder::class,
            PageMetaSeeder::class,
            TrainingCategorySeeder::class,
            WorkshopSeeder::class,
            TrainingSeeder::class,
            CertificationSeeder::class,
            ReviewSeeder::class,
            CertificateSeeder::class,
            ServiceSeeder::class,
            HeroSectionSeeder::class,
        ]);
    }
}
