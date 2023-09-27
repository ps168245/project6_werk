<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-wrap text-gray-900 dark:text-gray-100">
                    @foreach ($orders->json() as $order)
                    <div class="container w-40 mr-8 my-1">
                        <div class="flex flex-col md:grid-cols-6">
                            <a class='hover:bg-green-300 text-center border-2' href="{{route('kuin.showOrder',[$order['id']])}}">
                                <p>Order id: {{ $order['id'] }}</p>
                                <p>Status: {{ $order['status'] }}</p>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>