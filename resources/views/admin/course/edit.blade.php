<x-admin-layout>
    @php($isRtl = app()->getLocale() === 'ar')
    <div class="bg-primary-100 dark:bg-gray-700 py-12">
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl xl:max-w-screen-md mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">{{ __('admin.update_course') }}</p>
                </div>
                <form id="myForm" method="POST" action="{{ route('admin.course.update', $course->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="mb-8 rounded-md bg-red-50 p-4 text-red-700" role="alert">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="flex justify-between gap-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.title') }}</label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="title_en"
                                value="{{ $course->title_en }}"
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
                                value="{{ $course->title_ar }}"
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
                            <label htmlFor="title" class="form-label">{{ __('admin.url') }}</label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="url"
                                value="{{ $course->url }}"
                                id="url"
                                class="form-input"
                                placeholder="{{ __('admin.course_url_placeholder') }}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.instructor') }}</label>
                            <select id="instructor_id" name="instructor_id" class="mt-2 form-input {{ $isRtl ? 'text-right pl-10 pr-3' : 'pr-10' }}" style="{{ $isRtl ? 'direction: rtl; background-position: left 0.75rem center;' : '' }}">
                                @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" class="mt-2" {{ $course->instructor_id == $instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->firstname }} {{ $instructor->lastname }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.categories') }}</label>
                            <select multiple id="categories" name="categories[]" class="select2 mt-2 form-input">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="mt-2" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                                    {{ $category->title_en }} ( {{ $category->title_ar }} )
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.price') }}</label>
                            <div class="mt-2 relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-300 sm:text-sm">$</span>
                                </div>
                                <input
                                    type="number"
                                    min=0
                                    name="price"
                                    value="{{ $course->price }}"
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
                            <label htmlFor="title" class="form-label">{{ __('admin.discount_price') }}</label>
                            <div class="mt-2 relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-300 sm:text-sm">$</span>
                                </div>
                                <input
                                    type="number"
                                    min=0
                                    name="discount_price"
                                    value="{{ $course->discount_price }}"
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
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">{{ __('admin.course_image') }}</label>
                            <x-picture-input
                                :image="$course->image ? ('pictures' . $course->image) : null"
                                :circle="false"
                                accept="image/jpeg,image/jpg,image/png,.jpeg,.jpg,.png"
                                :max-size-mb="2"
                                :enable-crop="true"
                                :aspect-ratio="16 / 9"
                            />
                        </div>
                        
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-1/3">
                            <label htmlFor="video_type" class="form-label">{{ __('admin.video_type') }}</label>
                            <select id="video_type" name="video_type" class="mt-2 form-input {{ $isRtl ? 'text-right pl-10 pr-3' : 'pr-10' }}" style="{{ $isRtl ? 'direction: rtl; background-position: left 0.75rem center;' : '' }}">
                                <option value="vimeo" {{ $course->video_type == "vimeo" ? 'selected' : '' }}>Vimeo</option>
                                <option value="youtube" {{ $course->video_type == "youtube" ? 'selected' : '' }}>YouTube</option>
                            </select>
                        </div>
                        <div class="w-1/3">
                            <label htmlFor="title" class="form-label">{{ __('admin.featured_video') }}</label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="featured_vid"
                                value="{{ $course->featured_vid }}"
                                id="featured_vid"
                                class="form-input"
                                placeholder="{{ __('admin.video_id_placeholder') }}"
                                />
                            </div>
                        </div>
                        <div class="w-1/3">
                            <label htmlFor="title" class="form-label">{{ __('admin.level') }}</label>
                            <select id="level" name="level" class="mt-2 form-input {{ $isRtl ? 'text-right pl-10 pr-3' : 'pr-10' }}" style="{{ $isRtl ? 'direction: rtl; background-position: left 0.75rem center;' : '' }}">
                                <option value="beginner" class="mt-2" {{ $course->level == "beginner" ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" class="mt-2" {{ $course->level == "intermediate" ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" class="mt-2" {{ $course->level == "advanced" ? 'selected' : '' }}>Advanced</option>
                                <option value="expert" class="mt-2" {{ $course->level == "expert" ? 'selected' : '' }}>Expert</option>
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
                            >{{ old('description_en', $course->description_en) }}</textarea>
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
                                >{{ old('description_ar', $course->description_ar) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 items-end gap-x-6 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.course_language') }}</label>
                            <select name="language" id="language" class="form-input mt-2 {{ $isRtl ? 'text-right pl-10 pr-3' : 'pr-10' }}" style="{{ $isRtl ? 'direction: rtl; background-position: left 0.75rem center;' : '' }}">
                                @foreach (['English', 'Arabic', 'French', 'Turkish', 'Urdu', 'Russian', 'Chinese'] as $language)
                                    <option value="{{ $language }}" @selected(old('language', $course->language) === $language)>{{ __('course.' . $language) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                            <input type="checkbox" name="is_free" value="1" class="sr-only peer" {{ $course->is_free ? 'checked' : '' }}>
                            <div class="relative w-11 h-6 rounded-full bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:bg-gray-400 dark:peer-focus:ring-primary-700 peer-checked:bg-primary-500 after:absolute after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-white after:bg-white after:transition-all {{ $isRtl ? 'after:right-[2px] peer-checked:after:-translate-x-full' : 'after:left-[2px] peer-checked:after:translate-x-full' }} after:content-['']"></div>
                            <span class="{{ $isRtl ? 'mr-3' : 'ml-3' }} form-label">{{ __('admin.free') }}</span>
                        </label>
                        <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                            <input type="checkbox" name="is_chosen" value="1" class="sr-only peer" {{ $course->is_chosen ? 'checked' : '' }}>
                            <div class="relative w-11 h-6 rounded-full bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:bg-gray-400 dark:peer-focus:ring-primary-700 peer-checked:bg-primary-500 after:absolute after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-white after:bg-white after:transition-all {{ $isRtl ? 'after:right-[2px] peer-checked:after:-translate-x-full' : 'after:left-[2px] peer-checked:after:translate-x-full' }} after:content-['']"></div>
                            <span class="{{ $isRtl ? 'mr-3' : 'ml-3' }} form-label">{{ __('admin.chosen') }}</span>
                        </label>
                        <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                            <input type="checkbox" name="is_soon" value="1" class="sr-only peer" {{ $course->is_soon ? 'checked' : '' }}>
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
                            @php($selectedTranslations = old('translations', json_decode($course->translations ?? '[]', true) ?: ['']))
                            @foreach($selectedTranslations as $trans)
                                <div class="w-40 mt-2 translation-field">
                                    <select name="translations[]" class="form-input">
                                        <option value="">{{ __('course.no-translation') }}</option>
                                        @foreach (['English', 'Arabic', 'French', 'Turkish', 'Urdu', 'Russian', 'Chinese'] as $language)
                                            <option value="{{ $language }}" @selected($trans === $language)>{{ __('course.' . $language) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <div class="flex gap-x-4 items-center">
                                <label htmlFor="title" class="form-label">{{ __('admin.course_requirements') }}</label>
                                <button type="button" id="add-requirement"><x-zondicon-add-solid class="w-6 h-6 text-primary-700 dark:text-white" /></button>
                            </div>
                            <div id="requirements-en-container" class="mt-2">
                            @if($course->requirements_en != null)
                                @foreach(json_decode($course->requirements_en) as $requirement)
                                <div class="mt-2">
                                    <textarea name="requirements_en[]" class="form-input " placeholder="Requirement" value="{{$requirement}}">
                                    {{$requirement}}
                                    </textarea>
                                    
                                </div>
                                @endforeach
                            @else
                                <div class="mb-2">
                                    <textarea name="requirements_en[]" class="form-input " placeholder="Requirement">
                                    
                                    </textarea>
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                متطلبات الدرس
                            </label>
                            <div id="requirements-ar-container" class="mt-2">
                            @if($course->requirements_ar != null)
                                @foreach(json_decode($course->requirements_ar) as $requirement)
                                <div class="mt-2">
                                <input type="text" name="requirements_ar[]" class="form-input placeholder:text-right text-right" placeholder="متطلب" value="{{$requirement}}">
                                </div>
                                @endforeach
                            @else
                                <div class="mb-2">
                                    <input type="text" name="requirements_ar[]" class="form-input placeholder:text-right text-right" placeholder="متطلب">
                                </div>
                            @endif
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
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                closeOnSelect: false
            });
        });
        
        function clearForm() {
            document.getElementById('myForm').reset();
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
            const transInput = trans_container.querySelector('.translation-field').cloneNode(true);
            transInput.querySelector('select').value = '';
            trans_container.appendChild(transInput);
        });
    });
    </script>
    @endpush
</x-admin-layout>
