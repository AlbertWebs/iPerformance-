<?php

namespace App\Http\Controllers;

use App\Models\LegalPage;
use Illuminate\View\View;

class LegalPageController extends Controller
{
    public function terms(): View
    {
        $legal = LegalPage::current();
        return view('legal.terms', [
            'content' => $legal->terms_content ?? '',
            'meta_title' => 'Terms and Conditions | iPerformance Africa',
            'meta_description' => 'Terms and Conditions for using iPerformance Africa services.',
        ]);
    }

    public function privacy(): View
    {
        $legal = LegalPage::current();
        return view('legal.privacy', [
            'content' => $legal->privacy_content ?? '',
            'meta_title' => 'Privacy Policy | iPerformance Africa',
            'meta_description' => 'Privacy Policy for iPerformance Africa.',
        ]);
    }
}
