<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700" id="page-container">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-3xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-36">
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
        <x-footer/>
    </div>
    <div class="fixed z-50 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="myModal">
        <div class="flex items-center justify-center min-h-screen px-4 rounded-lg">
            <div class="bg-primary-150 dark:bg-gray-400 rounded p-8 shadow-2xl text-center" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <!-- Modal content -->
                <img src="{{ asset('pictures/global/logo-main.png') }}" class="h-24 mb-4 mx-auto" alt=""/>
                <h2 class="text-xl font-medium text-bordo dark:text-white">{{__('services.success')}}</h2>
                
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function openModal(courseId) {
        const modal = document.getElementById('myModal');
        modal.classList.remove('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.add('opacity-20');
        navigation.classList.add('opacity-20');

        setTimeout(() => {
            closeModal();
        }, 3000);
    }

    function closeModal() {
        const modal = document.getElementById('myModal');
        modal.classList.add('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.remove('opacity-20');
        navigation.classList.remove('opacity-20');
    }

    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'none';
    }, 3000);
</script>