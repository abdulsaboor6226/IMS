<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Dictionary;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query()->latest();
        if ($request->name) {
            $products = $products->where('name','LIKE','%'.$request->name.'%');
        }
        $totalProducts = $products->count();
        $products = $products->with('status','vendor','brand','productType')->paginate(10);
        return view('product.index',compact('products','totalProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $vendors = User::role('vendor')->get();
        $brands = Brand::pluck('name','id');
        $productTypes = ProductType::pluck('name','id');
        return view('product.create',compact('status','productTypes','brands','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'stock_date' => 'required|date',
            'name'=>'required|string',
            'product_type_id_fk'=>'required|integer',
            'brand_id_fk'=>'required|integer',
            'vendor_id_fk'=>'required|integer',
            'unit_price'=>'required|integer',
            'unit_quantity'=>'required|integer',
        ]);
        $createProduct = Product::create($request->except('_token'));

        if (!$createProduct) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Product has been successfully Created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $vendors = User::role('vendor')->get();
        $brands = Brand::pluck('name','id');
        $productTypes = ProductType::pluck('name','id');
        return view('product.edit',compact('status','productTypes','brands','vendors','product'));
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
        $this->validate($request,[
            'stock_date' => 'required|date',
            'name'=>'required|string',
            'product_type_id_fk'=>'required|integer',
            'brand_id_fk'=>'required|integer',
            'vendor_id_fk'=>'required|integer',
            'unit_price'=>'required|integer',
            'unit_quantity'=>'required|integer',
        ]);
        $updateProduct = $product->update($request->except('_token'));

        if (!$updateProduct) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Product has been successfully Updated');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $deleteProduct = $product->delete();
        if (!$deleteProduct) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Product has been successfully Deleted');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('product.index');
    }
}
