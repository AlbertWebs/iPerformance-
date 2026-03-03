<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateVerificationLog extends Model
{
    protected $table = 'certificate_verification_logs';

    protected $fillable = [
        'certificate_number',
        'ip_address',
        'user_agent',
        'found',
    ];

    protected function casts(): array
    {
        return [
            'found' => 'boolean',
        ];
    }
}
