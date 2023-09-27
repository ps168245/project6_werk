<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Foto's") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-wrap  text-gray-900 dark:text-gray-100">
                    <div class="flex flex-wrap gap-4 justify-center">
                        @foreach($images as $image)
                        <form action="{{ route('images.destroy',[basename($image)])}}" method="post">
                            @method('delete')
                            @csrf
                            <img alt="{{basename($image)}}" class="object-cover w-40 h-40" src="../img/products/{{ basename($image) }}">
                            <x-button class="w-full bg-red-500 justify-center">
                                <p>Verwijder</p>
                            </x-button>
                        </form>
                        @endforeach
                    </div>
                    <br />
                    <form action="{{ route('images.create') }}" class="text-center md:text-left lg:text-left w-full pt-4">
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
