<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$product->name}}
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
                                        {{$product->name}}
                                    </td>
                                    <td rowspan="7">Foto:<br/><img src="{{$product->image}}" alt="{{$product->name}}" class="w-40 h-40"></td>
                                </tr>
                                <tr>
                                    <td>Beschrijving:</td>
                                    <td>
                                        {{$product->description}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prijs:</td>
                                    <td>{{$product->price}}</td>
                                </tr>
                                <tr>
                                    <td>Leveranciers prijs:</td>
                                    <td>{{$product->suppliers_price}}</td>
                                </tr>
                                <tr>
                                    <td>Voorraad:</td>
                                    <td>{{$product->stock}}</td>
                                </tr>
                                <tr>
                                    <td>EAN:</td>
                                    <td>{{$product->EAN}}</td>
                                </tr>
                                <tr>
                                    <td>SKU:</td>
                                    <td>{{$product->SKU}}</td>
                                </tr>
                                <tr>
                                    <td>Hoogte:</td>
                                    <td>{{$product->height_cm}} cm</td>
                                </tr>
                                <tr>
                                    <td>Breedte:</td>
                                    <td>{{$product->width_cm}} cm</td>
                                    <td rowspan="6"><img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{$product->SKU}}" alt="{{$product->name}} qr code" class="w-40 h-40"></td>
                                </tr>
                                <tr>
                                    <td>Diepte:</td>
                                    <td>{{$product->depth_cm}} cm</td>
                                </tr>
                                <tr>
                                    <td>Gewicht:</td>
                                    <td>{{$product->weight_gr}} gram</td>
                                </tr>
                                <tr>
                                    <td>Aanbiedings percentage:</td>
                                    <td>{{$product->percentage_aanbieding}}%</td>
                                </tr>
                                <tr>
                                    <td>Dag aanbieding:</td>
                                    @if($product->dag_aanbieding == 0)
                                    <td>nee</td>
                                    @else
                                    <td>ja</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Week aanbieding:</td>
                                    @if($product->week_aanbieding == 0)
                                    <td>nee</td>
                                    @else
                                    <td>ja</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Laatst gewijzigd door:</td>
                                    <td>{{$product->lastEditedBy()->get()[0]->name}}</td>
                                </tr>
                            </table>
                            <div ></div>
                            <?php echo '<img class="w-3/4 h-28 mx-auto" src="data:image/png;base64,' . DNS1D::getBarcodePNG($product->SKU, 'C128') . '" alt="barcode van '.$product->name.'"   />';?>
                            <h1 class="font-bold text-xl pt-4">Verbonden aan:</h1>
                            <table class="flex">
                                @foreach($product->categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td class="pl-5">
                                        <form method="post" action="{{ route('products.removeCategoryFromProduct',['product' => $product, 'category' => $category])}}">
                                            @csrf
                                            @method('post')
                                            <x-button class="bg-red-400 hover:bg-red-600">
                                                <i class="fa-solid fa-trash">
                                                </i>
                                            </x-button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div class="flex">
                                @if(count($categories) > count($product->categories))
                                <form method="post" action="{{ route('products.addCategoryFromProduct', ['product' => $product]) }}">
                                    @csrf
                                    @method('post')
                                    <select name="category" class="w-min">
                                        @foreach($categories as $category)
                                        @php
                                        $isLinked = false;
                                        @endphp
                                        @foreach($product->categories as $test)
                                        @if($category->id == $test->id)
                                        @php
                                        $isLinked = true;
                                        break;
                                        @endphp
                                        @endif
                                        @endforeach
                                        @unless($isLinked)
                                        <option value="{{$category->id}}"> {{$category->name}} </option>
                                        @endunless
                                        @endforeach
                                    </select>
                                    <x-button class="bg-green-400 hover:bg-green-600">
                                        <i class="fa-sharp fa-solid fa-plus"></i>
                                    </x-button>
                                </form>
                                @endif
                            </div>
                            <div>
                                <h1 class="font-bold text-xl pt-4">Alle prijzen:</h1>
                                <table>
                                    @foreach($product->prices()->get() as $price)
                                    <tr>
                                        <td>Prijs:</td>
                                        <td>€{{$price->price}}</td>
                                        <td>Aangemaakt op:</td>
                                        <td>{{$price->created_at}}</td>
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
