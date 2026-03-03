<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $trainings = Training::with('category')->orderBy('start_date', 'desc')->paginate(15);
        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        $categories = TrainingCategory::active()->orderBy('sort_order')->get();
        return view('admin.trainings.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'training_category_id' => ['nullable', 'exists:training_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:trainings,slug'],
            'description' => ['nullable', 'string'],
            'objectives' => ['nullable', 'string'],
            'outline' => ['nullable', 'string'],
            'target_audience' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'location' => ['nullable', 'string', 'max:255'],
            'registration_link' => ['nullable', 'url', 'max:500'],
            'image' => ['nullable', 'image', 'max:2048'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'time_slot' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('trainings', 'public');
        }
        Training::create($data);
        return redirect()->route('admin.trainings.index')->with('success', 'Training created successfully.');
    }

    public function edit(Training $training)
    {
        $training->load('category');
        $categories = TrainingCategory::orderBy('sort_order')->get();
        return view('admin.trainings.edit', compact('training', 'categories'));
    }

    public function update(Request $request, Training $training)
    {
        $data = $request->validate([
            'training_category_id' => ['nullable', 'exists:training_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:trainings,slug,' . $training->id],
            'description' => ['nullable', 'string'],
            'objectives' => ['nullable', 'string'],
            'outline' => ['nullable', 'string'],
            'target_audience' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'location' => ['nullable', 'string', 'max:255'],
            'registration_link' => ['nullable', 'url', 'max:500'],
            'image' => ['nullable', 'image', 'max:2048'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'time_slot' => ['nullable', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            if ($training->image) {
                Storage::disk('public')->delete($training->image);
            }
            $data['image'] = $request->file('image')->store('trainings', 'public');
        }
        $training->update($data);
        return redirect()->route('admin.trainings.index')->with('success', 'Training updated successfully.');
    }

    public function destroy(Training $training)
    {
        if ($training->image) {
            Storage::disk('public')->delete($training->image);
        }
        $training->delete();
        return redirect()->route('admin.trainings.index')->with('success', 'Training deleted successfully.');
    }
}
