@extends('layouts.main')

@section('content')
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <?php
// Start the session
                session_start();
                ?>
                <form method="POST" action="{{ route('shoppingcart.addToCart')}}">
                    <input readonly name="product_id" hidden value="{{$product->id}}">
                    @csrf
                    @method('post')
                    <!-- Check for errors -->
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
                    <!-- Show products -->
                    <div class="grid grid-cols-1 md:grid-cols-5 justify-items-center md:justify-items-none ">
                        <div></div>

                        <div class=" md:col-span-2 ">
                            <h1 class="text-center md:text-left text-4xl mb-3 ">{{$product->name}}</h1>
                            <img class="shadow-2xl m-auto md:m-none w-3/4 md:w-full" src="{{url($product->image)}}" alt="{{url($product->image)}}"/>

                        </div>
                        <div class="flex flex-col w-2/4 md:w-full self-center ml-3">

                            <!-- dag en week aanbieding true -->
                            @if ($product->dag_aanbieding == true || $product->week_aanbieding == true)
                                <h2 class="text-base md:text-l text-gray-600 mb-2 line-through">€ {{$product->price}} </h2>
                                <h2 class="text-lg md:text-xl mb-2">{{$product->percentage_aanbieding}}% Korting! </h2>
                                <h2 class="text-2xl md:text-3xl mb-2 text-emerald-700">
                                    € {{$product->price - (($product->percentage_aanbieding / 100) * $product->price)}}</h2>
                            @else
                                <h2 class="text-2xl md:text-3xl mb-2 text-emerald-700">€ {{$product->price}}</h2>
                            @endif

                            @if($product->stock > 0)
                                @if($product->stock <= 99)
                                    <p class="text-base mb-2">Nog maar {{$product->stock}} op voorraad!</p>
                                @endif
                                <label class="text-base md:text-lg mb-2">Aantal </label>
                                <input class="text-base md:text-lg mb-2" name="amount" type="number" min="1"
                                       max="{{$product->stock}}" value="1">
                                <x-button class="text-lg bg-emerald-500 hover:bg-emerald-800">In winkelwagen</x-button>


                            @else
                                <h2 class="text-2xl text-red-500 mb-2">Niet op voorraad!</h2>
                    @endif
                    </div>
                </form>
                <div class="row-start-4 md:row-start-2 md:col-start-2">
                    <table class="text-base">
                        <caption class="text-2xl">Productspecificaties</caption>
                        <tr>
                            <td>Hoogte:</td>
                            <td>{{$product->height_cm}} cm</td>
                        </tr>
                        <tr>
                            <td>Breedte:</td>
                            <td>{{$product->width_cm}} cm</td>
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
                            <td>EAN:</td>
                            <td>{{$product->EAN}}</td>
                        </tr>
                        <tr>
                            <td>SKU:</td>
                            <td>{{$product->SKU}}</td>
                        </tr>
                    </table>
                </div>
                <div class="row-start-5 md:row-start-3 md:col-start-2 md:col-end-3">
                    <h2 class=" text-2xl">Productbeschrijving</h2>
                    <p class="text-lg mb-2">{{$product->description}}</p>
                    <br>
                </div>
            </div>

        </div>
    </div>


@endsection
