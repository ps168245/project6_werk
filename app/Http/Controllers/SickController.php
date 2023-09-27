<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SickController extends Controller
{
    public function update(User $user): RedirectResponse
    {
        $user = Auth::user();

        $user->update(['sick' => 1]);

        return Redirect::route('schedule.index')->withSuccess(__('Ziek Gemeld.'));

    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->update(['sick' => 0]);

        return redirect()->route('members.index');
    }
}
