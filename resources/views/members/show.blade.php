<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>Naam: {{$user->name}}</p>
                <p>Geboortedatum: {{$user->dateOfBirth}}</p>
                <p>E-mail adres: {{$user->email}}</p>
                <br />
                <p class="font-bold">Rollen:</p>    
                @foreach($user->roles as $role)
                    <div class="container">
                        <div class=" grid grid-cols-1 md:grid-cols-6">
                            {{ $role->name }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>