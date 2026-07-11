<x-admin-layout>
    <div class="bg-primary-100 py-12 dark:bg-gray-700">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto flex justify-center">
            <div class="w-full pb-24">
                <div class="mb-12 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-2xl font-semibold text-primary-700 dark:text-white">{{ __('admin.about_edit_title') }}</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.about_edit_description') }}</p>
                    </div>
                    <a href="{{ route('about') }}" target="_blank" class="secondary-btn">{{ __('admin.about_view_page') }}</a>
                </div>

                @if ($errors->any())
                    <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                        <p class="font-semibold">{{ __('admin.about_fix_errors') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.about.update', $about->id) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    @foreach ($fieldGroups as $group)
                        <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400/20">
                            <div class="mb-6 border-b border-primary-200 pb-4 dark:border-gray-400">
                                <h2 class="text-lg font-semibold text-primary-700 dark:text-white">{{ __($group['title_key']) }}</h2>
                            </div>

                            <div class="space-y-6">
                                @foreach ($group['fields'] as $field)
                                    <div class="grid gap-6 lg:grid-cols-2">
                                        <div>
                                            <label for="content_en_{{ $field['key'] }}" class="form-label">{{ __($field['label_key']) }} ({{ __('admin.english') }})</label>
                                            <div class="mt-2">
                                                @if ($field['type'] === 'textarea')
                                                    <textarea
                                                        id="content_en_{{ $field['key'] }}"
                                                        name="content_en[{{ $field['key'] }}]"
                                                        rows="4"
                                                        class="form-input"
                                                    >{{ old("content_en.{$field['key']}", $about->content_en[$field['key']] ?? '') }}</textarea>
                                                @else
                                                    <input
                                                        id="content_en_{{ $field['key'] }}"
                                                        type="text"
                                                        name="content_en[{{ $field['key'] }}]"
                                                        value="{{ old("content_en.{$field['key']}", $about->content_en[$field['key']] ?? '') }}"
                                                        class="form-input"
                                                    />
                                                @endif
                                            </div>
                                            @error("content_en.{$field['key']}")
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-right">
                                            <label for="content_ar_{{ $field['key'] }}" class="form-label">{{ __($field['label_key']) }} ({{ __('admin.arabic') }})</label>
                                            <div class="mt-2">
                                                @if ($field['type'] === 'textarea')
                                                    <textarea
                                                        id="content_ar_{{ $field['key'] }}"
                                                        name="content_ar[{{ $field['key'] }}]"
                                                        rows="4"
                                                        class="form-input text-right placeholder:text-right"
                                                        style="direction: rtl;"
                                                    >{{ old("content_ar.{$field['key']}", $about->content_ar[$field['key']] ?? '') }}</textarea>
                                                @else
                                                    <input
                                                        id="content_ar_{{ $field['key'] }}"
                                                        type="text"
                                                        name="content_ar[{{ $field['key'] }}]"
                                                        value="{{ old("content_ar.{$field['key']}", $about->content_ar[$field['key']] ?? '') }}"
                                                        class="form-input text-right placeholder:text-right"
                                                        style="direction: rtl;"
                                                    />
                                                @endif
                                            </div>
                                            @error("content_ar.{$field['key']}")
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endforeach

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="secondary-btn">{{ __('Cancel') }}</a>
                        <button type="submit" class="primary-btn">{{ __('admin.about_save_page') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
