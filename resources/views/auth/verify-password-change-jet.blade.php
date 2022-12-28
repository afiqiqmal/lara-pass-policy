<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('If you seeing this page, means you forcely need to change your current password') }}
        </div>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-4">
            <form method="POST" action="{{ route('password_change.send') }}">
                @csrf

                <div>
                    <div class="block">
                        <x-jet-label for="current_password" value="{{ __('Current Password') }}" />
                        <x-jet-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4 mx-auto text-center">
                        <x-jet-button type="submit">
                            {{ __('Change Password') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4 float-right">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
