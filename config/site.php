<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Contact details (footer & contact page)
    |--------------------------------------------------------------------------
    */
    'contact' => [
        'email' => env('SITE_EMAIL', 'info@iperformanceafrica.com'),
        'phone' => env('SITE_PHONE', '+254 700 000 000'),
        'address' => env('SITE_ADDRESS', 'Nairobi, Kenya'),
        'address_line2' => env('SITE_ADDRESS_LINE2', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Social links (footer)
    |--------------------------------------------------------------------------
    | Set URL to null to hide that icon.
    */
    'social' => [
        'facebook' => env('SITE_FACEBOOK', 'https://www.facebook.com/iperformanceafrica'),
        'twitter' => env('SITE_TWITTER', 'https://twitter.com/iperformanceafrica'),
        'linkedin' => env('SITE_LINKEDIN', 'https://www.linkedin.com/company/iperformanceafrica'),
        'instagram' => env('SITE_INSTAGRAM', null),
        'youtube' => env('SITE_YOUTUBE', null),
    ],
];
