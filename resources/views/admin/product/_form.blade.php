@php
    $isEdit = isset($product);
    $isRtl = app()->getLocale() === 'ar';
    $selectedCategories = old('categories', $selectedCategories ?? []);
@endphp

<x-admin-layout>
    <div class="bg-primary-100 py-12 dark:bg-gray-700">
        <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-primary-700 dark:text-white">
                    {{ $isEdit ? __('admin.edit_product') : __('admin.create_product') }}
                </h1>
                <a href="{{ route('admin.products') }}" class="secondary-btn">{{ __('Cancel') }}</a>
            </div>

            @if ($errors->any())
                <div class="mb-8 rounded-md bg-red-50 p-4 text-red-700" role="alert">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ $isEdit ? route('admin.product.update', $product) : route('admin.product.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <section class="rounded-2xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <h2 class="mb-6 text-lg font-semibold text-primary-700 dark:text-white">{{ __('admin.product_information') }}</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="form-label">{{ __('admin.product_name') }}</label>
                            <input name="name_en" value="{{ old('name_en', $product->name_en ?? '') }}" class="form-input mt-2" required>
                        </div>
                        <div class="text-right">
                            <label class="form-label">{{ __('admin.product_name_arabic') }}</label>
                            <input name="name_ar" value="{{ old('name_ar', $product->name_ar ?? '') }}" class="form-input mt-2 text-right" dir="rtl" required>
                        </div>
                        <div>
                            <label class="form-label">{{ __('admin.owner_name') }}</label>
                            <input name="owner_name" value="{{ old('owner_name', $product->owner_name ?? '') }}" class="form-input mt-2">
                        </div>
                        <div>
                            <label class="form-label">{{ __('admin.organization_name') }}</label>
                            <input name="organization_name" value="{{ old('organization_name', $product->organization_name ?? '') }}" class="form-input mt-2">
                        </div>
                        <div class="md:col-span-2">
                            <label class="form-label">{{ __('admin.categories') }}</label>
                            <select name="categories[]" multiple class="select2 form-input mt-2 w-full" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(in_array($category->id, $selectedCategories))>{{ $category->title_en }} ({{ $category->title_ar }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <h2 class="mb-6 text-lg font-semibold text-primary-700 dark:text-white">{{ __('admin.product_descriptions') }}</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="form-label">{{ __('admin.short_description_english') }}</label>
                            <textarea name="short_description_en" rows="4" class="form-input mt-2">{{ old('short_description_en', $product->short_description_en ?? '') }}</textarea>
                        </div>
                        <div class="text-right">
                            <label class="form-label">{{ __('admin.short_description_arabic') }}</label>
                            <textarea name="short_description_ar" rows="4" class="form-input mt-2 text-right" dir="rtl">{{ old('short_description_ar', $product->short_description_ar ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="form-label">{{ __('admin.description_english') }}</label>
                            <textarea name="description_en" id="description_en" class="form-input mt-2">{{ old('description_en', $product->description_en ?? '') }}</textarea>
                        </div>
                        <div class="text-right">
                            <label class="form-label">{{ __('admin.description_arabic') }}</label>
                            <textarea name="description_ar" id="description_ar" class="form-input mt-2 text-right" dir="rtl">{{ old('description_ar', $product->description_ar ?? '') }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <h2 class="mb-6 text-lg font-semibold text-primary-700 dark:text-white">{{ __('admin.product_sales') }}</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="form-label">{{ __('admin.price') }}</label>
                            <input type="number" step="0.001" min="0" name="price" value="{{ old('price', $product->price ?? '0') }}" class="form-input mt-2" required>
                        </div>
                        <div>
                            <label class="form-label">{{ __('admin.discount_price') }}</label>
                            <input type="number" step="0.001" min="0" name="discount_price" value="{{ old('discount_price', $product->discount_price ?? '') }}" class="form-input mt-2">
                        </div>
                    </div>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach(['is_free' => 'free', 'is_discount' => 'discount', 'is_featured' => 'featured', 'is_new' => 'new', 'show' => 'visible', 'is_active' => 'active', 'is_sold' => 'sold', 'is_soon' => 'coming_soon'] as $field => $label)
                            <label class="flex cursor-pointer items-center gap-3">
                                <input type="checkbox" name="{{ $field }}" value="1" class="h-4 w-4 accent-primary-700" @checked(old($field, $product->{$field} ?? ($field === 'show' || $field === 'is_active')))>
                                <span class="form-label">{{ __('admin.' . $label) }}</span>
                            </label>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-2xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <h2 class="mb-6 text-lg font-semibold text-primary-700 dark:text-white">{{ __('admin.product_media') }}</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="form-label">{{ __('admin.main_image') }}</label>
                            @if($isEdit && $product->main_image)
                                <img src="{{ asset('pictures' . $product->main_image) }}" class="mb-3 h-32 w-48 rounded-lg object-cover" alt="">
                            @endif
                            <input type="file" name="main_image" accept="image/*" class="form-input mt-2">
                        </div>
                        <div>
                            <label class="form-label">{{ __('admin.product_pictures') }}</label>
                            <input type="file" name="pictures[]" accept="image/*" multiple class="form-input mt-2">
                        </div>
                        <div>
                            <label class="form-label">{{ __('admin.video_urls') }}</label>
                            <div id="videos" class="space-y-2">
                                @if($isEdit)
                                    @foreach($product->videos as $video)<div class="flex gap-2"><input name="video_urls[]" value="{{ $video->video_url }}" class="form-input"><label class="flex items-center gap-1 text-sm"><input type="checkbox" name="remove_videos[]" value="{{ $video->id }}"> {{ __('admin.remove') }}</label></div>@endforeach
                                @endif
                                <input name="video_urls[]" class="form-input" placeholder="https://..."><button type="button" class="secondary-btn" onclick="addVideo()">+ {{ __('admin.add') }}</button>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">{{ __('admin.audio_files') }}</label>
                            <input type="file" name="audio_paths[]" accept="audio/*" multiple class="form-input mt-2">
                            @if($isEdit)
                                <div class="mt-3 space-y-2">@foreach($product->audios as $audio)<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="remove_audios[]" value="{{ $audio->id }}"> {{ __('admin.remove') }}: {{ basename($audio->audio_path) }}</label>@endforeach</div>
                            @endif
                        </div>
                    </div>
                    @if($isEdit && $product->pictures->isNotEmpty())
                        <div class="mt-6 flex flex-wrap gap-4">@foreach($product->pictures as $picture)<label class="text-sm"><img src="{{ asset('pictures' . $picture->picture) }}" class="h-24 w-32 rounded object-cover" alt=""><span class="mt-1 flex items-center gap-1"><input type="checkbox" name="remove_pictures[]" value="{{ $picture->id }}"> {{ __('admin.remove') }}</span></label>@endforeach</div>
                    @endif
                </section>

                <div class="flex justify-end"><button type="submit" class="primary-btn">{{ $isEdit ? __('admin.update_product') : __('Save') }}</button></div>
            </form>
        </div>
    </div>
    @include('admin.partials.summernote-description-editor')
    @push('scripts')
    <script>
        $(function () { $('.select2').select2({ width: '100%', closeOnSelect: false }); });
        function addVideo() { const input = document.createElement('input'); input.name = 'video_urls[]'; input.className = 'form-input'; input.placeholder = 'https://...'; document.getElementById('videos').insertBefore(input, document.getElementById('videos').lastElementChild); }
    </script>
    @endpush
</x-admin-layout>
