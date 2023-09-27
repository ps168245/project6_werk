@extends('layouts.main')
@section('content')
<?php
// Start the session
session_start();
?>
<div class="grid grid-cols-1 lg:grid-cols-3">
    <!-- Address and Welcome -->
    <div class="col-span-1 order-1 md:order-1 md:text-center">
        <h1 class="text-absolute  text-green-700 font-bold text-5xl">Welkom bij Groene Vingers</h1>
        <div class="ml-auto mr-auto self-center text-5x1 lg:text-10xl col-span-1">
            <p>
                Adress gegevens en telefoonnummer van onze winkels:
            </p>
            <p>
                Oranjestraat 3, 2587 WD, Nuenen, tel: 06-33024999
            </p>
            <p>
                De Bleker 23, 1161 AM, Veldhoven, tel: 06-91204657
            </p>
            <p>
                hopman 34, 3769 DH, Best, tel: 06-44194779
            </p>
        </div>
    </div>
    <div class="self-top text-sm lg:text-10xl order-3 md:order-3">
        <!-- If there are no specials hide it -->
        @if(count($productsWeek) > 0 || count($productsDag) > 0)
        <p class="text-center text-2xl"><a href="{{route('aanbiedingen')}}">Klik hier voor al onze aanbiedingen!</a></p>
        @endif
        @if(count($productsWeek) > 0)
        <!-- Wekelijks -->
{{--        TODO: Fix dat de images scrollable zijn op mobiel.--}}
        <p class="text-center  text-2xl">Wekelijkse aanbieding</p>
        <div class="grid-cols-1 md:grid-cols-2 lg:col-span-3 grid lg:grid-cols-3 justify-items-center mb-2 overflow-x-auto whitespace-nowrap md:whitespace-normal md:overflow-x-hidden grid-rows-1">
            @foreach ($productsWeek->take(3) as $productWeek)
            <a href="{{ route('product.showHome', $productWeek->id) }}">
                <div>
                    <p class="text-lg text-center">{{$productWeek->name}}</p>
                    <img class="shadow-xl m-auto md:m-none w-40 h-40 lg:h-auto lg:w-10/12 aspect-square object-cover" src="{{url($productWeek->image)}}" />
                </div>
            </a>
            @endforeach
        </div>
        @endif
        <!-- If there are no specials hide it -->
        @if(count($productsDag) > 0)
        <!-- Dag -->
        <p class="text-center  text-2xl">Dag aanbieding</p>
        <div class="grid-cols-1 md:grid-cols-2 lg:col-span-3 grid lg:grid-cols-3 justify-items-center mb-10">
            @foreach ($productsDag->take(3) as $productDag)
            <a href="{{ route('product.showHome', $productDag->id) }}">
                <div>
                    <p class="text-lg text-center">{{$productDag->name}}</p>
                    <img class="shadow-xl m-auto md:m-none w-40 h-40 lg:h-auto lg:w-10/12 aspect-square object-cover" src="{{url($productDag->image)}}" />
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
    <!-- Image -->
    <div class="col-span-1 order-2 lg:order-3">
        <img class='m-auto rounded-full border-4 w-6/12 lg:w-8/12 object-cover border-green-700' src="{{url('/img/picture_home.png')}}" alt="Foto buiten">
    </div>
    <!-- Categories -->
    <div class="w-full md:w-auto col-span-1 order-3 md:order-4 lg:col-span-3 justify-self-center">
        <form action="{{route('home')}}">
            <select class="bg-emerald-300 w-full md:w-96 text-center shadow" name="chosenCategorie_id" id="chosenCategorie_id">
                @foreach ($categories as $category)
                @if ($chosenCategorie_id[0] == $category->id)
                <option selected class="bg-emerald-200" value="{{$category->id}}">{{$category->name}}</option>
                @else
                <option class="bg-emerald-200" value="{{$category->id}}">{{$category->name}}</option>
                @endif
                @endforeach
            </select>
        </form>
        <script>
            const selectElement = document.getElementById('chosenCategorie_id');
            selectElement.addEventListener('change', () => {
                const selectedOptionValue = selectElement.value;
                window.location.href = `{{route('home')}}?chosenCategorie_id=${selectedOptionValue}`;
            });
        </script>
    </div>
    <!-- Paginate also known as products -->
    <div class="col-span-1 lg:col-span-3 order-4 md:order-5 grid grid-cols-1 md:grid-cols-5 justify-items-center">
        @foreach ($productsPaginates as $productsPaginate)
        <a href="{{ route('product.showHome', $productsPaginate->id) }}">
            <div>

                <p>{{$productsPaginate->name}}</p>
                <img class="shadow-xl w-40 h-40 md:w-36 md:h-36 lg:w-40 lg:h-40 object-cover" src="{{url($productsPaginate->image)}}" />
            </div>
        </a>
        @endforeach
    </div>
</div>
<div class="d-flex order-4 md:order-7 pagination-centered">
    {{ $productsPaginates->links() }}
</div>
@endsection
