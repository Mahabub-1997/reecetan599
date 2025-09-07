{{--<section>--}}
{{--    <header>--}}
{{--        <h2 class="text-lg font-medium text-gray-900">--}}
{{--            {{ __('Update Password') }}--}}
{{--        </h2>--}}

{{--        <p class="mt-1 text-sm text-gray-600">--}}
{{--            {{ __('Ensure your account is using a long, random password to stay secure.') }}--}}
{{--        </p>--}}
{{--    </header>--}}

{{--    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">--}}
{{--        @csrf--}}
{{--        @method('put')--}}

{{--        <div>--}}
{{--            <x-input-label for="update_password_current_password" :value="__('Current Password')" />--}}
{{--            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />--}}
{{--            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <x-input-label for="update_password_password" :value="__('New Password')" />--}}
{{--            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />--}}
{{--            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />--}}
{{--            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />--}}
{{--            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center gap-4">--}}
{{--            <x-primary-button>{{ __('Save') }}</x-primary-button>--}}

{{--            @if (session('status') === 'password-updated')--}}
{{--                <p--}}
{{--                    x-data="{ show: true }"--}}
{{--                    x-show="show"--}}
{{--                    x-transition--}}
{{--                    x-init="setTimeout(() => show = false, 2000)"--}}
{{--                    class="text-sm text-gray-600"--}}
{{--                >{{ __('Saved.') }}</p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</section>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>

    <!-- Tailwind CSS (optional, replace with AdminLTE CSS if you prefer) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md p-8 bg-white shadow-xl rounded-xl">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Update Password</h2>
    <p class="text-center text-gray-500 mb-6 text-sm">
        Ensure your account is using a strong password to stay secure.
    </p>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="current_password" class="block font-medium text-gray-700">Current Password</label>
            <input id="current_password" name="current_password" type="password" placeholder="Enter current password"
                   class="mt-2 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 @error('current_password') border-red-500 @enderror">
            @error('current_password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block font-medium text-gray-700">New Password</label>
            <input id="password" name="password" type="password" placeholder="Enter new password"
                   class="mt-2 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 @error('password') border-red-500 @enderror">
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm new password"
                   class="mt-2 block w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 @error('password_confirmation') border-red-500 @enderror">
            @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg">
                Save Password
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-green-600 text-center mt-2">Password updated successfully! 🎉</p>
            @endif
        </div>
    </form>
</div>

</body>
</html>
