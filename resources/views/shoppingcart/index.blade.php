<script>
    function countPrice(rowID) {
        let amount = parseFloat(document.getElementById("amount" + rowID).value);
        let price = parseFloat(document.getElementById("price" + rowID).textContent);
        if (amount >= 1) {

            let pricetotal = amount * price;
            document.getElementById("checkmark" + rowID).style.visibility = "visible";
            document.getElementById("pricetotal" + rowID).textContent = pricetotal;
        } else {
            document.getElementById("amount" + rowID).value = 1;
            countPrice(rowID);
        }
    }
</script>
<x-app-layout>
    <?php
    global $_totalprice;
    // Start the session
    session_start();
    ?>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Winkelwagen') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    @if(empty(session()->get('cart')))
                        <p>Winkelwagen leeg</p>
                    @endif
                    @if (!empty(session()->get('cart')))
                        <div class="w-full content-evenly border-b-2">
                            @foreach (session()->get('cart') as $cart)
                                <div class="grid grid-cols-3 sm:grid-cols-4 border-t-2 mb-2  items-center">
                                    <p class="text-center mx-auto hidden">{{$cart[0]->id}}</p>
                                    <p class="text-center mx-auto  col-span-3 sm:col-span-1">{{$cart[0]->name}} <img alt="Foto{{$cart[0]->name}}" src="{{$cart[0]->image}}" class="w-20 h-20 mx-auto"></p>
                                    <div class="text-center ">
                                        <label class="text-xs sm:text-lg md:text-lg"
                                               for="amount{{$cart[0]->id}}">Aantal</label>
                                        <form class=" items-center m-0"
                                              action="{{route('shoppingcart.update',[$cart[0]->id])}}" method="post">
                                            @csrf
                                            @method('patch')
                                            <input class="w-fit h-fit text-center" id="amount{{$cart[0]->id}}" name="amount" onchange="countPrice('{{$cart[0]->id}}');" type="number" min="1" max="{{$cart[0]->stock}}" onkeypress="return false" value="{{$cart[0]->amount}}"/>
                                            <button>
                                                <label style="visibility: hidden;" id="checkmark{{$cart[0]->id}}"><i
                                                        class="fa-solid fa-check"></i></label></button>
                                        </form>

                                    </div>
                                    <div>
                                        <p class="text-center">Subtotaal</p>
                                        <p class="text-center mx-auto">€<span
                                                id="pricetotal{{$cart[0]->id}}">{{$cart[0]->amount * $cart[0]->price}}</span>
                                        </p>
                                    </div>
                                    <p class="text-center hidden mx-auto">€<span
                                            id="price{{$cart[0]->id}}">{{$cart[0]->price}}</span></p>


                                    <x-primary-button class="text-center mx-auto bg-red-600 hover:bg-red-900">
                                        <a href="{{ route('shoppingcart.removeFromCart', $cart[0]->id) }}"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                    </x-primary-button>

                                </div>

                                @php($_totalprice += ($cart[0]->amount * $cart[0]->price))
                            @endforeach
                        </div>
                        <h2 class="text-2xl">Totaal prijs: </h2>
                        <p class="text-xl">€{{ $_totalprice }}</p>
                        <x-primary-button class="bg-emerald-600 hover:bg-emerald-900"><a
                                href="{{ route('shoppingcart.afronden') }}">{{ __('Bestellen') }}</a></x-primary-button>
                        <x-primary-button class="bg-red-600 hover:bg-red-900"><a
                                href="{{ route('shoppingcart.emptyCart') }}">{{ __('Leegmaken') }}</a>
                        </x-primary-button>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
