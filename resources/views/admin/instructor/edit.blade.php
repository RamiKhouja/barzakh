<x-app-layout>
    <div class="bg-primary-100 py-12">
    <div class="md:hidden h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:w-7xl mx-auto flex justify-center">
            <div class="w-full">
                <div class="flex justify-center">
                    <p class="text-2xl text-primary-700 font-semibold mb-12">
                        Update Instructor Informations
                    </p>
                </div>
                <form method="POST" action="{{ route('admin.instructor.update', $instructor->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label mb-2">
                                Profile Picture
                            </label>
                            <x-picture-input :image="old('picture', $instructor->image)" :circle="true"/>
                        </div>
                    </div>
                    <div>
                        <label class="inline-flex items-center mt-8">
                            <input type="radio" class="form-radio" name="sex" value="male" {{ $instructor->sex == 'male' ? 'checked' : '' }}>
                            <span class="ml-2">Mr.</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" class="form-radio" name="sex" value="female" {{ $instructor->sex == 'female' ? 'checked' : '' }}>
                            <span class="ml-2">Ms.</span>
                        </label>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                First name
                            </label>
                            <div class="mt-2">
                                <input
                                type="text" required
                                value="{{ $instructor->getTranslation('firstname', 'en') }}"
                                name="firstname_en"
                                id="firstname_en"
                                class="form-input"
                                placeholder="Foulen"
                                />
                            </div>
                        </div>
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Last name
                            </label>
                            <div class="mt-2">
                                <input
                                type="text" required
                                value="{{ $instructor->getTranslation('lastname', 'en') }}"
                                name="lastname_en"
                                id="lastname_en"
                                class="form-input"
                                placeholder="Ben Foulen"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 mt-8">
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                الإسم (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $instructor->getTranslation('firstname', 'ar') }}"
                                name="firstname_ar"
                                id="firstname_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="فولان"
                                />
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                اللقب (عربي)
                            </label>
                            <div class="mt-2">
                                <input
                                type="text"
                                value="{{ $instructor->getTranslation('lastname', 'ar') }}"
                                name="lastname_ar"
                                id="lastname_ar"
                                class="form-input placeholder:text-right text-right"
                                style="direction: rtl;"
                                placeholder="بن فولان"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="w-full my-8">
                        <label htmlFor="email" class="form-label">
                            Email address
                        </label>
                        <div class="mt-2">
                            <input
                            value="{{ $instructor->email }}"
                            type="email" required
                            name="email"
                            id="email"
                            class="form-input"
                            placeholder="example@domain.com"
                            />
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 my-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Short Description
                            </label>
                            <div class="mt-2">
                            <textarea
                                rows={4}
                                name="short_desc_en"
                                id="short_desc_en"
                                placeholder="Short Bio about the instructor"
                                class="form-input"
                            >{{$instructor->getTranslation('short_desc', 'en') }}</textarea>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                المدرّس في كلمات (عربي)
                            </label>
                            <div class="mt-2">
                                <textarea
                                    rows={4}
                                    name="short_desc_ar"
                                    id="short_desc_ar"
                                    placeholder="نبذة وجيزة عن المدرّس"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                >
                                {{$instructor->getTranslation('short_desc', 'ar') }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-4 my-8">
                        <div class="w-full">
                            <label htmlFor="title" class="form-label">
                                Description
                            </label>
                            <div class="mt-2">
                            <textarea
                                rows={4}
                                name="description_en"
                                id="description_en"
                                placeholder="Instructor description"
                                class="form-input"
                            >
                            {{$instructor->getTranslation('description', 'en') }}
                            </textarea>
                            </div>
                        </div>
                        <div class="w-full text-right">
                            <label htmlFor="title" class="form-label">
                                وصف المدرّس (عربي)
                            </label>
                            <div class="mt-2">
                                <textarea
                                    rows={4}
                                    name="description_ar"
                                    id="description_ar"
                                    placeholder="وصف المدرّس"
                                    class="form-input placeholder:text-right text-right"
                                    style="direction: rtl;"
                                >
                                {{$instructor->getTranslation('description', 'ar') }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end my-8">
                        <a type="button" class="secondary-btn mr-2" href="{{ route('admin.instructors') }}">{{ __('Cancel') }}</a>
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