<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rooster') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <script>
            function closeDialog() {
                try {
                    const dialog = document.querySelector('#createSchedule');
                    dialog.close();
                } catch (err) {
                    console.log(err);
                }
            }
        </script>
        @php($x = ['Manager','Admin'])
        @hasRolesArray($x)
        <dialog id="createSchedule">
            <button onclick="closeDialog()" style="float: right;">x</button>
            <form action="{{ route('schedule.store') }}" method="post" class="space-y-4">
                @csrf
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Selecteer Gebruiker:</label>
                    <select required name="user_id" id="user_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Selecteer gebruiker</option>
                        @foreach ($users as $user)
                        @checkPermission($user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endcheckPermission
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="startTime" class="block text-sm font-medium text-gray-700">Starttijd:</label>
                    <input type="datetime-local" id="startTime" name="startTime" required class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="endTime" class="block text-sm font-medium text-gray-700">Eindtijd:</label>
                    <input type="datetime-local" id="endTime" name="endTime" required class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Locatie:</label>
                    <input type="text" id="location" name="location" required class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Omschrijving:</label>
                    <textarea id="description" name="description" required class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>

                <x-button class="bg-green-800 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                <i class="fa-solid fa-floppy-disk"></i>
                </x-button>
            </form>
        </dialog>
        @endhasRolesArray
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <div class="flex gap-4 place-content-evenly flex-wrap">
                        @foreach ($schedules as $schedule)
                        <div class="bg-gray-100 p-2 rounded-md shadow-md w-[250px] md:w-[350px]">
                            <table class="text-left w-full">
                                <tr>
                                    <th class="font-bold">{{ $schedule->users[0]->name }}</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td class="font-bold">Startdatum:</td>
                                    <td>{{substr($schedule->startTime, 0, 10)}}</td>
                                </tr>
                                <tr>
                                    <td class="font-bold">Starttijd:</td>
                                    <td>{{substr($schedule->startTime, 11, 5)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-bold">Einddatum:</td>
                                    <td>{{substr($schedule->endTime, 0, 10)}}</td>
                                </tr>
                                <tr>
                                    <td class="font-bold">Eindtijd:</td>
                                    <td>{{substr($schedule->endTime, 11, 5)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-bold">Locatie:</td>
                                    <td>{{ $schedule->location }}</td>
                                </tr>
                                <tr>
                                    <td class="font-bold">Omschrijving:</td>
                                    <td>{{ $schedule->description }}</td>
                                </tr>
                            </table>
                            @hasRolesArray($x)
                            <form action="{{ route('schedule.destroy', [$schedule]) }}" method="post" class="float-right">
                                @method('delete')
                                @csrf
                                <x-button class="bg-red-500 hover:bg-red-800">
                                    <i class="fa-solid fa-trash-can"></i>
                                </x-button>
                            </form>
                            @endhasRolesArray
                        </div>
                        @endforeach
                    </div>
                    <div class="flex gap-2 pt-4">
                        @hasRolesArray($x)
                        <x-button class="bg-green-800 hover:bg-green-700" onclick="createSchedule.showModal()">Iemand inplannen</x-button>
                        @endhasRolesArray
                        <form action="{{ route('sick.update', [Auth::user()]) }}" method="post" class="">
                            @csrf
                            @method('patch')
                            <x-button class="bg-yellow-800 hover:bg-yellow-700 text-white rounded-md">
                                {{ __('Ziekmelden') }}
                            </x-button>
                        </form>
                        <p class="text-center" style="line-height: 34px;">
                            @include('layouts.partials.messages')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>