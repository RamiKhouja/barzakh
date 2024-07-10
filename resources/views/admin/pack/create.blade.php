<x-app-layout>
    <div class="bg-primary-100 py-12">
    <div class="md:hidden h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Create New Pack
                    </p>
                </div>
                <form method="POST" action="{{ route('admin.pack.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-between space-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Pack Name
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
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
                                name="name_ar"
                                id="name_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="اسم المجموعة"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Courses
                            </label>
                            <select class="select2 mt-2 form-input w-full" name="courses[]" multiple="multiple">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" class="mt-2">{{ $course->title_en }} {{ $course->title_ar }} ( {{ $course->price }} )</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Pack Domain
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
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
                                name="domain_ar"
                                id="domain_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="تاريخ, أدب..."
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-12">
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
                                Visibility
                            </label>
                            <select id="visibility" name="visibility" class="mt-2 form-input">
                                <option value="public" class="mt-2">Public</option>
                                <option value="private" class="mt-2">Private</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Pack Image
                            </label>
                            <x-picture-input :image=null :circle="false" />
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
                                placeholder="Course description"
                                class="form-input"
                            ></textarea>
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
                                ></textarea>
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
    </script>
</x-app-layout>