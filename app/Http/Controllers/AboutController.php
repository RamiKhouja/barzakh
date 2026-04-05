<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = $this->resolveAbout();

        return view('client.about', compact('about'));
    }

    public function edit()
    {
        $about = $this->resolveAbout();
        $fieldGroups = About::fieldDefinitions();

        return view('admin.about.edit', compact('about', 'fieldGroups'));
    }

    public function update(Request $request, About $about)
    {
        $rules = [
            'content_en' => ['required', 'array'],
            'content_ar' => ['required', 'array'],
        ];

        foreach (About::contentKeys() as $key) {
            $rules["content_en.{$key}"] = ['nullable', 'string'];
            $rules["content_ar.{$key}"] = ['nullable', 'string'];
        }

        $validated = $request->validate($rules);

        $about->update([
            'content_en' => $this->normalizeContent($validated['content_en'] ?? [], 'en'),
            'content_ar' => $this->normalizeContent($validated['content_ar'] ?? [], 'ar'),
        ]);

        return redirect()->route('admin.about.edit')->with('success', 'About page updated successfully.');
    }

    private function resolveAbout(): About
    {
        return About::query()->first() ?? About::query()->create(About::defaultAttributes());
    }

    private function normalizeContent(array $content, string $locale): array
    {
        $defaults = About::defaultContentFor($locale);

        foreach (About::contentKeys() as $key) {
            $defaults[$key] = trim((string) ($content[$key] ?? ''));
        }

        return $defaults;
    }
}
