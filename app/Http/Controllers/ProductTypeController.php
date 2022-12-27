<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productTypes = ProductType::query()->latest();
        if ($request->name) {
            $productTypes = $productTypes->where('name','LIKE','%'.$request->name.'%');
        }
        $totalProductTypes = $productTypes->count();
        $productTypes = $productTypes->with('status')->paginate(10);
        return view('productType.index',compact('productTypes','totalProductTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        return view('productType.create',compact('status'));
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
            'name'=>'required|string',
        ]);
        $createProductType = ProductType::create($request->except('_token'));

        if (!$createProductType) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'ProductType has been successfully Created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('product-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        return view('productType.edit',compact('status','productType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $updateProductType = $productType->update($request->except('_token'));

        if (!$updateProductType) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Product Type has been successfully Updated');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('product-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteProductType = ProductType::findOrFail($id);
        if (count($deleteProductType->product) > 0)
        {
            Session::flash('message', 'Product Type has the product so the product will not be deleted');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            $deleteProductType = $deleteProductType->delete();
            if (!$deleteProductType) {
                Session::flash('message', 'OOP! something went wrong');
                Session::flash('alert-class', 'alert-danger');
            } else {
                Session::flash('message', 'Product Type has been successfully Deleted');
                Session::flash('alert-class', 'alert-success');
            }
        }
        return redirect()->route('product-type.index');
    }
}
