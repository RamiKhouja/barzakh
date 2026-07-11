<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Update Pack
                    </p>
                </div>
                <form id="myForm" method="POST" action="{{ route('admin.pack.update', $pack->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between gap-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Pack Name
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $pack->getTranslation('name', 'en') }}"
                                name="name_en"
                                id="name_en"
                                class="form-input"
                                placeholder="Pack name"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                اسم المجموعة (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $pack->getTranslation('name', 'ar') }}"
                                name="name_ar"
                                id="name_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="اسم المجموعة"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="pack-courses-select w-full min-w-0">
                            <label htmlFor="title" class="form-label">
                                Courses
                            </label>
                            <select class="pack-course-select select2 mt-2 form-input w-full" name="courses[]" multiple="multiple">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" class="mt-2" {{ in_array($course->id, $selectedCourses) ? 'selected' : '' }}>
                                        {{ $course->title_en }} {{ $course->title_ar }} ( {{ $course->price }} )
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Pack Domain
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $pack->getTranslation('domain', 'en') }}"
                                name="domain_en"
                                id="domain_en"
                                class="form-input"
                                placeholder="Pack domain"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                صنف المجموعة (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $pack->getTranslation('domain', 'ar') }}"
                                name="domain_ar"
                                id="domain_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="تاريخ, أدب..."
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Price
                            </label>
                            <div class="mt-2 relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-300 sm:text-sm">$</span>
                                </div>
                                <input
                                    type="number"
                                    min=0
                                    name="price"
                                    value="{{ $pack->price }}"
                                    id="price"
                                    class="form-input pl-7 pr-12"
                                    placeholder="0.00"
                                    aria-describedby="price-currency"
                                />
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-700 dark:text-gray-100 sm:text-sm" id="price-currency">
                                        USD
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Visibility
                            </label>
                            <select id="visibility" name="visibility" class="mt-2 form-input">
                                <option value="public" class="mt-2" {{ $pack->visibility == 'public' ? 'selected' : '' }}>Public</option>
                                <option value="private" class="mt-2" {{ $pack->visibility == 'private' ? 'selected' : '' }}>Private</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Pack Image
                            </label>
                            <x-picture-input :image="old('picture', $pack->imageLink)" :circle="false" />
                        </div>
                        
                    </div>
                    <div class="flex justify-between gap-x-4 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Description
                            </label>
                            <div class="mt-2">
                            <textarea
                                rows={4}
                                name="description_en"
                                id="description_en"
                                placeholder="Course description"
                                class="form-input"
                            >{{ old('description_en', $pack->getTranslation('description', 'en')) }}</textarea>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                وصف المجموعة (عربي)
                            </label>
                            <div class="mt-2">
                                <textarea
                                    rows={4}
                                    name="description_ar"
                                    id="description_ar"
                                    placeholder="كلمات عن المادة"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                >{{ old('description_ar', $pack->getTranslation('description', 'ar')) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-12">
                        <button type="button" class="secondary-btn mr-2" onclick="clearForm()">{{ __('Cancel') }}</button>
                        <button type="submit" class="primary-btn">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.partials.summernote-description-editor')
    <style>
        .pack-courses-select,
        .pack-courses-select .select2-container {
            max-width: 100%;
        }

        .pack-courses-select .select2-selection {
            overflow-x: hidden;
        }

        .pack-courses-select .select2-selection__choice {
            max-width: 100%;
        }

        .pack-courses-select .select2-selection__choice__display {
            display: inline-block;
            max-width: min(72vw, 56rem);
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: bottom;
            white-space: nowrap;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.pack-course-select').select2({
                width: '100%',
                closeOnSelect: false
            });
        });

        function clearForm() {
            document.getElementById('myForm').reset();
        }
    </script>
</x-admin-layout>
