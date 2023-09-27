<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$product['name']}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="flex flex-col">
                            <h1 class="font-bold text-xl">Product informatie</h1>
                            <table>
                                <tr>
                                    <td>Naam:</td>
                                    <td>
                                        {{$product['name']}}
                                    </td>
                                    <td>Foto:</td>
                                </tr>
                                <tr>
                                    <td>Beschrijving:</td>
                                    <td>
                                        {{$product['description']}}
                                    </td>
                                    <td rowspan="10"><img src="{{$product['image']}}" alt="{{$product['name']}}" class="w-40 h-40"></td>
                                </tr>
                                <tr>
                                    <td>Prijs:</td>
                                    <td>{{$product['price']}}</td>
                                </tr>
                                <tr>
                                    <td>Kleur:</td>
                                    <td>{{$product['color']}}</td>
                                </tr>
                                <tr>
                                    <td>Hoogte:</td>
                                    <td>{{$product['height_cm']}} cm</td>
                                </tr>
                                <tr>
                                    <td>Breedte:</td>
                                    <td>{{$product['width_cm']}} cm</td>
                                </tr>
                                <tr>
                                    <td>Diepte:</td>
                                    <td>{{$product['depth_cm']}} cm</td>
                                </tr>
                                <tr>
                                    <td>Gewicht:</td>
                                    <td>{{$product['weight_gr']}} gram</td>
                                </tr>
                            </table>

                            <form method="POST" action="{{ route('kuin.store')}}">
                                @csrf
                                @method('post')
                                <input class="hidden" name="product_id" value="{{$product['id']}}">
                                <input name="quantity" type="number" min="1" value="1">
                                <x-button class="text-lg mx-auto">Bestellen bij Kuin</x-button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>