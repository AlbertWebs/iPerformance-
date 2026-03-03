<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = [
        'title',
        'description',
        'banner_image',
        'date',
        'location',
        'registration_link',
        'price',
        'status',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')->where('date', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where('status', 'past')->orWhere('date', '<', now());
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
