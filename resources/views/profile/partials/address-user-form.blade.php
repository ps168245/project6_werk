<section>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Adressen</h2>
    <div title="AddressesDiv" class="box-border text-left inline-flex flex-wrap gap-6">

        <a href="{{ route('addresses.create') }}">
            <div title="firstAddressTile" class="w-80 h-72 border-4 border-dashed flex items-center justify-center flex-col">
                <img src="{{url('/img/AddAddressGreenPlus.png')}}" class="w-12 h-12 mx-auto">
                <h2>Adres Toevoegen</h2>
            </div>
        </a>
        @for ($i = 0; $i < $addressLength; $i++) 
        <div title="repeatable tile" class="w-80 h-72 border-4 border-solid flex justify-center flex-col">
            <div class="ml-2">
                <h1 class="font-bold">{{$address[$i]->name}} 
            @if($user->default_address == $address[$i]->id)        
                <p class="inline float-right mr-2 text-red-400">Default</p>
            @endif
            </h1>
                <h2>{{$address[$i]->address}} {{$address[$i]->housenumber}}</h2>
                <h2>{{$address[$i]->postcode}}, {{$address[$i]->region}}, {{$address[$i]->province}}</h2>
                <h2>{{$address[$i]->country}}</h2>
                <h2>Telefoonnummer: {{$address[$i]->phonenumber}}</h2>
                <br /><br /><br /><br /><br />
                <div class="flex gap-2">
                    <form action="{{route('addresses.edit', [$address[$i]->id])}}" method="get">
                        <button class="text-blue-500 underline hover:text-blue-900">Bewerken</button>
                    </form>
                    |
                    <form action="{{route('addresses.destroy', [$address[$i]]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="text-blue-500 underline hover:text-blue-900">Verwijderen</button>
                    </form>
                    @if($user->default_address != $address[$i]->id)
                    |
                    <form action="{{route('addresses.setDefault', [$address[$i]->id])}}" method="post">
                        @method('post')
                        @csrf
                        <button class="text-blue-500 underline hover:text-blue-900">Set Default</button>
                    </form>
                    @endif
                </div>
            </div>
    </div>
    @endfor
    </div>
</section>