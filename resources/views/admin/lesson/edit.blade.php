<x-app-layout>
    <div class="bg-primary-100 py-12">
    <div class="md:hidden h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <div class="mb-12 text-center">
                        <p class="text-2xl text-primary-700 font-semibold ">
                            Update Lesson
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.lesson.update', $lesson->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between space-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Lesson Image
                            </label>
                            <x-picture-input :image="old('picture', $lesson->image)" :circle="false" />
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-1/4">
                            <label htmlFor="title" class="form-label">
                                Lesson Number
                            </label>
                            <div class="mt-2">
                                <input
                                    type="number"
                                    value="{{$lesson->number}}"
                                    name="number"
                                    min=1
                                    class="form-input"
                                    placeholder="1"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Lesson Name
                            </label>
                            <div class="mt-2">
                                <input
                                type="text" required
                                name="title_en"
                                value="{{$lesson->title_en}}"
                                id="title_en"
                                class="form-input"
                                placeholder="Lesson name"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                اسم الدرس
                            </label>
                            <div class="mt-2">
                                <input
                                type="text" required
                                name="title_ar"
                                value="{{$lesson->title_ar}}"
                                id="title_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="اسم الدرس"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Vido ID
                            </label>
                            <div class="mt-2">
                                <input
                                    type="text" required
                                    name="video_url"
                                    value="{{$lesson->video_url}}"
                                    id="video_url"
                                    class="form-input"
                                    placeholder="The id of the video e.g. 858823592"
                                />
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="flex space-x-2 items-center">
                                <label htmlFor="title" class="form-label">
                                    Duration
                                </label>
                                <label htmlFor="title" class="text-sm text-gray-400">
                                    ( HH : MM : SS )
                                </label>
                            </div>
                            <div class="flex space-x-2 items-center w-full mt-2">
                                <input
                                    type="number"
                                    name="hours"
                                    class="form-input"
                                    placeholder="0"
                                    min=0 
                                    value="{{floor($lesson->duration / 3600)}}"
                                    required
                                />
                                <p>:</p>
                                <input
                                    type="number"
                                    name="minutes"
                                    class="form-input"
                                    placeholder="0"
                                    min=0 max=59
                                    value="{{floor(($lesson->duration % 3600) / 60)}}"
                                    required
                                />
                                <p>:</p>
                                <input
                                    type="number"
                                    name="seconds"
                                    class="form-input" 
                                    placeholder="0"
                                    required
                                    min=0 max=59
                                    value="{{$lesson->duration%60}}"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-12">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Lesson Content
                            </label>
                            <div class="mt-2">
                            <textarea
                                rows={4}
                                name="description_en"
                                id="description_en"
                                placeholder="Category description"
                                class="form-input"
                            >
                            {{$lesson->description_en}}
                            </textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="flex justify-between space-x-4 mt-12">
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                محتوى الدرس
                            </label>
                            <div class="mt-2">
                                <textarea
                                    rows={4}
                                    name="description_ar"
                                    id="description_ar"
                                    placeholder="محتوى الدرس"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                >
                                {{$lesson->description_ar}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 mt-12">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_free" value="1" class="sr-only peer" {{ $lesson->is_free ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:peer-focus:ring-primary-700 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-500"></div>
                            <span class="ml-3 form-label">Free</span>
                        </label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_visible" value="1" class="sr-only peer" {{ $lesson->is_visible ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 ring-1 ring-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary-500 dark:peer-focus:ring-primary-700 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-500"></div>
                            <span class="ml-3 form-label">Visible</span>
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
</x-app-layout>