<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Role_User;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * views > members (all crud pages)
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $roles = ['Admin', 'Manager', 'Personeel medewerker'];
            if (Auth::user()->hasRolesArray($roles)) {
                return $next($request);
            } else {
                return redirect(route('dashboard'));
            }
        });
    }

    public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        //Shows only the user if they do not have a role "klant"
        $users = User::whereDoesntHave('roles', function ($query) {

            $query->where('name', 'like', 'klant');

        })->get();

        return view('members.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $user = Auth::user();
        // roles for dropbox
        return view('members.create', compact('user'), ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // prevent sql injection
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/[^a-zA-Z ]/'],
            'role' => ['required', 'int', 'not_regex:/[^0-9]/'],
            'email' => ['required', 'string', 'not_regex:/[^a-zA-Z0-9.@]/'],
            'password' => ['required', 'string', 'not_regex:/[^a-zA-Z0-9!@#$%^&*?.]/'],
            'password_confirmation' => ['required', 'string', 'not_regex:/[^a-zA-Z0-9!@#$%^&*?.]/'],
            'dateOfBirth' => ['required', 'string', 'not_regex:/[^0-9-]/'],
        ]);
        // check pass same as pass_confirm
        if ($request->password == $request->password_confirmation) {
            $request['password'] = bcrypt($request->password);
            $madeUser = User::create($request->all());
            $roleuser = new Role_User();
            $roleuser->user_id = $madeUser->id;
            $roleuser->role_id = $request->role;
            $roleuser->save();

            return redirect()->route('members.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return view('members.show', ['user' => $user]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(string $id): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('members.edit', ['user' => User::find($id), 'roles' => Role::all()]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::find($id);
        // Detach the user from all roles to remove the rows in the role_user table
        $user->roles()->detach();
        // Delete the user
        $user->delete();

        return redirect()->route('members.index');
    }

    public function addUserToRole(Request $request, User $user)
    {
        if (! $user->roles()->where('role_id', $request['role_id'])->exists()) {
            $user->roles()->attach($request['role_id']);

            return Redirect::route('members.edit', $user->id)->with('status', 'role toegevoegd aan gebruiker.');

        } else {
            return Redirect::route('members.edit', $user->id);
        }

    }

    public function removeUserFromRole(Request $request, User $user): RedirectResponse
    {
        $user->roles()->detach($request['key']);

        return Redirect::route('members.edit', $user->id)->with('status', 'role verwijderd.');
    }
}
