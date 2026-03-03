<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $table = 'hero_section';

    protected $fillable = [
        'tagline',
        'headline',
        'headline_highlight',
        'subtitle',
        'cta_1_text',
        'cta_1_url',
        'cta_2_text',
        'cta_2_url',
        'cta_3_text',
        'cta_3_url',
        'image',
        'image_alt',
    ];

    /**
     * Get the singleton hero section (first row).
     */
    public static function current(): self
    {
        $hero = static::first();
        if ($hero) {
            return $hero;
        }
        return new static([
            'tagline' => 'HR Consulting & Certification',
            'headline' => 'HR excellence for',
            'headline_highlight' => 'Africa',
            'subtitle' => 'Workshops, training programs, and certifications to build and validate your HR capabilities.',
            'cta_1_text' => 'View workshops',
            'cta_1_url' => 'workshops.index',
            'cta_2_text' => 'Training calendar',
            'cta_2_url' => 'trainings.index',
            'cta_3_text' => 'Contact us',
            'cta_3_url' => 'contact',
        ]);
    }

    /**
     * Resolve a CTA URL to a full URL (route name or absolute URL).
     */
    public function resolveCtaUrl(?string $value): string
    {
        if (empty($value)) {
            return '#';
        }
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }
        return route($value);
    }
}
