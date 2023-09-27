<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role_User;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): string
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/[^a-zA-Z ]/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'dateOfBirth' => ['required', 'date', 'before:yesterday'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dateOfBirth' => Carbon::parse($request->dateOfBirth),
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Role_User::create([
            'user_id' => $user->id,
            'role_id' => 2,
        ]);

        if (! Auth::check()) {
            Auth::login($user);
        }

        return Redirect::route('users.index');
    }
}
