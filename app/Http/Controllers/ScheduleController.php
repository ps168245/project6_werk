<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Schedule_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user(); // check user login
            // hasRole > models > user.php
            if (Auth::user()->hasRole('Klant')) {
                return redirect(route('home'));
            } else {
                return $next($request);
            }
        });
    }

    public function index()
    {
        $users = User::all();
        $user = Auth::user(); // check user login
        $schedules = Schedule::all();

        return view('roosterpagina', compact('schedules', 'users', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'startTime' => 'required|date',
            'endTime' => 'required|date|after:start_time',
            'location' => ['required', 'string', 'not_regex:/[^a-zA-Z0-9.@]/'],
            'description' => ['required', 'string', 'not_regex:/[^a-zA-Z0-9.@]/'],
        ]);
        $user = Auth::user(); // Get the authenticated user

        if ($user->hasRole('Manager') || $user->hasRole('Admin')) {
            $schedule = Schedule::create($request->all());
            Schedule_User::create(['schedule_id' => $schedule->id, 'user_id' => $request->user_id])->save();

            return redirect()->route('schedule.index')->with('success', 'Rooster taak is succesvol toegevoegd.');
        } else {
            return redirect()->route('schedule.index')->with('error', 'Je bent niet geautoriseerd om deze actie uit te voeren.');
        }
    }

    public function destroy(string $id)
    {
        $user = Auth::user(); // Get the authenticated user

        if ($user->hasRole('Manager') || $user->hasRole('Admin')) {
            $schedule = Schedule::find($id);
            $schedule->users()->detach();
            $schedule->delete();

            return redirect()->route('schedule.index')->with('success', 'Rooster taak is succesvol verwijdered.');
        } else {
            return redirect()->route('schedule.index')->with('error', 'Je bent niet geautoriseerd om deze actie uit te voeren.');
        }
    }
}
