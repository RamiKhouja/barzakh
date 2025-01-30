<x-app-layout>
    <div class="bg-primary-100 py-12">
    <div class="md:hidden h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full pb-52">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Update Service
                    </p>
                </div>
                <form method="POST" action="{{ route('admin.service.update', $service->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between space-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Service Image
                            </label>
                            <x-picture-input :image="old('picture', $service->imageLink)" :circle="false" />
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
                                value="{{ $service->title_en }}"
                                name="title_en"
                                id="title_en"
                                class="form-input"
                                placeholder="service title"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                اسم الخدمة (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $service->title_ar }}"
                                name="title_ar"
                                id="title_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="اسم الخدمة"
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
                                value="{{ $service->url }}"
                                name="url"
                                id="url"
                                class="form-input"
                                placeholder="e.g. sociology-course"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 w-1/2">
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
                                value="{{ $service->price }}"
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
                                placeholder="Service description"
                                class="form-input"
                            >{{ $service->description_en }}</textarea>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                وصف الخدمة (عربي)
                            </label>
                            <div class="mt-2">
                                <textarea
                                    rows={4}
                                    name="description_ar"
                                    id="description_ar"
                                    placeholder="كلمات عن الخدمة"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                >{{ $service->description_ar }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-12">
                        <a type="button" class="secondary-btn mr-2" href="{{ route('admin.services') }}">{{ __('Cancel') }}</a>
                        <button type="submit" class="primary-btn">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
