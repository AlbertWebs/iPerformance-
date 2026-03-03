<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        Certificate::updateOrCreate(
            ['certificate_number' => 'IPA-CHRM-2024-001'],
            [
                'name' => 'Demo User',
                'course' => 'Certified HR Manager',
                'date_issued' => now()->subMonths(2),
                'status' => 'valid',
            ]
        );
    }
}
