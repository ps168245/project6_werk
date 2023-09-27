<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-wrap text-gray-900 dark:text-gray-100">
                    @foreach ($products->json() as $product)
                    <div class="container w-40 mr-8 my-1">
                        <div class="flex flex-col md:grid-cols-6">
                            <a class='hover:bg-green-300 text-center' href="{{route('kuin.show',[$product['id']])}}">
                                <p class="" style="height: 50px;">{{ $product['name'] }}</p>
                                <img class="w-40 h-40 object-cover" src="{{$product['image']}}" alt="{{$product['name']}}">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>