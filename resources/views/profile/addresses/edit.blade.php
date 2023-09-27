<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adres Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('addresses.update', [$id]) }}">
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
                                    <input required type="text" id="name" name="name" value="{{ $address->name }}" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="postcode">Postcode</label>
                                </td>
                                <td>
                                    <input required onkeyup="checkTabPress(event)" onfocusout="checkPostcodeAndHomenumber()" placeholder="1234AA" type="text" id="postcode" name="postcode" value="{{ $address->postcode }}" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="housenumber">Huisnummer:</label>
                                </td>
                                <td>
                                    <input required onkeyup="checkTabPress(event)" onfocusout="checkPostcodeAndHomenumber()" type="text" id="housenumber" name="housenumber" value="{{ $address->housenumber }}" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="address">Straat:</label>
                                </td>
                                <td>
                                    <input required type="text" id="address" name="address" value="{{ $address->address }}" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="region">Stad:</label>
                                </td>
                                <td>
                                    <input required type="text" id="region" name="region" value="{{ $address->region }}" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="province">Provincie:</label>
                                </td>
                                <td>
                                    <input required type="text" id="province" name="province" value="{{ $address->province }}" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="country">Land:</label>
                                </td>
                                <td>
                                    <input required type="text" id="country" name="country" value="{{ $address->country }}" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phonenumber">Telefoonnummer:</label>
                                </td>
                                <td>
                                    <input required type="text" id="phonenumber" name="phonenumber" value="{{ $address->phonenumber }}" class="w-64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="instructions">Instructies:</label>
                                </td>
                                <td>
                                    <textarea class="w-64 h-32" type="text" id="instructions" name="instructions">{{$address->instructions}}</textarea>
                                </td>
                            </tr>
                        </table>
                        <div class="flex items-center mt-4">
                            <x-button>
                                {{ __('Adres Bewerken') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>