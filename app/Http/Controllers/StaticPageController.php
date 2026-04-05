<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaticPageController extends Controller
{
    public function index(): View
    {
        StaticPage::ensureDefaults();
        $pages = StaticPage::query()->orderBy('id')->paginate(15);

        return view('admin.static-page.index', compact('pages'));
    }

    public function edit(StaticPage $page): View
    {
        StaticPage::ensureDefaults();

        return view('admin.static-page.edit', compact('page'));
    }

    public function update(Request $request, StaticPage $page): RedirectResponse
    {
        $validated = $request->validate([
            'title_en' => ['required', 'string', 'max:255'],
            'title_ar' => ['required', 'string', 'max:255'],
            'content_en' => ['nullable', 'string'],
            'content_ar' => ['nullable', 'string'],
        ]);

        $page->update($validated);

        return redirect()->route('admin.static-pages.edit', $page)->with('success', __('admin.static_page_updated'));
    }

    public function show(string $slug): View
    {
        StaticPage::ensureDefaults();
        $page = StaticPage::query()->where('slug', $slug)->firstOrFail();

        return view('client.static-page', compact('page'));
    }
}
