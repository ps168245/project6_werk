<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->hasRole('admin')) {
                return $next($request);
            } else {
                return redirect(route('dashboard'));
            }
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.index', ['roles' => Role::all()]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/[^a-zA-Z]/'],
        ]);
        Role::create($request->all());

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('roles.show', ['role' => Role::find($id), 'users' => User::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('roles.edit', ['role' => Role::find($role->id)]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/[^a-zA-Z]/'],
        ]);
        $role->update($request->all());

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->route('roles.index');
    }

    /**
     * @return void
     */
    public function addUserToRole(Request $request, User $user)
    {
        if (! $user->roles()->where('role_id', $request['role_id'])->exists()) {
            $user->roles()->attach($request['role_id']);

            return Redirect::route('users.edit', $user->id)->with('status', 'Gebruiker toegevoegd aan role.');

        } else {
            return Redirect::route('users.edit', $user->id);
        }

    }

    public function removeUserFromRole(Request $request, User $user)
    {
        $user->roles()->detach($request['key']);

        return Redirect::route('users.edit', $user->id)->with('status', 'Gebruiker verwijderd van role.');
    }
}
