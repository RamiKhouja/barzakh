<div class="flex items-center space-x-4" x-data="picturePreview()">
    <div class="rounded-full bg-gray-200">
        @if($image == null)
            @if($circle == "true")
                <img id="preview" src="{{ asset('pictures/global/default.jpg') }}" alt="" class="w-24 h-24 rounded-full object-cover"/>
            @else
                <img id="preview" src="{{ asset('pictures/global/default.jpg') }}" alt="" class="w-24 h-24 rounded-lg object-cover"/>
            @endif
        @else
            @if($circle == "true")
                <img id="preview" src="{{ asset($image) }}" alt="" class="w-24 h-24 rounded-full object-cover"/>
            @else
                <img id="preview" src="{{ asset($image) }}" alt="" class="w-24 h-24 rounded-lg object-cover"/>
            @endif
        @endif
    </div>
    <div>
        <x-secondary-button @click="document.getElementById('picture').click()" class="relative ">
            <div class="flex items-center">
                <div class="w-5 h-5 mr-1">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"></path>
                    </svg>
                </div>
                Upload Picture
            </div>
            <input 
                @change="showPreview(event)" 
                type="file" name="picture" 
                id="picture"
                class="absolute inset-0 -z-10 opacity-0" 
            />
        </x-primary-button>
    </div>
    <script>
        function picturePreview() {
            return {
                showPreview : (event) => {
                    if(event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        document.getElementById('preview').src = src;
                    }
                }
            }
        }
    </script>
</div>