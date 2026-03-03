<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::orderBy('sort_order')->orderBy('title')->paginate(15);
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:certifications,slug'],
            'description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:255'],
            'accreditation_details' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'apply_link' => ['nullable', 'url', 'max:500'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('certifications', 'public');
        }
        Certification::create($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Certification created successfully.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:certifications,slug,' . $certification->id],
            'description' => ['nullable', 'string'],
            'duration' => ['nullable', 'string', 'max:255'],
            'accreditation_details' => ['nullable', 'string'],
            'requirements' => ['nullable', 'string'],
            'apply_link' => ['nullable', 'url', 'max:500'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            if ($certification->image) {
                Storage::disk('public')->delete($certification->image);
            }
            $data['image'] = $request->file('image')->store('certifications', 'public');
        }
        $certification->update($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->image) {
            Storage::disk('public')->delete($certification->image);
        }
        $certification->delete();
        return redirect()->route('admin.certifications.index')->with('success', 'Certification deleted successfully.');
    }
}
