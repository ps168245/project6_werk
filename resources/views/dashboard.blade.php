@php($HighRankEmployeeRoles = ['Manager','Admin','Persooneel medewerker'])
@php($AdminAndManagerRoles = ['Manager','Admin'])
@php($EmployeesOnly = ['Manager','Admin','Medewerker','Kassière','Personeel medewerker'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex w-full justify-evenly flex-wrap gap-3">
                        @hasRolesArray($AdminAndManagerRoles)
                        <form action="{{ route('users.index') }}">
                            <x-button>
                                {{__('Gebruikers')}}
                            </x-button>
                        </form>
                        @endhasRolesArray
                        @hasRolesArray($HighRankEmployeeRoles)
                        <form action="{{ route('members.index') }}">
                            <x-button>
                                {{__('Medewerkers')}}
                            </x-button>
                        </form>
                        @endhasRolesArray
                        @hasRole('Admin')
                        <form action="{{ route('roles.index') }}">
                            <x-button>
                                {{__('Rollen')}}
                            </x-button>
                        </form>
                        @endhasRole
                        @hasRolesArray($AdminAndManagerRoles)
                        <form action="{{ route('stats') }}">
                            <x-button>
                                {{__('Statistieken')}}
                            </x-button>
                        </form>
                        @endhasRolesArray
                        @hasRolesArray($AdminAndManagerRoles)
                        <form action="{{ route('products.index') }}">
                            <x-button>
                                {{__('Producten')}}
                            </x-button>
                        </form>
                        <form action="{{ route('categories.index') }}">
                            <x-button>
                                {{__('Categorieën')}}
                            </x-button>
                        </form>
                        @endhasRolesArray
                        @hasRolesArray($EmployeesOnly)
                        <form action="{{ route('schedule.index') }}">
                            <x-button>
                                {{__('Rooster')}}
                            </x-button>
                        </form>
                        @endhasRolesArray
                        @hasRolesArray($AdminAndManagerRoles)
                        <form action="{{ route('images.index') }}">
                            <x-button>
                                {{__("Foto's")}}
                            </x-button>
                        </form>
                        <form action="{{ route('kuin.buttons') }}">
                            <x-button>
                                {{__("Kuin")}}
                            </x-button>
                        </form>
                        @endhasRolesArray
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
