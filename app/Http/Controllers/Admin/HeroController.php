<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroController extends Controller
{
    public function edit(): View
    {
        $hero = HeroSection::first() ?? new HeroSection([
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
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tagline' => ['nullable', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'headline_highlight' => ['nullable', 'string', 'max:100'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'cta_1_text' => ['nullable', 'string', 'max:100'],
            'cta_1_url' => ['nullable', 'string', 'max:255'],
            'cta_2_text' => ['nullable', 'string', 'max:100'],
            'cta_2_url' => ['nullable', 'string', 'max:255'],
            'cta_3_text' => ['nullable', 'string', 'max:100'],
            'cta_3_url' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_alt' => ['nullable', 'string', 'max:255'],
        ]);

        $hero = HeroSection::first();
        if (!$hero) {
            $hero = new HeroSection();
        }

        if ($request->hasFile('image')) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        $hero->fill($data);
        $hero->save();

        return redirect()->route('admin.hero.edit')->with('success', 'Hero section updated successfully.');
    }
}
