<x-app-layout>
    <div class="bg-primary-100">
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-3xl mx-auto flex justify-center">
            <video class="h-[27rem]" muted autoplay controls>
                <source src="{{ asset('pictures/main-vid.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="flex justify-center">
            <div class="sm:px-6 lg:px-8 my-8 py-8 text-center max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-3xl border-b-2 border-b-primary-500">
                <p class="text-2xl mb-4 text-gray-700 font-semibold">Charter</p>
                <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum id soluta odit voluptatibus, enim provident nemo ullam? Eaque soluta quam natus vel ullam officiis suscipit, doloremque a vitae, voluptas ratione.</p>
            </div>
        </div>
        <div class="my-8 max-w-xs sm:max-w-xl md:max-w-xl lg:max-w-3xl mx-auto">
            <div class="flex justify-between items-center px-6 pb-8">
                <div>
                    <p class="text-2xl text-primary-500 font-semibold">Courses</p>
                </div>
                <div>
                    <img src="{{ asset('pictures/logo.png') }}" class="h-10" alt=""/>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="xs:columns-1 md:columns-3 md:gap-4 lg:gap-8">
                    <div class="h-72 w-72 md:h-52 md:w-52 lg:h-72 lg:w-72 my-6 md:my-0 cat-circle p-6 md:p-4 lg:p-6 text-center">
                        <div class="h-1/3 text-center px-2">
                            <p class="text-2xl md:text-lg lg:text-2xl font-bold text-gray-700">Religious Perspective</p>
                        </div>
                        <div class="h-2/3 text-center px-2 mt-10 md:mt-8 lg:mt-10">
                            <p class="text-2xl md:text-lg lg:text-2xl font-medium text-gray-400">Religious View Section</p>
                        </div>
                    </div>
                    <div class="h-72 w-72 md:h-52 md:w-52 lg:h-72 lg:w-72 my-6 md:my-0 cat-circle">   
                    </div>
                    <div class="h-72 w-72 md:h-52 md:w-52 lg:h-72 lg:w-72 my-6 md:my-0 cat-circle"></div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .eye-shape {
            border-radius: 100% 0px;
            transform: rotate(45deg); 
            width: 188px;
            height: 188px
        }
        .cat-circle {
            background-image: url('{{ asset('pictures/cat-circle.png') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</x-app-layout>