<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$category->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="flex flex-col">
                            <h1 class="font-bold text-xl">Categorie informatie</h1>
                            <table class="max-w-fit">
                                <tr>
                                    <td>Naam:</td>
                                    <td>
                                        {{$category->name}}
                                    </td>
                                </tr>
                            </table>
                            <h1 class="font-bold text-xl pt-4">Verbonden producten:</h1>
                            <div class="flex gap-2 flex-wrap">
                                @foreach($category->products as $product)
                                <div>
                                    <p class="">{{$product->name}}</p>
                                    <img class="w-40 h-40 object-cover" src="{{$product->image}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>