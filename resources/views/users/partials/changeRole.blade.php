<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    {{ __('Roles wijzigen') }}
</h2>
<table>


        @foreach($user->roles as $userRole)
<tr>
    <form class='' method="post" action="{{ route('roles.removeUserFromRole', ['user' => $user]) }}" class="mt-6 space-y-6">
        <td>{{$userRole->name}}</td>
        @csrf
        @method('DELETE')
        <td><x-button name="key" value="{{$userRole['id']}}" type="submit" class="bg-red-400">X</x-button></td>
    </form>

</tr>
    @endforeach
</table>
        <form method="post" action="{{ route('roles.addUserToRole', ['user' => $user]) }}" class="mt-6 space-y-6">
        @csrf
        @method('post')
            <select class="w-full" name="role_id" id="size">
                @foreach($roles as $role)
                        <option id="{{$role->id}}" value="{{$role->id}}" >{{$role->name}}</option>
                @endforeach
            </select>
            <x-button type="submit" class="">Toevoegen</x-button>

            <div class="flex items-center gap-4">

                @if (session('status') === 'role-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
</form>

