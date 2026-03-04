<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalPageController extends Controller
{
    public function edit(): View
    {
        $legal = LegalPage::current();
        return view('admin.legal.edit', compact('legal'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'terms_content' => ['nullable', 'string'],
            'privacy_content' => ['nullable', 'string'],
        ]);

        $legal = LegalPage::first();
        if (! $legal) {
            $legal = new LegalPage();
        }

        $legal->fill($data);
        $legal->save();

        return redirect()->route('admin.legal.edit')->with('success', 'Terms and Privacy pages updated successfully.');
    }
}
