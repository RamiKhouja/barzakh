<x-app-layout>
    <div class="bg-primary-100 py-12">
    <div class="md:hidden h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Update Category
                    </p>
                </div>
                <form method="POST" action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between space-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Category Image
                            </label>
                            <x-picture-input :image="old('picture', $category->image)" :circle="false" />
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Title
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $category->title_en }}"
                                name="title_en"
                                id="title_en"
                                class="form-input"
                                placeholder="e.g. Sociology"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                اسم الفئة (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $category->title_ar }}"
                                name="title_ar"
                                id="title_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="مثال علم الاجتماع"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Domain
                            </label>
                            <select id="field" name="field_id" class="mt-2 form-input">
                                @foreach($fields as $field)
                                <option value="{{ $field->id }}" class="mt-2" {{ $category->field_id == $field->id ? 'selected' : '' }}>
                                    {{ $field->getTranslation('title', 'en') }} ( {{ $field->getTranslation('title', 'ar') }} )
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                URL
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $category->url }}"
                                name="url"
                                id="url"
                                class="form-input"
                                placeholder="e.g. sociology-course"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Description
                            </label>
                            <div class="mt-2">
                            <textarea
                                rows={4}
                                name="description_en"
                                id="description_en"
                                placeholder="Category description"
                                class="form-input"
                            >{{ $category->description_en }}</textarea>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                وصف الفئة (عربي)
                            </label>
                            <div class="mt-2">
                                <textarea
                                    rows={4}
                                    name="description_ar"
                                    id="description_ar"
                                    placeholder="كلمات عن الفئة"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                >{{ $category->description_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-12">
                        <a type="button" class="secondary-btn mr-2" href="{{ route('admin.categories') }}">{{ __('Cancel') }}</a>
                        <button type="submit" class="primary-btn">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>