<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        //Check if session exists
        if (session()->get('chosenCategorie') == null) {
            session(['chosenCategorie']);
        }
        //If the request has an categorie_id set categorie in session
        if ($request->chosenCategorie_id) {
            session()->put('chosenCategorie.0', $request->chosenCategorie_id);
        } elseif ($request->chosenCategorie_id == null) { //This is for paginate. otherwise paginate will set categorie to 1
        } else { //if any value is bs set it to 1
            session()->put('chosenCategorie.0', 1);
        }
        try {
            //searching for category
            $productsPaginates = Category::find(session('chosenCategorie')[0])
                ->products()
                ->paginate(5);
        } catch (\Throwable $e) {
            //no category found. set it to category 1
            $request['chosenCategorie_id'] = 1;
            session()->put('chosenCategorie.0', $request->chosenCategorie_id);
        } finally {
            //get all data and send it to the page.
            $productsPaginates = Category::find(session('chosenCategorie')[0])
                ->products()
                ->paginate(5);
            $productsDag = Product::all()->where('dag_aanbieding', true);
            $productsWeek = Product::all()->where('week_aanbieding', true);
            $categories = Category::all();

            return view('home', [
                'productsDag' => $productsDag,
                'productsWeek' => $productsWeek,
                'productsPaginates' => $productsPaginates,
                'chosenCategorie_id' => session(['chosenCategorie'][0]),
                'categories' => $categories,
            ]);
        }
    }
}
