<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->reverse();
        return view('admin.product.index', ['products'=>$products, 'PATH_TO_PRODUCT_IMG'=>self::PATH_TO_PRODUCT_IMG]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category'=>'required|integer|max:100',
            'name'=>'required|max:255',
            'price'=>'required|integer|max:50000',
            'description'=>'required',
            'image'=>'required|max:10000|mimes:jpeg,png,bmp,gif,svg'
        ]);

        $file = $request->file('image');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(self::PATH_TO_PRODUCT_IMG, $fileName);

        $product = new Product([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$fileName
        ]);

        $product->save();

        $product->categories()->attach($request->category);

        return redirect()->route('admin.product.index')->with('success', 'Продукт добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', ['product'=>$product, 'PATH_TO_PRODUCT_IMG'=>self::PATH_TO_PRODUCT_IMG, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category'=>'required|integer|max:100',
            'name'=>'required|max:255',
            'price'=>'required|integer|max:50000',
            'description'=>'required',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image'=>'required|max:10000|mimes:jpeg,png,bmp,gif,svg'
            ]);

            File::delete(self::PATH_TO_PRODUCT_IMG . $product->image);

            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(self::PATH_TO_PRODUCT_IMG, $fileName);
            $product->image = $fileName;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($product->categories->first()->id != $request->category) {
            $product->categories()->detach();
            $product->categories()->attach($request->category);
        }

        return redirect(route('admin.product.index'))->with('success', 'Продукт был обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        File::delete(self::PATH_TO_PRODUCT_IMG . $product->image);
        $product->delete();

        return redirect(route('admin.product.index'))->with('success', 'Продукт был удален!');
    }
}
