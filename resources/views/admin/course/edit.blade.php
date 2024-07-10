<x-app-layout>
    <div class="bg-primary-100 py-12">
    <div class="md:hidden h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Update Course
                    </p>
                </div>
                <form method="POST" action="{{ route('admin.course.update', $course->id) }}" enctype="multipart/form-data">
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
                                value="{{ $course->title_en }}"
                                id="title_en"
                                class="form-input"
                                placeholder="Course title"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                اسم المادة (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="title_ar"
                                value="{{ $course->title_ar }}"
                                id="title_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="اسم المادة"
                                />
                            </div>
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
                                name="url"
                                value="{{ $course->url }}"
                                id="url"
                                class="form-input"
                                placeholder="Course url"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Instructor
                            </label>
                            <select id="instructor_id" name="instructor_id" class="mt-2 form-input">
                                @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}" class="mt-2" {{ $course->instructor_id == $instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->firstname }} {{ $instructor->lastname }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Categories
                            </label>
                            <select multiple id="categories" name="categories[]" class="select2 mt-2 form-input">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="mt-2" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                                    {{ $category->title_en }} ( {{ $category->title_ar }} )
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
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
                                    value="{{ $course->price }}"
                                    id="price"
                                    class="form-input pl-7 pr-12"
                                    placeholder="0.00"
                                    aria-describedby="price-currency"
                                />
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-700 sm:text-sm" id="price-currency">
                                        USD
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Discount Price
                            </label>
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
                                    <span class="text-gray-700 sm:text-sm" id="price-currency">
                                        USD
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Course Image
                            </label>
                            <x-picture-input :image="old('picture', $course->image)" :circle="false" />
                        </div>
                        
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Featured Video
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                name="featured_vid"
                                value="{{ $course->featured_vid }}"
                                id="featured_vid"
                                class="form-input"
                                placeholder="Video Id"
                                />
                            </div>
                        </div>
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Level
                            </label>
                            <select id="level" name="level" class="mt-2 form-input">
                                <option value="beginner" class="mt-2" {{ $course->level == "beginner" ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" class="mt-2" {{ $course->level == "intermediate" ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" class="mt-2" {{ $course->level == "advanced" ? 'selected' : '' }}>Advanced</option>
                                <option value="expert" class="mt-2" {{ $course->level == "expert" ? 'selected' : '' }}>Expert</option>
                            </select>
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
                                value="{{ $course->description_en }}"
                                id="description_en"
                                placeholder="Course description"
                                class="form-input"
                            ></textarea>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                وصف المادة (عربي)
                            </label>
                            <div class="mt-2">
                                <textarea
                                    rows={4}
                                    name="description_ar"
                                    value="{{ $course->description_ar }}"
                                    id="description_ar"
                                    placeholder="كلمات عن المادة"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end space-x-6 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Course Language
                            </label>
                            <input
                                type="text"
                                name="language"
                                value="{{ $course->language }}"
                                id="language"
                                class="form-input mt-2"
                                placeholder="e.g. English, عربي, 汉, Español, हिन्दी"
                            />
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_free" value="1" class="sr-only peer" {{ $course->is_free ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:peer-focus:ring-primary-700 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-500"></div>
                            <span class="ml-3 form-label">Free</span>
                        </label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_chosen" value="1" class="sr-only peer" {{ $course->is_chosen ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:peer-focus:ring-primary-700 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-500"></div>
                            <span class="ml-3 form-label">Chosen</span>
                        </label>
                    </div>
                    <div class="mt-8 w-full">
                        <div class="flex space-x-4 items-center">
                            <label htmlFor="title" class="form-label">
                                Translations
                            </label>
                            <button type="button" id="add-trans"><x-zondicon-add-solid class="w-6 h-6 text-primary-700" /></button>
                        </div>
                        <div class="flex flex-wrap items-center space-x-4" id="trans-container">
                            @if($course->translations != null)
                                @foreach(json_decode($course->translations) as $trans)
                                <div class="w-28 mt-2">
                                    <input type="text" name="translations[]" class="form-input" placeholder="Language" value="{{$trans}}">
                                </div>
                                @endforeach
                            @else
                                <div class="w-28 mt-2">
                                    <input type="text" name="translations[]" class="form-input" placeholder="Language">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <div class="flex space-x-4 items-center">
                                <label htmlFor="title" class="form-label">
                                    Course Requirements
                                </label>
                                <button type="button" id="add-requirement"><x-zondicon-add-solid class="w-6 h-6 text-primary-700" /></button>
                            </div>
                            <div id="requirements-en-container" class="mt-2">
                            @if($course->requirements_en != null)
                                @foreach(json_decode($course->requirements_en) as $requirement)
                                <div class="mt-2">
                                    <input type="text" name="requirements_en[]" class="form-input " placeholder="Requirement" value="{{$requirement}}">
                                </div>
                                @endforeach
                            @else
                                <div class="mb-2">
                                    <input type="text" name="requirements_en[]" class="form-input " placeholder="Requirement">
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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
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
</x-app-layout>