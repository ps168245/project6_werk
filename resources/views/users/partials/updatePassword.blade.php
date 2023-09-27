<form method="post" action="{{ route('users.update', ['user' => $user]) }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />

        <x-input-error class="mt-2" :messages="$errors->get('email')" />


    </div>

    <div class="flex items-center gap-4">
        <x-primary-button class="mt-1 bg-green-800 hover:bg-green-700">{{ __('Opslaan') }}</x-primary-button>

        @if (session('status') === 'user-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>
