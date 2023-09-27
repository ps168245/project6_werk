<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Geschiedenis') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    @if(empty($orders[0]))
                    <h1>U heeft nog niks besteld.</h1>
                    @else
                    @foreach($orders as $order)
                    <div class="border-4 border-solid mb-2">
                        <h1 class="font-bold">Order: {{$order->id}} | Totaal prijs: {{$order->total}} | Order gemaakt door: {{$order->user->name}} | Status: {{$order->status}}
                            @if($order->link != null)
                            | <a href="{{$order->link}}" class="underline text-blue-500">Betalen?</a>
                            @endif
                            <form action="{{ route('shoppingcart.generatePDF', $order->id) }}">
                                @csrf
                                <x-button class="bg-gray-400 hover:bg-gray-600 float-right mr-2">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </x-button>
                            </form>
                        </h1>
                        @foreach($order->orderlines as $orderline)
                        <h2 class="ml-4">{{$orderline->product->name}} | Aantal: {{$orderline->amount_orderd}} | Per stuk: €{{$orderline->price}}</h2>
                        @endforeach
                        <h2>Verzonden naar: {{$order->address->name}}, {{$order->address->address}} {{$order->address->housenumber}}, {{$order->address->postcode}}, {{$order->address->country}}</h2>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>