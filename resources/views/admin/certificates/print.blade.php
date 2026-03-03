<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate {{ $certificate->certificate_number }} – Print</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none !important; }
            .certificate-page { box-shadow: none !important; border: 1px solid #cbd5e1 !important; }
        }
        .certificate-page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm;
            background: #fff;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body class="bg-slate-200 py-8">
    <div class="no-print mb-6 flex flex-wrap justify-center gap-3">
        <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">← Back to list</a>
        <a href="{{ route('admin.certificates.edit', $certificate) }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">Edit</a>
        <button type="button" onclick="window.print()" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-hover">Print certificate</button>
    </div>

    <div class="certificate-page border border-slate-200 bg-white">
        <div class="flex flex-col items-center text-center">
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">iPerformance <span class="text-primary">Africa</span></h1>
            <p class="mt-1 text-sm text-slate-600">HR Consulting & Certification</p>
        </div>
        <div class="mt-12 border-t-2 border-b-2 border-primary/30 py-8">
            <p class="text-center text-sm font-medium uppercase tracking-widest text-slate-500">Certificate of Completion</p>
            <p class="mt-4 text-center text-2xl font-bold text-slate-900 sm:text-3xl">This is to certify that</p>
            <p class="mt-4 text-center text-3xl font-bold text-primary sm:text-4xl">{{ $certificate->name }}</p>
            <p class="mt-6 text-center text-lg text-slate-700">has successfully completed</p>
            <p class="mt-2 text-center text-xl font-semibold text-slate-900">{{ $certificate->course }}</p>
            <p class="mt-8 text-center text-sm text-slate-600">Issued on {{ $certificate->date_issued->format('F j, Y') }}</p>
        </div>
        <div class="mt-10 flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 pt-6">
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Certificate number</p>
                <p class="mt-0.5 font-mono text-lg font-semibold text-slate-900">{{ $certificate->certificate_number }}</p>
            </div>
            <p class="text-xs text-slate-500">Verify at {{ route('verify') }}</p>
        </div>
    </div>
</body>
</html>
