<x-app-layout>
    <div class="bg-primary-100 py-12 h-screen">
    <div class="md:hidden h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Edit Domain
                    </p>
                </div>
                <form method="POST" action="{{ route('field.update', $field->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between space-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Title
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="title_en"
                                id="title_en"
                                value="{{ $field->getTranslation('title', 'en') }}"
                                class="form-input"
                                placeholder="Study domain title"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                اسم المحور (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="title_ar"
                                id="title_ar"
                                value="{{ $field->getTranslation('title', 'ar') }}"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="اسم المحور"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Subtitle
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="subtitle_en"
                                id="subtitle_en"
                                value="{{ $field->getTranslation('subtitle', 'en') }}"
                                class="form-input"
                                placeholder="Study domain subtitle"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                العنوان الفرعي (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="subtitle_ar"
                                id="subtitle_ar"
                                value="{{ $field->getTranslation('subtitle', 'ar') }}"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="العنوان الفرعي"
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
                                placeholder="Study domain description"
                                class="form-input"
                            >
                                {{ $field->getTranslation('description', 'en') }}
                            </textarea>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                وصف المحور (عربي)
                            </label>
                            <div class="mt-2">
                                <textarea
                                    rows={4}
                                    name="description_ar"
                                    id="description_ar"
                                    placeholder="وصف المحور"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                >
                                {{ $field->getTranslation('description', 'ar') }}
                                </textarea>
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
    <script>
        function clearForm() {
            document.getElementById('myForm').reset();
        }
    </script>
</x-app-layout>