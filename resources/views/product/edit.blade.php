<x-applayout>
    <script>
        function changeImage() {
            let chosenImage = document.getElementById('selectImg').value;
            document.getElementById('img').src = "../../img/products/" + chosenImage;
        }
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product wijzigen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    <form method="post" action="{{ route('products.update', ['product' => $product]) }}">
                        @csrf
                        @method('put')
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
                        <table>
                            <tr>
                                <td>
                                    <label for="name">Naam:</label>
                                </td>
                                <td>
                                    <input required type="text" id="name" name="name" class="w-96" value="{{$product->name}}">
                                </td>
                                <td class="pl-10" rowspan="100">
                                    <img class="w-96 h-96 border-2 border-green-400" id="img" src="../../img/products/{{ basename($images[0]) }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="description">Beschrijving:</label>
                                </td>
                                <td>
                                    <textarea class="w-96 h-32" type="text" id="description" name="description">{{$product->description}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="image">Foto link:</label>
                                </td>
                                <td>
                                    <select name="image" id="selectImg" class="w-96" onchange="changeImage()">
                                        @foreach($images as $image)
                                        <option>{{ basename($image) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="price">Prijs:</label>
                                </td>
                                <td>
                                    <input required type="number" step=".01" id="price" name="price" class="w-96" value="{{$product->price}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="suppliers_price">Leveranciers prijs:</label>
                                </td>
                                <td>
                                    <input required type="number" step=".01" id="suppliers_price" name="suppliers_price" class="w-96" value="{{$product->suppliers_price}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="stock">Voorraad:</label>
                                </td>
                                <td>
                                    <input required type="number" id="stock" name="stock" class="w-96" value="{{$product->stock}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="EAN">EAN:</label>
                                </td>
                                <td>
                                    <input required type="text" id="EAN" name="EAN" class="w-96" value="{{$product->EAN}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="height_cm">Hoogte in cm:</label>
                                </td>
                                <td>
                                    <input required type="number" id="height_cm" name="height_cm" class="w-96" value="{{$product->height_cm}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for=" width_cm">Breedte in cm:</label>
                                </td>
                                <td>
                                    <input required min="0" type="number" id="width_cm" name="width_cm" class="w-96" value="{{$product->width_cm}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for=" depth_cm">Diepte in cm:</label>
                                </td>
                                <td>
                                    <input required min="0" type="number" id="depth_cm" name="depth_cm" class="w-96" value="{{$product->depth_cm}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for=" weight_gr">Gewicht in gram:</label>
                                </td>
                                <td>
                                    <input required min="0" type="number" id="weight_gr" name="weight_gr" class="w-96" value="{{$product->weight_gr}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for=" percentage_aanbieding">Percentage aanbieding:</label>
                                </td>
                                <td>
                                    <input required type="number" max="100" id="percentage_aanbieding" name="percentage_aanbieding" class="w-96" value="{{$product->percentage_aanbieding}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Aanbieding actief:</label>
                                </td>
                                <td>
                                    <input type="checkbox" id="dag_aanbieding" name="dag_aanbieding" @if($product->dag_aanbieding == 1) checked @endif>
                                    <label for="dag_aanbieding">Dag aanbieding</label>
                                    <div class="float-right">
                                        <input type="checkbox" id="week_aanbieding" name="week_aanbieding" @if($product->week_aanbieding == 1) checked @endif>
                                        <label for="week_aanbieding">Week aanbieding</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div class="flex items-center mt-4">
                            <x-button>
                                {{ __('Product wijzigen') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>