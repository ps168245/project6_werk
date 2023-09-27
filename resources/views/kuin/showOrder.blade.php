<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Order id: {{$order['id']}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="flex flex-col">
                            <h1 class="font-bold text-xl">Order informatie</h1>
                            <table class="flex">
                                <tr>
                                    <td>
                                        Naam:
                                    </td>
                                    <td>
                                        Order id: {{$order['id']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Gebruikers id:
                                    </td>
                                    <td>
                                        {{$order['user_id']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Status:
                                    </td>
                                    <td>
                                        {{$order['status']}}
                                    </td>
                                </tr>
                            </table>
                            <h1 class="font-bold text-xl pt-4">Orderregel:</h1>
                            <table class="flex">
                                @foreach($orderitems->json() as $orderitem)
                                <tr>
                                    <td><a href="{{route('kuin.show',[$orderitem['product_id']])}}">Product id: {{$orderitem['product_id']}}</a></td>
                                    <td><a href="{{route('kuin.show',[$orderitem['product_id']])}}">| Aantal: {{$orderitem['quantity']}}</a></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>