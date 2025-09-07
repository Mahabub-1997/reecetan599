
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-indigo-700 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-purple-100 via-pink-50 to-indigo-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Update Profile Information -->
            <div class="bg-white shadow-lg sm:rounded-xl border-l-8 border-indigo-500 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center w-full bg-indigo-100 p-3 rounded-t-lg mb-4">
                    <svg class="w-6 h-6 text-indigo-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5.121 17.804A13.937 13.937 0 0112 15c2.548 0 4.91.636 6.879 1.804M12 12a4 4 0 100-8 4 4 0 000 8z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-indigo-700">Update Profile</h3>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white shadow-lg sm:rounded-xl border-l-8 border-green-500 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center w-full bg-green-100 p-3 rounded-t-lg mb-4 border-l-4 border-green-500">
                    <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3 1.343 3 3 3 3-1.343 3-3z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 11v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-green-700">Update Password</h3>
                </div>

                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white shadow-lg sm:rounded-xl border-l-8 border-red-500 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center w-full bg-red-100 p-3 rounded-t-lg mb-4 border-l-4 border-red-500">
                    <svg class="w-6 h-6 text-red-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-red-700">Delete Account</h3>
                </div>

                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
