<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Afronden') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    <!-- Request Errors -->
                    <div title="errors">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Adressen</h2>
                    <div title="AddressesDiv" class="box-border text-left inline-flex flex-wrap gap-6 max-w-7xl">
                        @for ($i = 0; $i < $addressLength; $i++) @if($user->default_address == $address[$i]->id)
                            <div title="repeatable tile" class="w-80 h-72 border-4 border-solid flex justify-center flex-col bg-blue-100">
                                @else
                                <div title="repeatable tile" class="w-80 h-72 border-4 border-solid flex justify-center flex-col relative">
                                    <form action="{{route('addresses.setDefault', [$address[$i]->id])}}" method="post">
                                        @method('post')
                                        @csrf
                                        <input class="hidden" name="shop" value="shop">
                                        <button class="text-blue-500 underline hover:text-blue-900 top-2 right-2 absolute">Gebruik dit adres</button>
                                        @endif
                                        <div class="ml-2">
                                            <h1 class="font-bold">{{$address[$i]->name}}</h1>
                                            <h2>{{$address[$i]->address}} {{$address[$i]->housenumber}}</h2>
                                            <h2>{{$address[$i]->postcode}}, {{$address[$i]->region}}, {{$address[$i]->province}}</h2>
                                            <h2>{{$address[$i]->country}}</h2>
                                            <h2>Telefoonnummer: {{$address[$i]->phonenumber}}</h2>
                                        </div>
                                    </form>
                                </div>
                                @endfor
                                <a href="{{ route('addresses.create') }}">
                                    <div title="firstAddressTile" class="w-80 h-72 border-4 border-dashed flex items-center justify-center flex-col">
                                        <img src="{{url('/img/AddAddressGreenPlus.png')}}" class="w-12 h-12 mx-auto">
                                        <h2>Adres Toevoegen</h2>
                                    </div>
                                </a>
                            </div>
                            <form method="POST" action="{{ route('shoppingcart.betalen') }}">
                                @csrf
                                @method('post')
                                <!-- Bestel button -->
                                <x-button class="mt-2">
                                    {{ __('Bestellen en betalen') }}
                                </x-button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>