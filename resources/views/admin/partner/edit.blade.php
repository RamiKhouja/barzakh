<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12">
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full pb-52">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Update Partner
                    </p>
                </div>
                <form method="POST" action="{{ route('admin.partner.update', $partner->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between space-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Partner Logo
                            </label>
                            <x-picture-input :image="old('picture', $partner->imageLink)" :circle="false" />
                        </div>
                    </div>
                    
                    <div class="w- mt-8">
                        <label htmlFor="title" class="form-label">
                            Name
                        </label>
                        <div class="mt-2">
                            <input
                            type="text"
                            value="{{ $partner->name }}"
                            name="name"
                            id="name"
                            class="form-input"
                            placeholder="Partner Name"
                            />
                        </div>
                    </div>
                    <div class="w- mt-8">
                        <label htmlFor="title" class="form-label">
                            URL
                        </label>
                        <div class="mt-2">
                            <input
                            type="text"
                            value="{{ $partner->url }}"
                            name="url"
                            id="url"
                            class="form-input"
                            placeholder="Partner Website"
                            />
                        </div>
                    </div>
                    <div class="flex justify-end mt-12">
                        <a type="button" class="secondary-btn mr-2" href="{{ route('admin.partners') }}">{{ __('Cancel') }}</a>
                        <button type="submit" class="primary-btn">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
