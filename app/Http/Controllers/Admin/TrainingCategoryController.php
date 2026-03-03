<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
    public function index()
    {
        $categories = TrainingCategory::withCount('trainings')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);
        return view('admin.training-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.training-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:training_categories,slug'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        TrainingCategory::create($data);
        return redirect()->route('admin.training-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(TrainingCategory $trainingCategory)
    {
        $trainingCategory->loadCount('trainings');
        return view('admin.training-categories.edit', compact('trainingCategory'));
    }

    public function update(Request $request, TrainingCategory $trainingCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:training_categories,slug,' . $trainingCategory->id],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $trainingCategory->update($data);
        return redirect()->route('admin.training-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(TrainingCategory $trainingCategory)
    {
        if ($trainingCategory->trainings()->count() > 0) {
            return back()->with('error', 'Cannot delete category with existing trainings.');
        }
        $trainingCategory->delete();
        return redirect()->route('admin.training-categories.index')->with('success', 'Category deleted successfully.');
    }
}
