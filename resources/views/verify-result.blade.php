@extends('layout')
@section('title', isset($meta_title) ? $meta_title : 'Verification Result | iPerformance Africa')
@section('content')
<div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 lg:px-8">
    @if(isset($certificate))
        <div class="rounded-xl border-2 border-emerald-200 bg-emerald-50 p-8 text-center">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 text-2xl">OK</div>
            <h1 class="mt-4 text-2xl font-bold text-slate-900">Certificate Verified</h1>
            <p class="mt-2 text-slate-600">This certificate is valid in our records.</p>
            <dl class="mt-8 space-y-2 text-left max-w-sm mx-auto bg-white rounded-lg p-6 border border-emerald-100">
                <div class="flex justify-between"><dt class="text-slate-500">Certificate number</dt><dd class="font-mono font-medium">{{ $certificate->certificate_number }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Name</dt><dd class="font-medium">{{ $certificate->name }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Course</dt><dd class="font-medium">{{ $certificate->course }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Date issued</dt><dd class="font-medium">{{ $certificate->date_issued->format('F j, Y') }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-500">Status</dt><dd><span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $certificate->status === 'valid' ? 'bg-emerald-100 text-emerald-800' : ($certificate->status === 'expired' ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }}">{{ ucfirst($certificate->status) }}</span></dd></div>
            </dl>
        </div>
    @elseif(isset($notFound))
        <div class="rounded-xl border-2 border-primary/20 bg-primary/5 p-8 text-center">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary text-2xl">!</div>
            <h1 class="mt-4 text-2xl font-bold text-slate-900">Certificate Not Found</h1>
            <p class="mt-2 text-slate-600">We could not find a certificate with number: <strong>{{ $notFound }}</strong></p>
            <p class="mt-4 text-sm text-slate-500">Please check the number and try again, or contact us if you believe this is an error.</p>
        </div>
    @endif
    <div class="mt-10 text-center">
        <a href="{{ route('verify') }}" class="text-primary hover:text-primary-hover font-medium">Verify another certificate</a>
    </div>
</div>
@endsection
