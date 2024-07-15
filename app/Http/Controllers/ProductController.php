<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get products
        $products = Product::all();

        //render view with products
        return view('products.index', compact('products'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'sub_category'  =>  'required|max:20',
            'serial_no'     =>  'required|max:6',
            'description'   =>  'required|max:255',
            'carat'         =>  'required|max:10'
        ]);

        //create product
        Product::create([
            'sub_category'  => $request->sub_category,
            'serial_no'     => $request->serial_no,
            'description'   => $request->description,
            'carat'         => $request->carat
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    
    /**
     * edit
     *
     * @param  mixed $product
     * @return void
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        //validate form
        $this->validate($request, [
            'sub_category'  =>  'required|max:20',
            'serial_no'     =>  'required|max:6',
            'description'   =>  'required|max:255',
            'carat'         =>  'required|max:10'
        ]);


        //update product
        $product->update([
            'sub_category'  => $request->sub_category,
            'serial_no'     => $request->serial_no,
            'description'   => $request->description,
            'carat'         => $request->carat
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $product
     * @return void
     */
    public function destroy(Product $product)
    {

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
