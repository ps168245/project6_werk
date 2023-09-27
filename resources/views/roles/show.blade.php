<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Leden van '), }}{{$role->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach($role->users as $user)
                        <div class="container">
                            <div class=" grid grid-cols-1 md:grid-cols-6">
                                <a class='hover:bg-green-300' href="{{route('users.show',[$user])}}">
                                    {{ $user->name }}
                                </a>
                                <div class="inline-flex gap-1 mb-1">
                                    <form action="{{ route('users.edit', [$user]) }}" method="get">
                                        <x-button class="ml-3 bg-blue-500 hover:bg-blue-900 ">
                                            <i class="fa-solid fa-pencil"></i>
                                        </x-button>

                                    </form>
                                </div>

                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
