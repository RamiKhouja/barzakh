<x-admin-layout>
    <div class="mx-auto max-w-5xl py-6">
        <div class="grid gap-6">
            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400 sm:p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400 sm:p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
