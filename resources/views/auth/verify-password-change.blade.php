<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <x-application-logo />
        </x-slot>

        <div class="font-bold text-gray-600">
            {{ __('If you seeing this page, means you forcely need to change your current password') }}
        </div>

        <x-auth-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-6 flex flex-col justify-between">
            <form method="POST" action="{{ route('password_change.send') }}">
                @csrf
                <div class="block">
                    <x-label for="current_password" :value="__('Current Password')" />
                    <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="mt-4 flex flex-end">
                    <x-button type="submit">
                        {{ __('Change Password') }}
                    </x-button>
                </div>
            </form>

            <hr class="my-6">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
