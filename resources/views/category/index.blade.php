<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorieën') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-wrap text-gray-900 dark:text-gray-100">
                    @foreach ($categories as $category)
                    <div class="container w-40 mr-8 my-1">
                        <div class="flex flex-col md:grid-cols-6">
                            <a class='hover:bg-green-300 text-center' href="{{route('categories.show',[$category->id])}}">
                                {{ $category->name }}<br />
                            </a>
                            <div class="gap-1 mb-1">
                                <form action="{{ route('categories.edit', [$category]) }}" method="get">
                                    <x-button class="bg-blue-500 hover:bg-blue-900 w-40 mb-0.5 justify-center">
                                        {{ __('Wijzig') }}
                                    </x-button>
                                </form>
                                <form action="{{ route('categories.destroy', [$category]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <x-button class=" bg-red-500 hover:bg-red-800 w-40 justify-center">
                                        {{ __('Verwijder') }}
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <form action="{{ route('categories.create') }}" class="w-full">
                        @csrf
                        <x-button class="w-full justify-center bg-green-800 hover:bg-green-700">
                            {{__('Toevoegen')}}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
