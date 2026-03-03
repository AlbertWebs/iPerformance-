<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkshopController extends Controller
{
    public function index(Request $request)
    {
        $workshops = Workshop::orderBy('date', 'desc')->paginate(15);
        return view('admin.workshops.index', compact('workshops'));
    }

    public function create()
    {
        return view('admin.workshops.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'banner_image' => ['nullable', 'image', 'max:2048'],
            'date' => ['required', 'date'],
            'location' => ['required', 'string', 'in:Physical,Virtual'],
            'registration_link' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'string', 'in:upcoming,past'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('workshops', 'public');
        }
        Workshop::create($data);
        return redirect()->route('admin.workshops.index')->with('success', 'Workshop created successfully.');
    }

    public function edit(Workshop $workshop)
    {
        return view('admin.workshops.edit', compact('workshop'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'banner_image' => ['nullable', 'image', 'max:2048'],
            'date' => ['required', 'date'],
            'location' => ['required', 'string', 'in:Physical,Virtual'],
            'registration_link' => ['nullable', 'url', 'max:500'],
            'status' => ['required', 'string', 'in:upcoming,past'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('banner_image')) {
            if ($workshop->banner_image) {
                Storage::disk('public')->delete($workshop->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('workshops', 'public');
        }
        $workshop->update($data);
        return redirect()->route('admin.workshops.index')->with('success', 'Workshop updated successfully.');
    }

    public function destroy(Workshop $workshop)
    {
        if ($workshop->banner_image) {
            Storage::disk('public')->delete($workshop->banner_image);
        }
        $workshop->delete();
        return redirect()->route('admin.workshops.index')->with('success', 'Workshop deleted successfully.');
    }
}
