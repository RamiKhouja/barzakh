<x-app-layout>
    @php
        $lang = app()->getLocale();
        $user = auth()->user();
        $oldService = $services->firstWhere('id', old('service_id'));
        $oldServiceTitle = $oldService ? ($lang == 'ar' ? $oldService->title_ar : $oldService->title_en) : '';
    @endphp
    <div class="bg-primary-100 dark:bg-gray-700" id="page-container">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-3xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-36">
            @if ($message = Session::get('success'))
                <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-green-700">{{ $message }}</h3>
                    </div>
                </div>
            @endif
            <div class="my-16 text-center">
                <p class="text-3xl leading-relaxed lg:text-5xl font-semibold text-primary-700 dark:text-primary-50">
                    {{__('services.title')}}
                </p>
                <p class="mt-8 text-lg lg:text-2xl text-gray-700 dark:text-primary-100">
                    {{__('services.paragraph')}}
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 container" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                @foreach($services as $service)
                    <x-service :service="$service" :status=null :completed=null />
                @endforeach
            </div>
        </div>
    </div>

    <div class="fixed z-50 inset-0 hidden overflow-y-auto" aria-labelledby="service-request-title" role="dialog" aria-modal="true" id="serviceRequestModal" onclick="handleServiceRequestModalBackdrop(event)">
        <div class="flex items-center justify-center min-h-screen px-4 py-8 rounded-lg">
            <div class="bg-primary-150 dark:bg-gray-400 rounded-2xl p-8 shadow-2xl w-full max-w-2xl" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <img src="{{ asset('pictures/global/logo-main.png') }}" class="h-20 mb-4" alt=""/>
                        <h2 id="service-request-title" class="text-2xl font-medium text-bordo dark:text-white">{{ __('services.button') }}</h2>
                        <p class="text-sm text-stone dark:text-primary-100 mt-2" id="serviceRequestServiceTitle"></p>
                    </div>
                    <button type="button" onclick="closeServiceRequestModal()" class="text-2xl text-bordo dark:text-white leading-none">&times;</button>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-md bg-red-50 p-4">
                        <ul class="text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('service-request.store') }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    <input type="hidden" name="service_id" id="serviceRequestServiceId" value="{{ old('service_id') }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="service-request-email" class="form-label">{{ __('admin.email') }}</label>
                            <input
                                type="email"
                                id="service-request-email"
                                name="email"
                                value="{{ old('email', $user?->email) }}"
                                class="form-input mt-2 dark:bg-gray-500"
                                required
                            />
                        </div>
                        <div>
                            <label for="service-request-firstname" class="form-label">{{ __('profile.firstname') }}</label>
                            <input
                                type="text"
                                id="service-request-firstname"
                                name="firstname"
                                value="{{ old('firstname', $user?->firstname) }}"
                                class="form-input mt-2 dark:bg-gray-500"
                                required
                            />
                        </div>
                        <div>
                            <label for="service-request-lastname" class="form-label">{{ __('profile.lastname') }}</label>
                            <input
                                type="text"
                                id="service-request-lastname"
                                name="lastname"
                                value="{{ old('lastname', $user?->lastname) }}"
                                class="form-input mt-2 dark:bg-gray-500"
                            />
                        </div>
                        <div>
                            <label for="service-request-phone" class="form-label">{{ __('profile.phone') }}</label>
                            <input
                                type="text"
                                id="service-request-phone"
                                name="phone"
                                value="{{ old('phone', $user?->phone) }}"
                                class="form-input mt-2 dark:bg-gray-500"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="service-request-description" class="form-label">{{ __('services.description') }}</label>
                        <textarea
                            id="service-request-description"
                            name="description"
                            rows="5"
                            class="form-input mt-2 dark:bg-gray-500"
                            required
                        >{{ old('description') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" class="secondary-btn" onclick="closeServiceRequestModal()">{{ __('Cancel') }}</button>
                        <button type="submit" class="primary-btn">{{ __('services.button') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function openServiceRequestModal(serviceId, serviceTitle) {
        const modal = document.getElementById('serviceRequestModal');
        document.getElementById('serviceRequestServiceId').value = serviceId;
        document.getElementById('serviceRequestServiceTitle').textContent = serviceTitle;
        modal.classList.remove('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.add('opacity-20');
        navigation.classList.add('opacity-20');
    }

    function closeServiceRequestModal() {
        const modal = document.getElementById('serviceRequestModal');
        modal.classList.add('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.remove('opacity-20');
        navigation.classList.remove('opacity-20');
    }

    function handleServiceRequestModalBackdrop(event) {
        if (event.target.id === 'serviceRequestModal') {
            closeServiceRequestModal();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const successMessage = document.getElementById('successMessage');

        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 3000);
        }

        @if ($errors->any() && old('service_id'))
            openServiceRequestModal(@json(old('service_id')), @json($oldServiceTitle));
        @endif
    });
</script>
