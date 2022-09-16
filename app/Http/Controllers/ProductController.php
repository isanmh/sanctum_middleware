<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Cache\RateLimiting\Unlimited;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products = Product::paginate(2);
        // all data trash and exits
        // $products = Product::withTrashed()->paginate(2);
        // only data trash
        // $products = Product::onlyTrashed()->paginate(2);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|integer',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048|required',
        ]);

        $input = $request->all();
        // logika untuk pemindahan data image
        if ($image = $request->file('image')) {
            $tagetPath = 'images/';
            // nama gambar baru
            $product_img = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // baru kita pindahkan ke folder images
            $image->move($tagetPath, $product_img);
            // replace data dari form dengn nama gambar baru
            $input['image'] = "$product_img";
        }
        Product::create($input);

        // $request->session()->flash('success', 'Product created successfully.');
        return redirect()->route('products.index')->with(
            'success',
            'Produk berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'integer',
        ]);
        $input = $request->all();
        // logika untuk pemindahan data image
        if ($image = $request->file('image')) {
            $tagetPath = 'images/';
            unlink($tagetPath . $product->image);
            $product_img = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($tagetPath, $product_img);
            $input['image'] = "$product_img";
        } else {
            unset($input['image']);
        }
        $product->update($input);
        return redirect()->route('products.index')->with(
            'success',
            'Produk berhasil diupdate'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        // $product->forceDelete();
        return redirect()->route('products.index')->with(
            'success',
            'Produk berhasil dihapus'
        );
    }

    // custom restore
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.index')->with(
            'success',
            'Produk berhasil direstore'
        );
    }
}
