<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\HeroSection;
use App\Models\PageMeta;
use App\Models\Review;
use App\Models\Service;
use App\Models\Training;
use App\Models\TrainingCategory;
use App\Models\Workshop;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected function getPageMeta(string $key): array
    {
        $meta = PageMeta::where('page_key', $key)->first();
        return [
            'meta_title' => $meta?->meta_title,
            'meta_description' => $meta?->meta_description,
        ];
    }

    public function index()
    {
        $workshops = Workshop::active()->where('status', 'upcoming')->where('date', '>=', now())->orderBy('date')->limit(3)->get();
        $trainings = Training::active()->upcoming()->orderBy('start_date')->limit(3)->get();
        $certifications = Certification::active()->featured()->orderBy('sort_order')->limit(4)->get();
        $reviews = Review::active()->orderBy('sort_order')->get();
        $services = Service::active()->orderBy('sort_order')->limit(6)->get();
        $meta = $this->getPageMeta('home');
        $meta_title = $meta['meta_title'] ?? 'HR Consulting & Certification | iPerformance Africa';
        $meta_description = $meta['meta_description'] ?? null;
        $hero = HeroSection::first();

        return view('home', compact('workshops', 'trainings', 'certifications', 'reviews', 'services', 'meta_title', 'meta_description', 'hero'));
    }

    public function workshops()
    {
        $workshops = Workshop::active()->where('status', 'upcoming')->where('date', '>=', now())->orderBy('date')->paginate(9);
        $meta = $this->getPageMeta('workshops');
        $meta_title = $meta['meta_title'] ?? null;
        $meta_description = $meta['meta_description'] ?? null;
        return view('workshops.index', compact('workshops', 'meta_title', 'meta_description'));
    }

    public function workshopsArchive()
    {
        $workshops = Workshop::active()->where(function ($q) {
            $q->where('status', 'past')->orWhere('date', '<', now());
        })->orderBy('date', 'desc')->paginate(9);
        $meta = $this->getPageMeta('workshops');
        $meta_title = $meta['meta_title'] ?? null;
        $meta_description = $meta['meta_description'] ?? null;
        return view('workshops.archive', compact('workshops', 'meta_title', 'meta_description'));
    }

    public function trainings(Request $request)
    {
        $query = Training::active()->upcoming()->with('category')->orderBy('start_date');
        if ($request->filled('category')) {
            $query->where('training_category_id', $request->category);
        }
        $trainings = $query->paginate(9);
        $categories = TrainingCategory::active()->orderBy('sort_order')->get();
        $meta = $this->getPageMeta('trainings');
        $meta_title = $meta['meta_title'] ?? null;
        $meta_description = $meta['meta_description'] ?? null;
        return view('trainings.index', compact('trainings', 'categories', 'meta_title', 'meta_description'));
    }

    public function trainingsByCategory(TrainingCategory $category)
    {
        $trainings = Training::active()->upcoming()->where('training_category_id', $category->id)->orderBy('start_date')->paginate(9);
        $categories = TrainingCategory::active()->orderBy('sort_order')->get();
        $meta = $this->getPageMeta('trainings');
        $meta_title = $meta['meta_title'] ?? null;
        $meta_description = $meta['meta_description'] ?? null;
        return view('trainings.index', compact('trainings', 'categories', 'category', 'meta_title', 'meta_description'));
    }

    public function trainingShow(Training $training)
    {
        if (! $training->is_active) {
            abort(404);
        }
        $meta = [
            'meta_title' => $training->meta_title ?: $training->title,
            'meta_description' => $training->meta_description,
        ];
        $meta_title = $meta['meta_title'] ?? $training->title;
        $meta_description = $meta['meta_description'] ?? null;
        return view('trainings.show', compact('training', 'meta_title', 'meta_description'));
    }

    public function certifications()
    {
        $certifications = Certification::active()->orderBy('sort_order')->paginate(12);
        $featured = Certification::active()->featured()->orderBy('sort_order')->get();
        $meta = $this->getPageMeta('certifications');
        $meta_title = $meta['meta_title'] ?? null;
        $meta_description = $meta['meta_description'] ?? null;
        return view('certifications.index', compact('certifications', 'featured', 'meta_title', 'meta_description'));
    }

    public function certificationShow(Certification $certification)
    {
        if (! $certification->is_active) {
            abort(404);
        }
        $meta_title = $certification->meta_title ?: $certification->title;
        $meta_description = $certification->meta_description ?? null;
        return view('certifications.show', compact('certification', 'meta_title', 'meta_description'));
    }

    public function reviews()
    {
        $reviews = Review::active()->orderBy('sort_order')->paginate(12);
        $meta = $this->getPageMeta('reviews');
        $meta_title = $meta['meta_title'] ?? null;
        $meta_description = $meta['meta_description'] ?? null;
        return view('reviews.index', compact('reviews', 'meta_title', 'meta_description'));
    }

    public function contact()
    {
        $meta = $this->getPageMeta('contact');
        $meta_title = $meta['meta_title'] ?? null;
        $meta_description = $meta['meta_description'] ?? null;
        return view('contact', compact('meta_title', 'meta_description'));
    }

    public function services()
    {
        $services = Service::active()->orderBy('sort_order')->paginate(12);
        $meta = $this->getPageMeta('services');
        $meta_title = $meta['meta_title'] ?? null;
        $meta_description = $meta['meta_description'] ?? null;
        return view('services.index', compact('services', 'meta_title', 'meta_description'));
    }

    public function serviceShow(Service $service)
    {
        if (! $service->is_active) {
            abort(404);
        }
        $meta_title = $service->meta_title ?: $service->title;
        $meta_description = $service->meta_description ?? null;
        return view('services.show', compact('service', 'meta_title', 'meta_description'));
    }
}
