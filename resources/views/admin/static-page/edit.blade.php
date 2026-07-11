<x-admin-layout>
    <div class="bg-primary-100 py-12 dark:bg-gray-700">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto flex justify-center">
            <div class="w-full pb-24">
                <div class="mb-12 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-2xl font-semibold text-primary-700 dark:text-white">{{ __('admin.static_page_edit_title') }}</p>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.static_page_edit_description') }}</p>
                    </div>
                    <a href="{{ route('static-pages.show', $page->slug) }}" target="_blank" class="secondary-btn">{{ __('admin.view_page') }}</a>
                </div>

                <form method="POST" action="{{ route('admin.static-pages.update', $page) }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400/20">
                        <div class="mb-6 border-b border-primary-200 pb-4 dark:border-gray-400">
                            <h2 class="text-lg font-semibold text-primary-700 dark:text-white">{{ __('admin.page_information') }}</h2>
                        </div>

                        <div class="grid gap-6 lg:grid-cols-2">
                            <div>
                                <label for="title_en" class="form-label">{{ __('admin.title') }} ({{ __('admin.english') }})</label>
                                <div class="mt-2">
                                    <input id="title_en" type="text" name="title_en" value="{{ old('title_en', $page->title_en) }}" class="form-input" />
                                </div>
                                @error('title_en')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="text-right">
                                <label for="title_ar" class="form-label">{{ __('admin.title') }} ({{ __('admin.arabic') }})</label>
                                <div class="mt-2">
                                    <input id="title_ar" type="text" name="title_ar" value="{{ old('title_ar', $page->title_ar) }}" class="form-input text-right placeholder:text-right" style="direction: rtl;" />
                                </div>
                                @error('title_ar')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="slug" class="form-label">{{ __('admin.slug') }}</label>
                                <div class="mt-2">
                                    <input id="slug" type="text" value="{{ $page->slug }}" class="form-input bg-gray-100 dark:bg-gray-500" disabled />
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400/20">
                        <div class="mb-6 border-b border-primary-200 pb-4 dark:border-gray-400">
                            <h2 class="text-lg font-semibold text-primary-700 dark:text-white">{{ __('admin.page_content') }}</h2>
                        </div>

                        <div class="grid gap-6 lg:grid-cols-2">
                            <div>
                                <label for="content_en" class="form-label">{{ __('admin.content') }} ({{ __('admin.english') }})</label>
                                <div class="mt-2">
                                    <textarea id="content_en" name="content_en" rows="14" class="form-input">{{ old('content_en', $page->content_en) }}</textarea>
                                </div>
                                @error('content_en')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="text-right">
                                <label for="content_ar" class="form-label">{{ __('admin.content') }} ({{ __('admin.arabic') }})</label>
                                <div class="mt-2">
                                    <textarea id="content_ar" name="content_ar" rows="14" class="form-input text-right placeholder:text-right" style="direction: rtl;">{{ old('content_ar', $page->content_ar) }}</textarea>
                                </div>
                                @error('content_ar')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.static-pages.index') }}" class="secondary-btn">{{ __('Cancel') }}</a>
                        <button type="submit" class="primary-btn">{{ __('admin.save_page') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
