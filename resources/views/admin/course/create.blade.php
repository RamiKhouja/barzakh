<x-admin-layout>
    @php($isRtl = app()->getLocale() === 'ar')
    <div class="bg-primary-100 dark:bg-gray-700 py-12">
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">{{ __('admin.create_new_course') }}</p>
                </div>
                <form method="POST" action="{{ route('admin.course.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-between gap-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.title') }}</label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="title_en"
                                id="title_en"
                                class="form-input"
                                placeholder="{{ __('admin.course_title_placeholder') }}"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">{{ __('admin.title_arabic') }}</label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="title_ar"
                                id="title_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="{{ __('admin.course_title_placeholder') }}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.instructor') }}</label>
                            <select id="instructor_id" name="instructor_id" class="mt-2 form-input {{ $isRtl ? 'text-right pl-10 pr-3' : 'pr-10' }}" style="{{ $isRtl ? 'direction: rtl; background-position: left 0.75rem center;' : '' }}">
                                @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" class="mt-2">{{ $instructor->firstname }} {{ $instructor->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.categories') }}</label>
                            <select class="select2 mt-2 form-input w-full" name="categories[]" multiple="multiple">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" class="mt-2">{{ $category->title_en }} ( {{ $category->title_ar }} )</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8 items-end">
                        <div class="w-1/2">
                            <label htmlFor="title" class="form-label">{{ __('admin.price') }}</label>
                            <div class="mt-2 relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-300 sm:text-sm">$</span>
                                </div>
                                <input
                                    type="number"
                                    min=0
                                    name="price"
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
                        <div>
                            <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                                <input type="checkbox" name="is_discount" id="is_discount" value="1" class="sr-only peer" onchange="toggleDiscountArea()" >
                                <div class="relative w-11 h-6 rounded-full bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:bg-gray-400 dark:peer-focus:ring-primary-700 peer-checked:bg-primary-500 after:absolute after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-white after:bg-white after:transition-all {{ $isRtl ? 'after:right-[2px] peer-checked:after:-translate-x-full' : 'after:left-[2px] peer-checked:after:translate-x-full' }} after:content-['']"></div>
                                <span class="{{ $isRtl ? 'mr-3' : 'ml-3' }} form-label">{{ __('admin.discount') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="justify-between gap-x-4 mt-8 hidden" id="discount_area">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.discount_price') }}</label>
                            <div class="mt-2 relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-300 sm:text-sm">$</span>
                                </div>
                                <input
                                    type="number"
                                    min=0
                                    name="discount_price"
                                    id="discount_price"
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
                            <label htmlFor="title" class="form-label">{{ __('admin.start_discount') }}</label>
                            <div class="mt-2">
                                <input
                                type="date"
                                name="discount_start"
                                id="discount_start"
                                class="form-input"
                                />
                            </div>
                        </div>
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.end_discount') }}</label>
                            <div class="mt-2">
                                <input
                                type="date"
                                name="discount_end"
                                id="discount_end"
                                class="form-input"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">{{ __('admin.course_image') }}</label>
                            <x-picture-input :image=null :circle="false" />
                        </div>
                        
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-1/3">
                            <label htmlFor="video_type" class="form-label">{{ __('admin.video_type') }}</label>
                            <select id="video_type" name="video_type" class="mt-2 form-input {{ $isRtl ? 'text-right pl-10 pr-3' : 'pr-10' }}" style="{{ $isRtl ? 'direction: rtl; background-position: left 0.75rem center;' : '' }}">
                                <option value="vimeo">Vimeo</option>
                                <option value="youtube">YouTube</option>
                            </select>
                        </div>
                        <div class="w-1/3">
                            <label htmlFor="title" class="form-label">{{ __('admin.featured_video') }}</label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="featured_vid"
                                id="featured_vid"
                                class="form-input"
                                placeholder="{{ __('admin.video_id_placeholder') }}"
                                />
                            </div>
                        </div>
                        <div class="w-1/3">
                            <label htmlFor="title" class="form-label">{{ __('admin.level') }}</label>
                            <select id="level" name="level" class="mt-2 form-input {{ $isRtl ? 'text-right pl-10 pr-3' : 'pr-10' }}" style="{{ $isRtl ? 'direction: rtl; background-position: left 0.75rem center;' : '' }}">
                                <option value="beginner" class="mt-2">Beginner</option>
                                <option value="intermediate" class="mt-2">Intermediate</option>
                                <option value="advanced" class="mt-2">Advanced</option>
                                <option value="expert" class="mt-2">Expert</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.description_english') }}</label>
                            <div class="mt-2">
                            <textarea
                                rows="4"
                                name="description_en"
                                id="description_en"
                                placeholder="{{ __('admin.description_english') }}"
                                class="form-input"
                            >{{ old('description_en') }}</textarea>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">{{ __('admin.description_arabic') }}</label>
                            <div class="mt-2">
                                <textarea
                                    rows="4"
                                    name="description_ar"
                                    id="description_ar"
                                    placeholder="{{ __('admin.description_arabic') }}"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                >{{ old('description_ar') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end gap-x-6 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.course_language') }}</label>
                            <input
                                type="text"
                                name="language"
                                id="language"
                                class="form-input"
                                placeholder="e.g. English, عربي, 汉, Español, हिन्दी"
                            />
                        </div>
                    </div>
                    <div class="flex items-center gap-x-6 mt-8">
                        <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                            <input type="checkbox" name="is_free" value="1" class="sr-only peer">
                            <div class="relative w-11 h-6 rounded-full bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:bg-gray-400 dark:peer-focus:ring-primary-700 peer-checked:bg-primary-500 after:absolute after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-white after:bg-white after:transition-all {{ $isRtl ? 'after:right-[2px] peer-checked:after:-translate-x-full' : 'after:left-[2px] peer-checked:after:translate-x-full' }} after:content-['']"></div>
                            <span class="{{ $isRtl ? 'mr-3' : 'ml-3' }} form-label">{{ __('admin.free') }}</span>
                        </label>
                        <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                            <input type="checkbox" name="is_chosen" value="1" class="sr-only peer">
                            <div class="relative w-11 h-6 rounded-full bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:bg-gray-400 dark:peer-focus:ring-primary-700 peer-checked:bg-primary-500 after:absolute after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-white after:bg-white after:transition-all {{ $isRtl ? 'after:right-[2px] peer-checked:after:-translate-x-full' : 'after:left-[2px] peer-checked:after:translate-x-full' }} after:content-['']"></div>
                            <span class="{{ $isRtl ? 'mr-3' : 'ml-3' }} form-label">{{ __('admin.chosen') }}</span>
                        </label>
                        <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                            <input type="checkbox" name="is_soon" value="1" class="sr-only peer">
                            <div class="relative w-11 h-6 rounded-full bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:bg-gray-400 dark:peer-focus:ring-primary-700 peer-checked:bg-primary-500 after:absolute after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-white after:bg-white after:transition-all {{ $isRtl ? 'after:right-[2px] peer-checked:after:-translate-x-full' : 'after:left-[2px] peer-checked:after:translate-x-full' }} after:content-['']"></div>
                            <span class="{{ $isRtl ? 'mr-3' : 'ml-3' }} form-label">{{ __('admin.coming_soon') }}</span>
                        </label>
                    </div>
                    <div class="mt-8 w-full">
                        <div class="flex gap-x-4 items-center">
                            <label htmlFor="title" class="form-label">{{ __('admin.translations') }}</label>
                            <button type="button" id="add-trans"><x-zondicon-add-solid class="w-6 h-6 text-primary-700 dark:text-white" /></button>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-4" id="trans-container">
                            <div class="w-28 mt-2">
                                <input type="text" name="translations[]" class="form-input" placeholder="translations">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <div class="flex gap-x-4 items-center">
                                <label htmlFor="title" class="form-label">{{ __('admin.course_requirements') }}</label>
                                <button type="button" id="add-requirement"><x-zondicon-add-solid class="w-6 h-6 text-primary-700 dark:text-white" /></button>
                            </div>
                            <div id="requirements-en-container" class="mt-2">
                                <div class="mb-2">
                                    <input type="text" name="requirements_en[]" class="form-input " placeholder="Requirement">
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                متطلبات الدرس
                            </label>
                            <div id="requirements-ar-container" class="mt-2">
                                <div class="mb-2">
                                    <input type="text" name="requirements_ar[]" class="form-input placeholder:text-right text-right" placeholder="متطلب">
                                </div>
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
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        function clearForm() {
            document.getElementById('myForm').reset();
        }

        function toggleDiscountArea() {
            var checkbox = document.getElementById('is_discount');
            var discountArea = document.getElementById('discount_area');
            
            if (checkbox.checked) {
                discountArea.classList.remove('hidden');
                discountArea.classList.add('flex');
            } else {
                discountArea.classList.remove('flex');
                discountArea.classList.add('hidden');
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
        const addButton = document.getElementById("add-requirement");
        const container_en = document.getElementById("requirements-en-container");
        const container_ar = document.getElementById("requirements-ar-container");

        addButton.addEventListener("click", function () {
            const input = document.createElement("div");
            input.innerHTML = `
                <div class="mb-2">
                    <input type="text" name="requirements_en[]" class="form-input" placeholder="Requirement">
                </div>
            `;
            container_en.appendChild(input);

            const input_ar = document.createElement("div");
            input_ar.innerHTML = `
                <div class="mb-2">
                    <input type="text" name="requirements_ar[]" class="form-input placeholder:text-right text-right" placeholder="متطلب">
                </div>
            `;
            container_ar.appendChild(input_ar);
        });

        const addTrans = document.getElementById("add-trans");
        const trans_container = document.getElementById("trans-container");

        addTrans.addEventListener("click", function () {
            const trans_input = document.createElement("div");
            trans_input.innerHTML = `
            <div class="w-28 mt-2">
                <input type="text" name="translations[]" class="form-input" placeholder="translations">
            </div>
            `;
            trans_container.appendChild(trans_input);
        });
    });
    </script>
</x-admin-layout>
