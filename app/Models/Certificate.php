<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'certificate_number',
        'name',
        'course',
        'date_issued',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'date_issued' => 'date',
        ];
    }

    public function scopeValid($query)
    {
        return $query->where('status', 'valid');
    }

    /**
     * Generate next certificate number for the given year.
     * Format: IPC-YYYY-NNNNN (e.g. IPC-2025-00001)
     */
    public static function generateCertificateNumber(?int $year = null): string
    {
        $year = $year ?? (int) date('Y');
        $prefix = "IPC-{$year}-";
        $numbers = static::where('certificate_number', 'like', $prefix . '%')
            ->pluck('certificate_number');

        $next = 1;
        foreach ($numbers as $num) {
            if (preg_match('/' . preg_quote($prefix, '/') . '(\d+)$/', $num, $m)) {
                $n = (int) $m[1];
                if ($n >= $next) {
                    $next = $n + 1;
                }
            }
        }

        return $prefix . str_pad((string) $next, 5, '0', STR_PAD_LEFT);
    }
}
