<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the homepage and the product show on the homepage.
     */
    public function showHome(string $id): View
    {
        $product = Product::find($id);

        return view('product.product', compact('product'));
    }

    public function aanbiedingen(): View
    {
        $productsDag = Product::all()->where('dag_aanbieding', true);
        $productsWeek = Product::all()->where('week_aanbieding', true);

        return view('product.aanbieding', [
            'productsDag' => $productsDag,
            'productsWeek' => $productsWeek,
        ]);
    }

    /**
     * Display products for the CRUD
     */
    public function index()
    {
        //Show also product who are softdeleted
        // $products = Product::withTrashed()->get();
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $path = public_path('img/products/');
        $images = File::allFiles($path);

        return view('product.create', compact('categories'), compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'EAN' => 'required|string',
            'percentage_aanbieding' => 'required|numeric|min:0|max:100',
        ]);
        //set aanbiedingen
        $request['dag_aanbieding'] = $request->has('dag_aanbieding') ? '1' : '0';
        $request['week_aanbieding'] = $request->has('week_aanbieding') ? '1' : '0';

        $request['image'] = '../img/products/'.$request['image'];
        $product = Product::create($request->all());
        CategoryProduct::create(['product_id' => $product->id, 'category_id' => $request->category])->save();
        $product->prices()->create([
            'price' => $request->input('price'),
        ]);
        $product->last_edited_by = auth()->id(); // Assuming you are using authentication
        $product->save();
        // Generate SKU
        $this->generateSKU($product);

        return redirect()->route('products.index')
            ->with('success', 'Product succesvol gemaakt.');
    }

    public function show(Product $product)
    {
        $categories = Category::all();

        return view('product.show', compact('product'), compact('categories'));
    }

    public function edit(Product $product)
    {
        $path = public_path('img/products/');
        $images = File::allFiles($path);

        return view('product.edit', compact('product'), compact('images'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'EAN' => 'required|string',
            'percentage_aanbieding' => 'required|numeric|min:0|max:100',
        ]);
        //set aanbiedingen
        if ($request->dag_aanbieding == 'on') {
            $request['dag_aanbieding'] = '1';
        } else {
            $request['dag_aanbieding'] = '0';
        }
        if ($request->week_aanbieding == 'on') {
            $request['week_aanbieding'] = '1';
        } else {
            $request['week_aanbieding'] = '0';
        }

        $request['image'] = '../img/products/'.$request['image'];
        $product->update($request->all());

        $product->prices()->create([
            'price' => $request->input('price'),
        ]);
        $product->last_edited_by = auth()->id(); // Assuming you are using authentication
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product succesvol aangepast.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product verwijderd');
    }

    public function removeCategoryFromProduct(Request $request)
    {
        $productId = $request->input('product');
        $categoryId = $request->input('category');

        $categoryProduct = CategoryProduct::where('product_id', $productId)
            ->where('category_id', $categoryId)
            ->first();

        if ($categoryProduct) {
            $categoryProduct->delete();

            // Regenerate SKU
            $product = Product::find($productId);
            $product->last_edited_by = auth()->id(); // Assuming you are using authentication
            $product->save();
            $this->generateSKU($product);

            return redirect()->back()->with('success', 'Categorie succesvol verwijderd van product.');
        }

        return redirect()->back()->with('error', 'Categorie niet gevonden voor product.');
    }

    public function addCategoryFromProduct(Request $request)
    {
        CategoryProduct::create(['product_id' => $request->input('product'), 'category_id' => $request->category])->save();

        // Regenerate SKU
        $product = Product::find($request->input('product'));
        $product->last_edited_by = auth()->id(); // Assuming you are using authentication
        $product->save();
        $this->generateSKU($product);

        return redirect()->back()->with('success', 'Catogorie toegevoegd aan product.');
    }

    private function generateSKU(Product $product)
    {
        $categories = $product->categories;
        $skufirsttwo = '';

        foreach ($categories as $category) {
            $skufirsttwo .= strtoupper(substr($category->name, 0, 2));
        }

        $zeros = 15 - strlen($skufirsttwo) - strlen($product->id);
        $zerosText = str_repeat('0', $zeros);

        // Make SKU
        $SKU = $skufirsttwo.$zerosText.$product->id;

        // Save SKU
        $product->SKU = $SKU;
        $product->save();
    }
}
