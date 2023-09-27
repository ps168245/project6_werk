@extends('layouts.main')

@section('content')
    <script>
function changeStore(WinkelName){
    console.log(WinkelName);
    //verandert de title van de geselecteerde winkel
    document.getElementById('title').textContent = WinkelName;

    if(WinkelName == "Winkel Nuenen" ) {
        // verandert de src van de iframe naar een ander adres
        document.getElementById('iframe').src = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4026.6288414239366!2d5.538138921955785!3d51.47189493421747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6df559c690611%3A0x4fb0b5b7d6bde042!2sOranjestraat%203%2C%205671%20HH%20Nuenen!5e0!3m2!1snl!2snl!4v1676628491222!5m2!1snl!2snl";
        document.getElementById('openingTimes-nuenen').classList.remove('hidden');
        document.getElementById('openingTimes-veldhoven').classList.add('hidden');
        document.getElementById('openingTimes-best').classList.add('hidden');

    }
    else if(WinkelName == "Winkel Veldhoven"){
        document.getElementById('iframe').src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2488.1062315505405!2d5.385442415632329!3d51.419475179620854!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6da5b3cf762df%3A0x39eb68af047620f8!2sDe%20Bleker%2023%2C%205506%20BA%20Veldhoven!5e0!3m2!1snl!2snl!4v1676628658901!5m2!1snl!2snl";
        document.getElementById('openingTimes-nuenen').classList.add('hidden');
        document.getElementById('openingTimes-veldhoven').classList.remove('hidden');
        document.getElementById('openingTimes-best').classList.add('hidden');



    }
    else {
        document.getElementById('iframe').src = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.440356869178!2d5.379226015635723!3d51.505136679634724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6dcf035f2ef2b%3A0x1ee5ad18dde86c9c!2sHopman%2034%2C%20Best!5e0!3m2!1snl!2snl!4v1676628786980!5m2!1snl!2snl";
        document.getElementById('openingTimes-nuenen').classList.add('hidden');
        document.getElementById('openingTimes-veldhoven').classList.add('hidden');
        document.getElementById('openingTimes-best').classList.remove('hidden');
    }
}
    </script>
    <div class=" grid lg:grid-cols-3 grid-cols-1 min-h-[87vh]">
        <div class="ml-5 mr-5 h-auto">
            <h2 class="text-center text-lg">Selecteer een van de onderstaande winkels:</h2>
       <ul>
            <li><button class="w-full outline-green-700 outline  mt-3 bg-white rounded-xl p-1 hover:bg-green-700  " value="Winkel Nuenen" type="button" onclick="changeStore(this.value)" >Winkel Nuenen</button></li>
           <li> <button  class="w-full outline-green-700 outline mt-3 bg-white rounded-xl p-1  hover:bg-green-700 " value="Winkel Veldhoven" type="button" onclick="changeStore(this.value)" >Winkel Veldhoven</button></li>
           <li>  <button  class="w-full outline-green-700 outline  mt-3 bg-white rounded-xl p-1  hover:bg-green-700 " value="Winkel Best"  type="button" onclick="changeStore(this.value)" >Winkel Best</button></li>
       </ul>
            <br>
            <div class="text-center">
        <h1 class="font-bold text-3xl " id="title" >Winkel Nuenen</h1>
            <h3 class="text-xl">Openingstijden</h3>
            <p id="openingTimes-nuenen" class="">
                Maandag
                10:00-18:00
                <br/>
                Dinsdag
                10:00-18:00
                <br/>
                Woensdag
                10:00-18:00
                <br/>
                Donderdag
                10:00-18:00
                <br/>
                Vrijdag
                10:00-18:00
                <br/>
                Zaterdag
                10:00-17:00
                <br/>
                Zondag
                11:00-17:00
            </p>
                <p id="openingTimes-veldhoven" class="hidden ">


                    Maandag
                    10:00-18:00
                    <br/>
                    Dinsdag
                    10:00-18:00
                    <br/>
                    Woensdag
                    10:00-18:00
                    <br/>
                    Donderdag
                    12:00-18:00
                    <br/>
                    Vrijdag
                    10:00-18:00
                    <br/>
                    Zaterdag
                    10:00-17:00
                    <br/>
                    Zondag
                    12:00-17:00
                </p>
                <p id="openingTimes-best" class="hidden">


                    Maandag
                    10:00-18:00
                    <br/>
                    Dinsdag
                    10:00-18:00
                    <br/>
                    Woensdag
                    10:00-18:00
                    <br/>
                    Donderdag
                    10:00-18:00
                    <br/>
                    Vrijdag
                    10:00-18:00
                    <br/>
                    Zaterdag
                    10:00-17:00
                    <br/>
                    Zondag
                    Gesloten
                </p>
        </div>
        </div>
           <iframe class="w-full h-full col-span-2 self-end " id="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4026.6288414239366!2d5.538138921955785!3d51.47189493421747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6df559c690611%3A0x4fb0b5b7d6bde042!2sOranjestraat%203%2C%205671%20HH%20Nuenen!5e0!3m2!1snl!2snl!4v1676628491222!5m2!1snl!2snl"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">

           </iframe>
        </div>

@endsection
