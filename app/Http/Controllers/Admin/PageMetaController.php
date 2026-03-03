<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageMeta;
use Illuminate\Http\Request;

class PageMetaController extends Controller
{
    protected array $pageKeys = [
        'home' => 'Home',
        'workshops' => 'HR Workshops',
        'trainings' => 'Training Calendar',
        'certifications' => 'HR Certifications',
        'reviews' => 'Reviews / Testimonials',
        'contact' => 'Contact Us',
        'verify' => 'Verify Certificate',
        'services' => 'Services',
    ];

    public function index()
    {
        $pages = PageMeta::all()->keyBy('page_key');
        return view('admin.page-meta.index', [
            'pageKeys' => $this->pageKeys,
            'pages' => $pages,
        ]);
    }

    public function update(Request $request)
    {
        $rules = [];
        foreach (array_keys($this->pageKeys) as $key) {
            $rules["meta_title.{$key}"] = ['nullable', 'string', 'max:255'];
            $rules["meta_description.{$key}"] = ['nullable', 'string', 'max:500'];
        }
        $request->validate($rules);

        foreach (array_keys($this->pageKeys) as $key) {
            PageMeta::updateOrCreate(
                ['page_key' => $key],
                [
                    'meta_title' => $request->input("meta_title.{$key}"),
                    'meta_description' => $request->input("meta_description.{$key}"),
                ]
            );
        }

        return redirect()->route('admin.page-meta.index')->with('success', 'SEO meta updated successfully.');
    }
}
