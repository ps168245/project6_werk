
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('gebruikers dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($users as $user)
                        <div class="container">
                            <div class="border-t-2 grid grid-cols-1 md:grid-cols-2">
                                <a class='text-center md:text-left hover:bg-green-300' href="{{route('users.show',[$user->id])}}">
                                    {{ $user->name }}
                                </a>
                                <div class="justify-center md:justify-end inline-flex gap-1 mt-1 mb-1">
                                    <form action="{{ route('users.edit', [$user]) }}" method="get">
                                        <x-button class="ml-3 bg-blue-500 hover:bg-blue-900 ">
                                            <i class="fa-solid fa-pencil"></i>
                                        </x-button>
                                    </form>
                                    <form action="{{ route('users.destroy', [$user]) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <x-button class="ml-3 bg-red-500 hover:bg-red-800 ">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </x-button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <form class="border-t-2" action="{{ route('users.create') }}">
                        @csrf
                        <x-button class=" mt-1 bg-green-800 hover:bg-green-700">
                            {{__('Toevoegen')}}
                        </x-button>
                    </form>
<br>
                    <form action="{{ route('users.export') }}">
                        @csrf
                        <x-button class="bg-gray-400 hover:bg-gray-600">
                            <i class="fa-solid fa-file-export"></i> {{__('Export gebruikers')}}
                        </x-button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
