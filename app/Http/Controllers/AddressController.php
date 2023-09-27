<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userid = $request->user()->id;
        $request->merge(['user_id' => $userid]);
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/[^a-zA-Z ]/'],
            'postcode' => ['required', 'string', 'min:6', 'max:7', 'not_regex:/[^a-zA-Z0-9 ]/'],
            'housenumber' => ['required', 'max:20', 'not_regex:/[^a-zA-Z0-9]/'],
            'address' => ['required', 'max:255', 'not_regex:/[^a-zA-Z0-9 ]/'],
            'region' => ['required', 'max:255', 'not_regex:/[^a-zA-Z ]/'],
            'province' => ['required', 'max:255', 'not_regex:/[^a-zA-Z- ]/'],
            'country' => ['required', 'max:255', 'not_regex:/[^a-zA-Z ]/'],
            'phonenumber' => ['required', 'min:10', 'max:15', 'not_regex:/[^0-9+]/'],
            'instructions' => ['nullable', 'max:1280', 'not_regex:/[^a-zA-Z0-9.,!? ]/'],
            'user_id' => ['required'],
        ]);
        Address::create($request->all());

        return redirect()->route('profile.edit');
    }

    /**
     * Display the specified resource.
     */
    public function setDefault(Request $request, string $id)
    {
        //Set address as default on user table
        $request->user()->default_address = $id;
        $request->user()->save();
        if ($request->shop == 'shop') {
            return redirect()->route('shoppingcart.afronden');
        } else {
            return redirect()->route('profile.edit');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('profile.addresses.edit', ['address' => Address::find($id), 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'not_regex:/[^a-zA-Z ]/'],
            'postcode' => ['required', 'string', 'min:6', 'max:7', 'not_regex:/[^a-zA-Z0-9 ]/'],
            'housenumber' => ['required', 'max:20', 'not_regex:/[^a-zA-Z0-9]/'],
            'address' => ['required', 'max:255', 'not_regex:/[^a-zA-Z0-9 ]/'],
            'region' => ['required', 'max:255', 'not_regex:/[^a-zA-Z ]/'],
            'province' => ['required', 'max:255', 'not_regex:/[^a-zA-Z- ]/'],
            'country' => ['required', 'max:255', 'not_regex:/[^a-zA-Z ]/'],
            'phonenumber' => ['required', 'min:10', 'max:15', 'not_regex:/[^0-9+]/'],
            'instructions' => ['nullable', 'max:1280', 'not_regex:/[^a-zA-Z0-9.,!? ]/'],
        ]);
        Address::find($id)->update($request->all());

        return redirect()->route('profile.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('profile.edit')
            ->with('success', 'Adres sucessvol verwijderd!');
    }
}
