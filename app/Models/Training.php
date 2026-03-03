<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Training extends Model
{
    protected $fillable = [
        'training_category_id',
        'title',
        'slug',
        'description',
        'objectives',
        'outline',
        'target_audience',
        'start_date',
        'end_date',
        'location',
        'registration_link',
        'image',
        'price',
        'time_slot',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('end_date', '>=', now());
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}
