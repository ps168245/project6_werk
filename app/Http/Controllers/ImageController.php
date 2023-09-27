<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $path = public_path('img/products/');
        $images = File::allFiles($path);

        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        File::delete('img/products/'.$id);

        return redirect()->route('images.index')
            ->with('success', 'Foto is verwijderd.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'_'.$image->getClientOriginalName();
            $path = public_path('img/products');
            $image->move($path, $filename);

            return redirect()->route('images.index')->with('success', 'Foto succesvol geupload.');
        }

        return redirect()->route('images.index')->with('error', 'Fout bij het uploaden van foto.');
    }
}
