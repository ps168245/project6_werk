@extends('layouts.main')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            @if(count($productsWeek) == 0 && count($productsDag) == 0)
                <h1 class="text-center  text-3xl">Er zijn momenteel geen aanbiedingen</h1>
            @endif
            <div class="self-top text-sm lg:text-10xl">
                <!-- If there are no specials hide it -->
                @if(count($productsWeek) > 0)
                    <!-- Wekelijks -->
                    <h1 class="text-center  text-3xl">Wekelijkse aanbieding</h1>
                    <div
                        class=" grid-cols-1 md:grid-cols-2 lg:col-span-3 grid lg:grid-cols-3 justify-items-center mb-2">
                        @foreach ($productsWeek as $productWeek)
                            <a href="{{ route('product.showHome', $productWeek->id) }}">
                                <div>
                                    <h2 class=" text-xl text-center">{{$productWeek->name}}</h2>
                                    <p class="text-center text-xl text-emerald-900">{{$productWeek->percentage_aanbieding}}
                                        % Korting</p>
                                    <img alt="foto {{$productWeek->name}}" class="shadow-xl w-40 h-40"
                                         src="{{url($productWeek->image)}}"/>

                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
                <!-- If there are no specials hide it -->
                @if(count($productsDag) > 0)
                    <!-- Dag -->
                    <h1 class="text-center  text-3xl">Dag aanbieding</h1>
                    <div class="rid-cols-1 md:grid-cols-2 lg:col-span-3 grid lg:grid-cols-3 justify-items-center mb-10">
                        @foreach ($productsDag as $productDag)
                            <a href="{{ route('product.showHome', $productDag->id) }}">
                                <div>
                                    <p class="text-xl text-center">{{$productDag->name}}</p>
                                    <p class="text-center text-xl text-emerald-900">{{$productDag->percentage_aanbieding}}
                                        % Korting</p>
                                    <img alt="foto {{$productDag->name}}" class="shadow-xl w-40 h-40"
                                         src="{{url($productDag->image)}}"/>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
</div>
        </div>
    </div>

@endsection
