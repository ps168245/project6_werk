<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    {{ __('Roles wijzigen') }}
</h2>
<table>


        @foreach($user->roles as $userRole)
<tr>
    <form class='' method="post" action="{{ route('members.removeUserFromRole', ['user' => $user]) }}" class="mt-6 space-y-6">
        <td>{{$userRole->name}}</td>
        @csrf
        @method('delete')
        <td>        <x-button name="key" value="{{$userRole['id']}}" class="ml-3 bg-red-500 hover:bg-red-800 "><i class="fa-solid fa-trash-can"></i></x-button>
        </td>
    </form>

</tr>
    @endforeach
</table>
        <form method="post" action="{{ route('members.addUserToRole', ['user' => $user]) }}" class="mt-6 space-y-6">
        @csrf
        @method('post')
        <select class="w-full" name="role_id" id="size">
            @foreach($roles as $role)
              @if($user->hasRole('Admin'))
                <option value="{{ $role->id }}">{{ $role->name }}</option>
              @elseif($user->hasRole('Manager') && $role->name !== 'Admin')
                <option value="{{ $role->id }}">{{ $role->name }}</option>
              @elseif($role->name !== 'Admin' && $role->name !== 'Manager')
                <option value="{{ $role->id }}">{{ $role->name }}</option>
              @endif
            @endforeach
          </select>

            <x-button class=" mt-1 bg-green-800 hover:bg-green-700">
                {{__('Toevoegen')}}
            </x-button>

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

