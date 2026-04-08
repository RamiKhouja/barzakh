<x-admin-layout>
    @php($isRtl = app()->getLocale() === 'ar')
    <div class="bg-primary-100 dark:bg-gray-700 py-12">
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <div class="mb-12 text-center">
                        <p class="text-2xl text-primary-700 font-semibold ">{{ __('admin.create_new_lesson') }}</p>
                        <p class="text-xl text-gray-400 font-medium">
                            for "{{ $course->title_en }}"
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.lesson.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                    <div class="flex justify-between gap-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">{{ __('admin.lesson_image') }}</label>
                            <x-picture-input :image=null :circle="false" />
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-1/4">
                            <label htmlFor="title" class="form-label">{{ __('admin.lesson_number') }}</label>
                            <div class="mt-2">
                                <input
                                    type="number"
                                    value="{{$course->nb_lessons+1}}"
                                    name="number"
                                    min=1
                                    class="form-input"
                                    placeholder="1"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">{{ __('admin.lesson_name') }}</label>
                            <div class="mt-2">
                                <input
                                type="text" required
                                name="title_en"
                                id="title_en"
                                class="form-input"
                                placeholder="{{ __('admin.lesson_name_placeholder') }}"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">{{ __('admin.title_arabic') }}</label>
                            <div class="mt-2">
                                <input
                                type="text" required
                                name="title_ar"
                                id="title_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="اسم الدرس"
                                />
                            </div>
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
                            <label htmlFor="title" class="form-label">{{ __('admin.video_id') }}</label>
                            <div class="mt-2">
                                <input
                                    type="text" required
                                    name="video_url"
                                    id="video_url"
                                    class="form-input"
                                    placeholder="The id of the video e.g. 858823592"
                                />
                            </div>
                        </div>
                        <div class="w-1/3">
                            <div class="flex gap-x-2 items-center">
                            <label htmlFor="title" class="form-label">{{ __('admin.duration') }}</label>
                                <label htmlFor="title" class="text-sm text-gray-400">
                                    ( HH : MM : SS )
                                </label>
                            </div>
                            <div class="flex gap-x-2 items-center w-full mt-2">
                                <input
                                    type="number"
                                    name="hours"
                                    class="form-input"
                                    placeholder="0"
                                    min=0 value=0
                                    required
                                />
                                <p>:</p>
                                <input
                                    type="number"
                                    name="minutes"
                                    class="form-input"
                                    placeholder="0"
                                    min=0 value=0
                                    required max=59
                                />
                                <p>:</p>
                                <input
                                    type="number"
                                    name="seconds"
                                    class="form-input" 
                                    placeholder="0"
                                    required value=0
                                    min=0 max=59
                                />
                            </div>
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
                    <div class="flex items-center gap-x-4 mt-12">
                        <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                            <input type="checkbox" name="is_free" value="1" class="sr-only peer">
                            <div class="relative w-11 h-6 rounded-full bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:bg-gray-400 dark:peer-focus:ring-primary-700 peer-checked:bg-primary-500 after:absolute after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-white after:bg-white after:transition-all {{ $isRtl ? 'after:right-[2px] peer-checked:after:-translate-x-full' : 'after:left-[2px] peer-checked:after:translate-x-full' }} after:content-['']"></div>
                            <span class="{{ $isRtl ? 'mr-3' : 'ml-3' }} form-label">{{ __('admin.free') }}</span>
                        </label>
                        <label class="relative inline-flex items-center cursor-pointer" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
                            <input type="checkbox" name="is_visible" value="1" class="sr-only peer" checked>
                            <div class="relative w-11 h-6 rounded-full bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:bg-gray-400 dark:peer-focus:ring-primary-700 peer-checked:bg-primary-500 after:absolute after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-white after:bg-white after:transition-all {{ $isRtl ? 'after:right-[2px] peer-checked:after:-translate-x-full' : 'after:left-[2px] peer-checked:after:translate-x-full' }} after:content-['']"></div>
                            <span class="{{ $isRtl ? 'mr-3' : 'ml-3' }} form-label">{{ __('admin.visible') }}</span>
                        </label>
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
    @include('admin.partials.summernote-description-editor')
</x-admin-layout>
