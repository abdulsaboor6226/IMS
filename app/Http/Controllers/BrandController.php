<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::query()->latest();
        if ($request->name) {
            $brands = $brands->like('name',$request->name);
        }
        $totalBrands = $brands->count();
        $brands = $brands->with('status')->paginate(10);
        return view('brand.index',compact('brands','totalBrands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        return view('brand.create',compact('status'));
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
        $createBrand = Brand::create($request->except('_token'));

        if (!$createBrand) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Brand has been successfully Created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        return view('brand.edit',compact('status','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $updateBrand = $brand->update($request->except('_token'));

        if (!$updateBrand) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Brand has been successfully Updated');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $deleteBrand = $brand->delete();
        if (!$deleteBrand) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Brand has been successfully Deleted');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('brand.index');
    }
}
