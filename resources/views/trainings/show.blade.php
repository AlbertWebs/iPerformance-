@extends('layout')
@section('title', $meta_title ?? $training->title)
@section('content')
<div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
    <a href="{{ route('trainings.index') }}" class="text-sm font-medium text-primary hover:text-primary-hover">← Training Calendar</a>
    <article class="mt-8">
        @if($training->image)
            <img src="{{ asset('storage/'.$training->image) }}" alt="{{ $training->title }}" class="w-full rounded-xl object-cover h-64 lg:h-80">
        @endif
        <span class="mt-6 inline-block text-sm font-medium text-primary">{{ $training->category?->name ?? 'Training' }}</span>
        <h1 class="mt-2 text-3xl font-bold text-slate-900">{{ $training->title }}</h1>
        <div class="mt-4 flex flex-wrap gap-4 text-sm text-slate-600">
            <span>{{ $training->start_date->format('F j') }} – {{ $training->end_date->format('F j, Y') }}</span>
            @if($training->location)
                <span>{{ $training->location }}</span>
            @endif
            @if($training->time_slot)
                <span>{{ $training->time_slot }}</span>
            @endif
            @if($training->price)
                <span>Price: {{ number_format($training->price, 0) }}</span>
            @endif
        </div>
        @if($training->description)
            <div class="mt-8 prose prose-slate max-w-none">
                <h2 class="text-xl font-semibold text-slate-900">Overview</h2>
                <div class="mt-2 text-slate-600">{!! nl2br(e($training->description)) !!}</div>
            </div>
        @endif
        @if($training->objectives)
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-slate-900">Objectives</h2>
                <div class="mt-2 text-slate-600">{!! nl2br(e($training->objectives)) !!}</div>
            </div>
        @endif
        @if($training->outline)
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-slate-900">Course Outline</h2>
                <div class="mt-2 text-slate-600">{!! nl2br(e($training->outline)) !!}</div>
            </div>
        @endif
        @if($training->target_audience)
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-slate-900">Target Audience</h2>
                <div class="mt-2 text-slate-600">{!! nl2br(e($training->target_audience)) !!}</div>
            </div>
        @endif
        <div class="mt-10 flex flex-wrap items-center gap-3">
            @auth
                @if($training->price && $training->price > 0)
                    <button type="button" class="book-btn inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-3 font-medium text-white transition hover:bg-primary-hover" data-type="training" data-id="{{ $training->id }}" data-title="{{ e($training->title) }}" data-amount="{{ (float) $training->price }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Pay with M-Pesa
                    </button>
                @endif
            @endauth
            @php
                $trainingRegHref = ($training->registration_link && \Illuminate\Support\Str::startsWith($training->registration_link, 'http')) ? $training->registration_link : route('register');
                $trainingRegExt = \Illuminate\Support\Str::startsWith($trainingRegHref, 'http') && (parse_url($trainingRegHref, PHP_URL_HOST) !== request()->getHost());
            @endphp
            <a href="{{ $trainingRegHref }}" class="inline-flex rounded-xl border border-slate-300 px-6 py-3 font-medium text-slate-700 transition hover:bg-slate-50" @if($trainingRegExt) target="_blank" rel="noopener" @endif>Register for this training</a>
            @guest
                @if($training->price && $training->price > 0)
                    <a href="{{ route('login') }}?redirect={{ urlencode(request()->url()) }}" class="inline-flex text-sm text-primary hover:text-primary-hover">Log in to pay online</a>
                @endif
            @endguest
        </div>
    </article>
</div>

@auth
@if($training->price && $training->price > 0)
{{-- Book course modal: same two-step M-Pesa flow as portal --}}
<div id="book-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-modal="true" aria-labelledby="book-modal-title">
    <div class="flex min-h-full items-center justify-center p-4">
        <div id="book-modal-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
        <div class="relative w-full max-w-md rounded-2xl border border-slate-200 bg-white shadow-2xl">
            <div class="p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <h2 id="book-modal-title" class="text-xl font-bold text-slate-900">Pay for course</h2>
                    <button type="button" id="book-modal-close" class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600" aria-label="Close">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div id="book-step1">
                    <div class="mt-3 flex gap-2">
                        <span class="h-1 flex-1 rounded-full bg-primary"></span>
                        <span class="h-1 flex-1 rounded-full bg-slate-200"></span>
                    </div>
                    <p class="mt-4 text-sm text-slate-600">Confirm your details and M-Pesa number for payment.</p>
                    <div class="mt-5 space-y-5">
                        <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4">
                            <span class="text-xs font-medium uppercase tracking-wider text-slate-500">Course</span>
                            <p id="book-course-title" class="mt-1 font-medium text-slate-900"></p>
                            <p id="book-course-amount" class="mt-0.5 text-lg font-bold text-primary"></p>
                        </div>
                        <div>
                            <label for="book-mpesa-phone" class="block text-sm font-medium text-slate-700">M-Pesa phone number</label>
                            <input type="tel" id="book-mpesa-phone" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20" placeholder="07XX XXX XXX" value="{{ old('phone', auth()->user()->phone) }}">
                            <p class="mt-1.5 text-xs text-slate-500">Number that will receive the M-Pesa prompt (254 or 0...)</p>
                            <p id="book-step1-error" class="mt-1.5 hidden text-sm text-red-600"></p>
                        </div>
                    </div>
                    <div class="mt-8 flex gap-3">
                        <button type="button" id="book-cancel" class="flex-1 rounded-xl border border-slate-300 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Cancel</button>
                        <button type="button" id="book-step1-submit" class="flex-1 rounded-xl bg-primary py-3 text-sm font-semibold text-white transition hover:bg-primary-hover">Continue to payment</button>
                    </div>
                </div>
                <div id="book-step2" class="hidden">
                    <div class="mt-3 flex gap-2">
                        <span class="h-1 flex-1 rounded-full bg-primary"></span>
                        <span class="h-1 flex-1 rounded-full bg-primary"></span>
                    </div>
                    <p class="mt-4 text-sm text-slate-600">You will receive an M-Pesa prompt on your phone. Enter your PIN to complete payment.</p>
                    <div class="mt-5 rounded-xl border border-primary/20 bg-primary/5 p-4">
                        <p id="book-step2-summary" class="text-sm font-medium text-slate-900"></p>
                        <p class="mt-1 text-sm text-slate-600">Click below to send the prompt to your phone.</p>
                    </div>
                    <p id="book-step2-error" class="mt-3 hidden rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700"></p>
                    <p id="book-step2-wait" class="mt-3 hidden flex items-center gap-2 rounded-lg bg-primary/10 px-3 py-2.5 text-sm font-medium text-primary">
                        <svg class="h-5 w-5 shrink-0 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                        Waiting for payment… Complete the prompt on your phone.
                    </p>
                    <div class="mt-8 flex gap-3">
                        <button type="button" id="book-back" class="flex-1 rounded-xl border border-slate-300 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">Back</button>
                        <button type="button" id="book-pay-btn" class="flex-1 rounded-xl bg-primary py-3 text-sm font-semibold text-white transition hover:bg-primary-hover">Pay with M-Pesa</button>
                    </div>
                </div>
                <div id="book-success" class="hidden text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 ring-4 ring-emerald-50">
                        <svg class="h-9 w-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-slate-900">Booking successful</h3>
                    <p id="book-success-message" class="mt-2 text-sm text-slate-600"></p>
                    <p id="book-success-ref" class="mt-1 text-xs font-medium text-slate-500"></p>
                    <button type="button" id="book-close-success" class="mt-8 w-full rounded-xl bg-primary py-3 text-sm font-semibold text-white transition hover:bg-primary-hover">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('book-modal');
    var backdrop = document.getElementById('book-modal-backdrop');
    var step1 = document.getElementById('book-step1');
    var step2 = document.getElementById('book-step2');
    var successEl = document.getElementById('book-success');
    var courseTitleEl = document.getElementById('book-course-title');
    var courseAmountEl = document.getElementById('book-course-amount');
    var phoneInput = document.getElementById('book-mpesa-phone');
    var step1Error = document.getElementById('book-step1-error');
    var step2Error = document.getElementById('book-step2-error');
    var step2Wait = document.getElementById('book-step2-wait');
    var step2Summary = document.getElementById('book-step2-summary');
    var payBtn = document.getElementById('book-pay-btn');
    var successMessage = document.getElementById('book-success-message');
    var successRef = document.getElementById('book-success-ref');
    var csrf = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var storeUrl = '{{ route("portal.bookings.store") }}';
    var bookingId = null, bookType = null, bookId = null, bookTitle = null, bookAmount = null, pollTimer = null;
    function openModal(type, id, title, amount) {
        bookType = type; bookId = id; bookTitle = title; bookAmount = amount; bookingId = null;
        courseTitleEl.textContent = title;
        courseAmountEl.textContent = 'KES ' + Number(amount).toLocaleString();
        step1.classList.remove('hidden'); step2.classList.add('hidden'); successEl.classList.add('hidden');
        step1Error.classList.add('hidden'); step2Error.classList.add('hidden'); step2Wait.classList.add('hidden');
        step2Summary.textContent = '';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        if (pollTimer) clearInterval(pollTimer);
        pollTimer = null;
    }
    document.querySelectorAll('.book-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            openModal(this.getAttribute('data-type'), parseInt(this.getAttribute('data-id'), 10), this.getAttribute('data-title'), parseFloat(this.getAttribute('data-amount')));
        });
    });
    backdrop.addEventListener('click', closeModal);
    document.getElementById('book-cancel').addEventListener('click', closeModal);
    document.getElementById('book-modal-close').addEventListener('click', closeModal);
    document.getElementById('book-close-success').addEventListener('click', function() { closeModal(); window.location.reload(); });
    document.getElementById('book-back').addEventListener('click', function() {
        step2.classList.add('hidden'); step1.classList.remove('hidden'); step2Error.classList.add('hidden'); step2Wait.classList.add('hidden');
        payBtn.disabled = false; payBtn.textContent = 'Pay with M-Pesa';
    });
    document.getElementById('book-step1-submit').addEventListener('click', function() {
        var phone = (phoneInput.value || '').trim();
        step1Error.classList.add('hidden');
        if (!phone) { step1Error.textContent = 'Please enter your M-Pesa phone number.'; step1Error.classList.remove('hidden'); return; }
        var btn = this; btn.disabled = true; btn.textContent = 'Please wait…';
        fetch(storeUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({ type: bookType, id: bookId, mpesa_phone: phone })
        }).then(function(r) { return r.json().then(function(d) { return { ok: r.ok, data: d }; }); })
        .then(function(res) {
            btn.disabled = false; btn.textContent = 'Continue to payment';
            if (res.ok && res.data.booking_id) {
                bookingId = res.data.booking_id;
                step2Summary.textContent = (res.data.course_title || bookTitle) + ' — KES ' + Number(res.data.amount).toLocaleString();
                step1.classList.add('hidden'); step2.classList.remove('hidden');
            } else {
                step1Error.textContent = res.data.message || 'Something went wrong. Please try again.';
                step1Error.classList.remove('hidden');
            }
        }).catch(function() {
            btn.disabled = false; btn.textContent = 'Continue to payment';
            step1Error.textContent = 'Network error. Please try again.'; step1Error.classList.remove('hidden');
        });
    });
    payBtn.addEventListener('click', function() {
        if (!bookingId) return;
        step2Error.classList.add('hidden'); payBtn.disabled = true; payBtn.textContent = 'Sending…';
        fetch('/portal/bookings/' + bookingId + '/pay', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({})
        }).then(function(r) { return r.json().then(function(d) { return { ok: r.ok, status: r.status, data: d }; }); })
        .then(function(res) {
            if (res.ok && res.data.checkout_request_id) {
                step2Wait.classList.remove('hidden');
                if (pollTimer) clearInterval(pollTimer);
                pollTimer = setInterval(function() {
                    fetch('/portal/bookings/' + bookingId + '/status', { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (data.status === 'paid') {
                            clearInterval(pollTimer); pollTimer = null; step2Wait.classList.add('hidden');
                            step2.classList.add('hidden'); successEl.classList.remove('hidden');
                            successMessage.textContent = (data.course_title || bookTitle) + ' — Booking confirmed.';
                            successRef.textContent = data.mpesa_reference ? 'M-Pesa ref: ' + data.mpesa_reference : '';
                        } else if (data.status === 'failed') {
                            clearInterval(pollTimer); pollTimer = null; step2Wait.classList.add('hidden');
                            step2Error.textContent = 'Payment was not completed. You can try again.'; step2Error.classList.remove('hidden');
                            payBtn.disabled = false; payBtn.textContent = 'Pay with M-Pesa';
                        }
                    });
                }, 2500);
            } else if (res.status === 200 && res.data.status === 'paid') {
                step2Wait.classList.add('hidden');
                step2.classList.add('hidden'); successEl.classList.remove('hidden');
                successMessage.textContent = (res.data.course_title || bookTitle) + ' — Booking confirmed.';
                successRef.textContent = res.data.mpesa_reference ? 'M-Pesa ref: ' + res.data.mpesa_reference : '';
            } else {
                step2Error.textContent = res.data.message || 'Could not send payment request. Try again.'; step2Error.classList.remove('hidden');
                payBtn.disabled = false; payBtn.textContent = 'Pay with M-Pesa';
            }
        }).catch(function() {
            step2Error.textContent = 'Network error. Please try again.'; step2Error.classList.remove('hidden');
            payBtn.disabled = false; payBtn.textContent = 'Pay with M-Pesa';
        });
    });
});
</script>
@endif
@endauth
@endsection
