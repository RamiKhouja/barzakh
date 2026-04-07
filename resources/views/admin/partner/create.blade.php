<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12">
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full pb-52">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Create New Partner
                    </p>
                </div>
                <form method="POST" action="{{ route('admin.partner.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-between gap-x-4">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Partner Logo
                            </label>
                            <x-picture-input :image=null :circle="false" />
                        </div>
                    </div>
                    <div class="w-full mt-8">
                        <label htmlFor="title" class="form-label">
                            Name
                        </label>
                        <div class="mt-2">
                            <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-input"
                            placeholder="Partner Name"
                            />
                        </div>
                    </div>
                    <div class="w-full mt-8">
                        <label htmlFor="title" class="form-label">
                            URL
                        </label>
                        <div class="mt-2">
                            <input
                            type="text"
                            name="url"
                            id="url"
                            class="form-input"
                            placeholder="Partner Website"
                            />
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
</x-admin-layout>
