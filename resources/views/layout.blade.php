<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home') | iPerformance Africa</title>
    @if(isset($meta_title) && $meta_title)
        <meta name="title" content="{{ $meta_title }}">
        <meta property="og:title" content="{{ $meta_title }}">
    @endif
    @if(isset($meta_description) && $meta_description)
        <meta name="description" content="{{ $meta_description }}">
        <meta property="og:description" content="{{ $meta_description }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
</head>
<body class="font-sans antialiased text-slate-800 bg-white min-h-screen flex flex-col">
    <header class="sticky top-0 z-50 bg-slate-100/80 border-b border-slate-200 py-3 lg:py-4">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg border border-slate-200 bg-white shadow-sm px-4 sm:px-6 lg:px-8">
                <div class="flex h-14 lg:h-16 items-center justify-between">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-slate-900">iPerformance <span class="text-primary">Africa</span></a>
                    <nav class="hidden md:flex items-center gap-2 lg:gap-3">
                        @php
                            $navLinkClass = 'rounded-lg border px-3 py-2 text-sm font-medium transition ';
                            $navLinkInactive = 'border-slate-200/80 text-slate-800 hover:border-primary/30 hover:bg-slate-50 hover:text-primary';
                            $navLinkActive = 'border-primary/50 bg-primary/10 text-primary font-semibold';
                        @endphp
                        <a href="{{ route('home') }}" class="{{ $navLinkClass }} {{ request()->routeIs('home') ? $navLinkActive : $navLinkInactive }}">Home</a>
                        <a href="{{ route('workshops.index') }}" class="{{ $navLinkClass }} {{ request()->routeIs('workshops.*') ? $navLinkActive : $navLinkInactive }}">Workshops</a>
                        <a href="{{ route('trainings.index') }}" class="{{ $navLinkClass }} {{ request()->routeIs('trainings.*') ? $navLinkActive : $navLinkInactive }}">Training</a>
                        <a href="{{ route('certifications.index') }}" class="{{ $navLinkClass }} {{ request()->routeIs('certifications.*') ? $navLinkActive : $navLinkInactive }}">Certifications</a>
                        <a href="{{ route('verify') }}" class="{{ $navLinkClass }} {{ request()->routeIs('verify') ? $navLinkActive : $navLinkInactive }}">Verify</a>
                        @auth
                            <a href="{{ route('portal.dashboard') }}" class="{{ $navLinkClass }} {{ request()->routeIs('portal.*') ? $navLinkActive : $navLinkInactive }}">Portal</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="rounded-lg border border-slate-200/80 px-3 py-2 text-sm font-medium text-slate-800 transition hover:border-primary/30 hover:bg-slate-50 hover:text-primary">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="{{ $navLinkClass }} {{ request()->routeIs('login') ? $navLinkActive : $navLinkInactive }}">Sign in</a>
                        @endauth
                        <a href="{{ route('contact') }}" class="rounded-lg border px-4 py-2 text-sm font-medium transition {{ request()->routeIs('contact') ? 'border-primary bg-primary text-white hover:bg-primary-hover' : 'border-primary/90 bg-primary text-white hover:bg-primary-hover hover:border-primary' }}">Contact Us</a>
                    </nav>
                    <button type="button" class="md:hidden rounded-lg p-2 text-slate-800 hover:bg-slate-100" id="mobile-menu-btn" aria-label="Menu">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden md:hidden mx-auto max-w-7xl px-4 mt-2 rounded-lg border border-slate-200 bg-white shadow-sm" id="mobile-menu">
            @php
                $mobileLinkClass = 'rounded-lg border border-slate-200/80 px-4 py-2.5 transition hover:border-primary/30 hover:bg-slate-50 hover:text-primary ';
                $mobileActive = 'border-primary/50 bg-primary/10 text-primary font-semibold';
                $mobileInactive = 'text-slate-800';
            @endphp
            <div class="flex flex-col gap-1.5 py-2 px-1">
                <a href="{{ route('home') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('home') ? $mobileActive : $mobileInactive }}">Home</a>
                <a href="{{ route('workshops.index') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('workshops.*') ? $mobileActive : $mobileInactive }}">Workshops</a>
                <a href="{{ route('trainings.index') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('trainings.*') ? $mobileActive : $mobileInactive }}">Training</a>
                <a href="{{ route('certifications.index') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('certifications.*') ? $mobileActive : $mobileInactive }}">Certifications</a>
                <a href="{{ route('verify') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('verify') ? $mobileActive : $mobileInactive }}">Verify</a>
                @auth
                    <a href="{{ route('portal.dashboard') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('portal.*') ? $mobileActive : $mobileInactive }}">Portal</a>
                    <form method="POST" action="{{ route('logout') }}" class="rounded-lg border border-slate-200/80">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2.5 text-left text-sm text-slate-800 transition hover:bg-slate-50 hover:text-primary">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="{{ $mobileLinkClass }} {{ request()->routeIs('login') ? $mobileActive : $mobileInactive }}">Sign in</a>
                @endauth
                <a href="{{ route('contact') }}" class="rounded-lg border px-4 py-2.5 text-center font-medium transition {{ request()->routeIs('contact') ? 'border-primary bg-primary text-white' : 'border-primary/90 bg-primary text-white hover:bg-primary-hover' }}">Contact Us</a>
            </div>
        </div>
    </header>

    <main class="flex-1">
        @if(session('success'))
            <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">
                <div class="rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
            </div>
        @endif
        @yield('content')
    </main>

    @php
        $siteContact = config('site.contact', []);
        $siteSocial = config('site.social', []);
    @endphp
    <footer class="mt-auto border-t border-slate-200 bg-slate-900 text-slate-300">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-12 lg:gap-x-12 lg:gap-y-10">
                {{-- Brand --}}
                <div class="lg:col-span-5">
                    <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-white">iPerformance <span class="text-primary">Africa</span></a>
                    <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate-400">HR consulting, training, and certification for organizations across Africa. Building excellence through people.</p>
                </div>
                {{-- Quick Links --}}
                <div class="lg:col-span-3">
                    <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-white underline decoration-primary/60 decoration-2 underline-offset-4">Quick Links</h3>
                    <ul class="mt-6 space-y-3">
                        <li><a href="{{ route('workshops.index') }}" class="text-sm text-slate-400 transition hover:text-primary">Workshops</a></li>
                        <li><a href="{{ route('trainings.index') }}" class="text-sm text-slate-400 transition hover:text-primary">Training</a></li>
                        <li><a href="{{ route('certifications.index') }}" class="text-sm text-slate-400 transition hover:text-primary">Certifications</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-sm text-slate-400 transition hover:text-primary">Services</a></li>
                        <li><a href="{{ route('reviews.index') }}" class="text-sm text-slate-400 transition hover:text-primary">Reviews</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-slate-400 transition hover:text-primary">Contact</a></li>
                        <li><a href="{{ route('verify') }}" class="text-sm text-slate-400 transition hover:text-primary">Verify Certificate</a></li>
                    </ul>
                </div>
                {{-- Connect: contact details + social --}}
                <div class="lg:col-span-4">
                    <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-white underline decoration-primary/60 decoration-2 underline-offset-4">Connect</h3>
                    <div class="mt-6 space-y-4">
                        @if(!empty($siteContact['email']))
                            <a href="mailto:{{ $siteContact['email'] }}" class="flex items-start gap-3 text-sm text-slate-400 transition hover:text-primary">
                                <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </span>
                                <span class="break-all">{{ $siteContact['email'] }}</span>
                            </a>
                        @endif
                        @if(!empty($siteContact['phone']))
                            <a href="tel:{{ preg_replace('/\s+/', '', $siteContact['phone']) }}" class="flex items-start gap-3 text-sm text-slate-400 transition hover:text-primary">
                                <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </span>
                                <span>{{ $siteContact['phone'] }}</span>
                            </a>
                        @endif
                        @if(!empty($siteContact['address']) || !empty($siteContact['address_line2']))
                            <div class="flex items-start gap-3 text-sm text-slate-400">
                                <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </span>
                                <span>
                                    @if(!empty($siteContact['address'])){{ $siteContact['address'] }}@endif
                                    @if(!empty($siteContact['address_line2']))<br>{{ $siteContact['address_line2'] }}@endif
                                </span>
                            </div>
                        @endif
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary transition hover:underline mt-2">Get in touch <span aria-hidden="true">→</span></a>
                    </div>
                    @if(count(array_filter($siteSocial)) > 0)
                        <div class="mt-6 flex flex-wrap gap-2">
                            @if(!empty($siteSocial['facebook']))
                                <a href="{{ $siteSocial['facebook'] }}" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400 transition hover:bg-primary hover:text-white" aria-label="Facebook">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                            @endif
                            @if(!empty($siteSocial['twitter']))
                                <a href="{{ $siteSocial['twitter'] }}" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400 transition hover:bg-primary hover:text-white" aria-label="Twitter">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            @endif
                            @if(!empty($siteSocial['linkedin']))
                                <a href="{{ $siteSocial['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400 transition hover:bg-primary hover:text-white" aria-label="LinkedIn">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </a>
                            @endif
                            @if(!empty($siteSocial['instagram']))
                                <a href="{{ $siteSocial['instagram'] }}" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400 transition hover:bg-primary hover:text-white" aria-label="Instagram">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.218 4.771 1.091 6.352 2.672 1.581 1.582 2.454 3.1 2.672 6.352.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.218 3.252-1.091 4.771-2.672 6.352-1.582 1.581-3.1 2.454-6.352 2.672-1.265.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.256-.218-4.771-1.091-6.352-2.672-1.582-1.582-2.454-3.1-2.672-6.352-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.218-3.256 1.091-4.771 2.672-6.352 1.582-1.581 3.1-2.454 6.352-2.672 1.265-.058 1.644-.07 4.849-.07zm0-2.163c-3.259 0-3.667.014-4.947.066-4.358.2-6.78 2.618-6.98 6.98-.052 1.281-.065 1.689-.065 4.947 0 3.259.014 3.668.066 4.947.2 4.358 2.618 6.78 6.98 6.98 1.281.052 1.689.065 4.947.065 3.259 0 3.668-.014 4.947-.066 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.066-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.947-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                            @endif
                            @if(!empty($siteSocial['youtube']))
                                <a href="{{ $siteSocial['youtube'] }}" target="_blank" rel="noopener noreferrer" class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-700/50 text-slate-400 transition hover:bg-primary hover:text-white" aria-label="YouTube">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-14 border-t border-slate-700/80 pt-8 flex flex-col items-center justify-between gap-4 sm:flex-row sm:gap-0">
                <p class="text-xs tracking-wide text-slate-500">&copy; {{ date('Y') }} iPerformance Africa. All rights reserved.</p>
                <a href="{{ route('contact') }}" class="text-xs text-slate-500 transition hover:text-primary">Privacy & contact</a>
            </div>
        </div>
    </footer>

    {{-- Go to top button (bottom right) --}}
    <button type="button" id="go-to-top" aria-label="Scroll to top" class="go-to-top-btn fixed bottom-6 right-6 z-40 flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white shadow-lg transition-all duration-300 hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 opacity-0 pointer-events-none">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>
    <style>
        .go-to-top-btn.is-visible { opacity: 1; pointer-events: auto; }
    </style>

    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        (function() {
            var btn = document.getElementById('go-to-top');
            if (!btn) return;
            function updateVisibility() {
                btn.classList.toggle('is-visible', window.scrollY > 300);
            }
            window.addEventListener('scroll', updateVisibility, { passive: true });
            updateVisibility();
            btn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        })();
    </script>
</body>
</html>
