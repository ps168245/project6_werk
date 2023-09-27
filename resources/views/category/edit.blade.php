<x-applayout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorie wijzigen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    <form method="post" action="{{ route('categories.update', ['category' => $category]) }}">
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
                                    <input required type="text" id="name" name="name" class="w-96" value="{{$category->name}}">
                                </td>
                            </tr>
                        </table>
                        <div class="flex items-center mt-4">
                            <x-button>
                                {{ __('Categorie wijzigen') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </x-app-layout>