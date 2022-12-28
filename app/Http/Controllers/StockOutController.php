<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Dictionary;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\StockOut;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stockOuts = StockOut::query()->latest();
        if ($request->diary_no) {
            $stockOuts = $stockOuts->like('diary_no',$request->diary_no);
        }
        if ($request->date) {
            $stockOuts = $stockOuts->like('date',$request->date);
        }
        if ($request->branch_id_fk) {
            $stockOuts = $stockOuts->like('branch_id_fk',$request->branch_id_fk);
        }
        if ($request->applicant_name) {
            $stockOuts = $stockOuts->like('applicant_name',$request->applicant_name);
        }
        if ($request->forwarded_by) {
            $stockOuts = $stockOuts->like('forwarded_by',$request->forwarded_by);
        }
        if ($request->received_by) {
            $stockOuts = $stockOuts->like('received_by',$request->received_by);
        }
        if ($request->received_date) {
            $stockOuts = $stockOuts->like('received_date',$request->received_date);
        }
        if ($request->approved_by) {
            $stockOuts = $stockOuts->like('approved_by',$request->approved_by);
        }
        if ($request->approved_date) {
            $stockOuts = $stockOuts->like('approved_date',$request->approved_date);
        }
        if ($request->product_id_fk) {
            $stockOuts = $stockOuts->like('product_id_fk',$request->product_id_fk);
        }
        if ($request->brand_id_fk) {
            $stockOuts = $stockOuts->like('brand_id_fk',$request->brand_id_fk);
        }
        if ($request->stock_out_qty) {
            $stockOuts = $stockOuts->like('stock_out_qty',$request->stock_out_qty);
        }
        $totalStockOuts = $stockOuts->count();
        $stockOuts = $stockOuts->with('branch','brand','product')->paginate(10);
        $brands = Brand::pluck('name','id');
        $productTypes = ProductType::pluck('name','id');
        $products = Product::pluck('name','id');
        $branches = Branch::pluck('name','id');
        return view('stockOut.index',compact('stockOuts','totalStockOuts','branches','products','brands','productTypes'));
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
        $branches = Branch::pluck('name','id');
        $products = Product::pluck('name','id');
        return view('stockOut.create',compact('status','products','brands','branches','vendors'));
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
            'diary_no'=>'required|integer',
            'date'=>'required|date',
            'branch_id_fk'=>'required|integer',
            'applicant_name'=>'required|string',
            'forwarded_by'=>'required|string',
            'received_by'=>'required|string',
            'received_date'=>'required|date',
            'approved_by'=>'required|string',
            'approved_date'=>'required|date',
            'product_id_fk'=>'required|integer',
            'brand_id_fk'=>'required|integer',
            'stock_out_qty'=>'required|integer',
        ]);
        $createProduct = StockOut::create($request->except('_token'));

        if (!$createProduct) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Stock Out has been successfully Created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('stock-out.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockOut  $stockOut
     * @return \Illuminate\Http\Response
     */
    public function show(StockOut $stockOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockOut  $stockOut
     * @return \Illuminate\Http\Response
     */
    public function edit(StockOut $stockOut)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $vendors = User::role('vendor')->get();
        $brands = Brand::pluck('name','id');
        $branches = Branch::pluck('name','id');
        $products = Product::pluck('name','id');
        return view('stockOut.edit',compact('status','products','brands','branches','vendors','stockOut'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockOut  $stockOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockOut $stockOut)
    {
        $this->validate($request,[
            'diary_no'=>'required|integer',
            'date'=>'required|date',
            'branch_id_fk'=>'required|integer',
            'applicant_name'=>'required|string',
            'forwarded_by'=>'required|string',
            'received_by'=>'required|string',
            'received_date'=>'required|date',
            'approved_by'=>'required|string',
            'approved_date'=>'required|date',
            'product_id_fk'=>'required|integer',
            'brand_id_fk'=>'required|integer',
            'stock_out_qty'=>'required|integer',
        ]);
        $updateProduct = $stockOut->update($request->except('_token'));

        if (!$updateProduct) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Stock Out has been successfully Updated');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('stock-out.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockOut  $stockOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockOut $stockOut)
    {
        $deleteProduct = $stockOut->delete();
        if (!$deleteProduct) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Stock Out has been successfully Deleted');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('stock-out.index');
    }
}
