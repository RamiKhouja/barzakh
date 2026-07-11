@props([
    'image' => null,
    'circle' => false,
    'accept' => 'image/*',
    'maxSizeMb' => null,
    'enableCrop' => false,
    'aspectRatio' => 16 / 9,
])

@if($enableCrop)
    <link rel="stylesheet" href="https://unpkg.com/cropperjs@1.6.2/dist/cropper.min.css">
    <script src="https://unpkg.com/cropperjs@1.6.2/dist/cropper.min.js"></script>
@endif

<div class="flex items-center gap-x-4" x-data="picturePreview({ enableCrop: @js($enableCrop), aspectRatio: {{ $aspectRatio }} })">
    <div class="rounded-full bg-gray-200">
        @if($image == null)
        <img x-ref="preview" src="{{ asset('pictures/global/default.jpg') }}" alt="" class="{{ $circle == 'true' ? ('w-24 rounded-full') : ('w-42 rounded-lg')}} h-24 object-cover"/>
        @else
        <img x-ref="preview" src="{{ asset($image) }}" alt="" class="{{ $circle == 'true' ? ('w-24 rounded-full') : ('w-42 rounded-lg')}} h-24 object-cover"/>
        @endif
    </div>
    <div>
        <x-secondary-button @click="$refs.pictureInput.click()" class="relative ">
            <div class="flex items-center gap-x-1">
                <div class="w-5 h-5">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"></path>
                    </svg>
                </div>
                {{ __("profile.upload-picture") }}
            </div>
            <input 
                @change="onFileChange(event)" 
                type="file" name="picture" 
                id="picture"
                accept="{{ $accept }}"
                data-max-size-mb="{{ $maxSizeMb }}"
                x-ref="pictureInput"
                class="absolute inset-0 -z-10 opacity-0" 
            />
        </x-secondary-button>
    </div>

    <div x-cloak x-show="showCropper" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4">
        <div class="w-full max-w-5xl rounded-lg bg-white p-4 shadow-xl dark:bg-gray-800">
            <div class="mb-3 flex items-center justify-between">
                <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">Crop image to 16:9</p>
                <button type="button" @click="cancelCrop()" class="text-sm text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">Close</button>
            </div>

            <div class="max-h-[70vh] overflow-hidden rounded bg-gray-100 dark:bg-gray-700">
                <img x-ref="cropperImage" alt="Crop preview" class="block max-h-[70vh] w-full object-contain">
            </div>

            <div class="mt-4">
                <label class="mb-1 block text-sm text-gray-700 dark:text-gray-200">Zoom</label>
                <input
                    type="range"
                    min="0.1"
                    max="3"
                    step="0.01"
                    x-model="zoomRatio"
                    @input="zoomTo(zoomRatio)"
                    class="w-full"
                >
            </div>

            <div class="mt-4 flex justify-end gap-2">
                <button type="button" @click="cancelCrop()" class="rounded bg-gray-200 px-4 py-2 text-sm text-gray-800 hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-100 dark:hover:bg-gray-500">Cancel</button>
                <button type="button" @click="applyCrop()" class="rounded bg-primary-700 px-4 py-2 text-sm text-white hover:bg-primary-800">Apply crop</button>
            </div>
        </div>
    </div>

    <script>
        function picturePreview(config = {}) {
            return {
                enableCrop: !!config.enableCrop,
                aspectRatio: Number(config.aspectRatio || (16 / 9)),
                showCropper: false,
                cropper: null,
                cropSourceUrl: null,
                zoomRatio: 1,

                validateFile(event, file) {
                    const maxSizeMb = Number(event.target.dataset.maxSizeMb || 0);
                    const allowedTypes = (event.target.getAttribute('accept') || '')
                        .split(',')
                        .map(type => type.trim())
                        .filter(Boolean);

                    if (maxSizeMb > 0 && file.size > (maxSizeMb * 1024 * 1024)) {
                        alert(`Image size must be ${maxSizeMb}MB or less.`);
                        event.target.value = '';
                        return false;
                    }

                    if (allowedTypes.length > 0 && allowedTypes[0] !== 'image/*') {
                        const isAllowed = allowedTypes.some(type => {
                            if (type.startsWith('.')) {
                                return file.name.toLowerCase().endsWith(type.toLowerCase());
                            }
                            return file.type === type;
                        });

                        if (!isAllowed) {
                            alert('Only JPEG/JPG/PNG files are allowed.');
                            event.target.value = '';
                            return false;
                        }
                    }

                    return true;
                },

                onFileChange(event) {
                    if (!event.target.files.length) {
                        return;
                    }

                    const file = event.target.files[0];
                    if (!this.validateFile(event, file)) {
                        return;
                    }

                    if (!this.enableCrop || typeof Cropper === 'undefined') {
                        this.setPreview(file);
                        return;
                    }

                    this.openCropper(file);
                },

                openCropper(file) {
                    if (this.cropSourceUrl) {
                        URL.revokeObjectURL(this.cropSourceUrl);
                    }

                    this.cropSourceUrl = URL.createObjectURL(file);
                    this.showCropper = true;
                    this.zoomRatio = 1;

                    this.$nextTick(() => {
                        const imageEl = this.$refs.cropperImage;
                        imageEl.src = this.cropSourceUrl;

                        imageEl.onload = () => {
                            if (this.cropper) {
                                this.cropper.destroy();
                            }

                            this.cropper = new Cropper(imageEl, {
                                aspectRatio: this.aspectRatio,
                                viewMode: 1,
                                dragMode: 'move',
                                autoCropArea: 1,
                                responsive: true,
                                restore: false,
                                zoomOnWheel: true,
                                movable: true,
                                cropBoxMovable: true,
                                cropBoxResizable: true,
                                toggleDragModeOnDblclick: false,
                            });
                        };
                    });
                },

                zoomTo(value) {
                    if (!this.cropper) {
                        return;
                    }
                    this.cropper.zoomTo(Number(value));
                },

                applyCrop() {
                    if (!this.cropper) {
                        return;
                    }

                    // Export fixed integer dimensions. Cropper's natural canvas can
                    // round each side independently (for example 1279x719), which
                    // looks like 16:9 but fails Laravel's strict ratio validation.
                    const outputWidth = 1280;
                    const outputHeight = Math.round(outputWidth / this.aspectRatio);
                    const canvas = this.cropper.getCroppedCanvas({
                        width: outputWidth,
                        height: outputHeight,
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                        fillColor: '#fff',
                    });
                    if (!canvas) {
                        return;
                    }

                    canvas.toBlob((blob) => {
                        if (!blob) {
                            return;
                        }

                        const originalName = this.$refs.pictureInput.files[0]?.name || 'course-image.jpg';
                        const baseName = originalName.replace(/\.[^.]+$/, '');
                        const croppedFile = new File([blob], `${baseName}-cropped.jpg`, { type: 'image/jpeg' });

                        const dt = new DataTransfer();
                        dt.items.add(croppedFile);
                        this.$refs.pictureInput.files = dt.files;

                        this.setPreview(croppedFile);
                        this.closeCropper(false);
                    }, 'image/jpeg', 0.92);
                },

                cancelCrop() {
                    this.closeCropper(true);
                },

                closeCropper(clearInput = false) {
                    this.showCropper = false;

                    if (this.cropper) {
                        this.cropper.destroy();
                        this.cropper = null;
                    }

                    if (this.cropSourceUrl) {
                        URL.revokeObjectURL(this.cropSourceUrl);
                        this.cropSourceUrl = null;
                    }

                    if (clearInput) {
                        this.$refs.pictureInput.value = '';
                    }
                },

                setPreview(file) {
                    const src = URL.createObjectURL(file);
                    this.$refs.preview.src = src;
                }
            }
        }
    </script>
</div>
