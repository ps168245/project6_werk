<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Personeels informatie dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($users as $user)
                        @checkPermission($user)
                        <div class="container">
                            <div class="border-t-2 grid grid-cols-1 md:grid-cols-2">
                                <a class='text-center md:text-left hover:bg-green-300' href="{{route('users.show',[$user->id])}}">
                                    {{ $user->name }}
                                </a>
                                <div class="justify-center md:justify-end flex-col md:flex-row inline-flex gap-1 mt-1 mb-1">
                                    @php($roles = ['Personeel medewerker','admin'])
                                    @hasRolesArray($roles)

                                        @if($user->sick)
                                            <form class="self-center order-2 md:order-1" action="{{ route('sick.destroy', [$user]) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <x-button class=" ml-3 bg-green-500 hover:bg-green-800 w-32">
                                                    {{ __('Beter') }}
                                                </x-button>
                                            </form>

                                        @endif
                                    @endhasRolesArray
                                    <div class="justify-center  order-1 md:order-2 inline-flex gap-1 mt-1 mb-1">

                                    <form action="{{ route('members.edit', [$user]) }}" method="get">
                                        <x-button class="ml-3 bg-blue-500 hover:bg-blue-900 ">
                                            <i class="fa-solid fa-pencil"></i>
                                        </x-button>
                                    </form>
                                    <form action="{{ route('members.destroy', [$user]) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <x-button class="ml-3 bg-red-500 hover:bg-red-800 ">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </x-button>
                                    </form>
                                </div>
                                </div>

                            </div>
                        </div>
                        @endcheckPermission
                    @endforeach
                    <form action="{{ route('members.create') }}">
                        @csrf
                        <x-button class=" mt-1 bg-green-800 hover:bg-green-700">
                            {{__('Toevoegen')}}
                        </x-button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
