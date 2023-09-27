<x-app-layout>
    <script>
        //DDWM Bas
        async function checkPostcodeAndHomenumber() {
            //Guards to check if postcode and homenumber and not empty
            if (!document.getElementById("postcode").value) {
                return;
            }
            if (!document.getElementById("housenumber").value) {
                return;
            }
            //Two values needed for the API
            let postcode = document.getElementById("postcode").value;
            let homenumber = document.getElementById("housenumber").value;
            //get data from API
            const data = await getData(postcode, homenumber);
            //If postcode or housenumber is invalid return or combination has no result
            if ("The given data was invalid." == data.message || "No result for this combination." == data.message) {
                return;
            }
            //set correct values via API
            document.getElementById("address").value = data.street;
            document.getElementById("region").value = data.city;
            document.getElementById("province").value = data.province;
            document.getElementById("country").value = "Nederland";
            
            document.getElementById("address").readOnly = true;
            document.getElementById("region").readOnly = true; 
            document.getElementById("province").readOnly = true; 
            document.getElementById("country").readOnly = true; 
        }

        async function getData(postcode, homenumber) {
            const response = await fetch('https://postcode.tech/api/v1/postcode/full?postcode=' + postcode + '&number=' + homenumber, {
                method: 'get',
                headers: new Headers({
                    'Authorization': 'Bearer 92ef081a-6513-4548-b912-79031ee10b3e',
                }),
            });
            return response.json();
        }

        function checkTabPress(e) {
            if (e.key == "Tab") {
                checkPostcodeAndHomenumber();
            } else {
                return;
            }
        }
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adres Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        @method('post')
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
                                    <input required type="text" id="name" name="name" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="postcode">Postcode</label>
                                </td>
                                <td>
                                    <input required onkeyup="checkTabPress(event)" onfocusout="checkPostcodeAndHomenumber()" placeholder="1234AA" type="text" id="postcode" name="postcode" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="housenumber">Huisnummer:</label>
                                </td>
                                <td>
                                    <input required onkeyup="checkTabPress(event)" onfocusout="checkPostcodeAndHomenumber()" type="text" id="housenumber" name="housenumber" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="address">Straat:</label>
                                </td>
                                <td>
                                    <input required type="text" id="address" name="address" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="region">Stad:</label>
                                </td>
                                <td>
                                    <input required type="text" id="region" name="region" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="province">Provincie:</label>
                                </td>
                                <td>
                                    <input required type="text" id="province" name="province" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="country">Land:</label>
                                </td>
                                <td>
                                    <input required type="text" id="country" name="country" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phonenumber">Telefoonnummer:</label>
                                </td>
                                <td>
                                    <input required type="text" id="phonenumber" name="phonenumber" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="instructions">Instructies:</label>
                                </td>
                                <td>
                                    <textarea class="w-64 h-32" type="text" id="instruction" name="instructions"></textarea>
                                </td>
                            </tr>
                        </table>
                        <div class="flex items-center mt-4">
                            <x-button>
                                {{ __('Adres Toevoegen') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>