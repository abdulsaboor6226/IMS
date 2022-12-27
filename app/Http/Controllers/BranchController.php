<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $branches = Branch::query()->latest();
        if ($request->name) {
            $branches = $branches->where('name','LIKE','%'.$request->name.'%');
        }
        $totalBranches = $branches->count();
        $branches = $branches->with('status')->paginate(10);
        return view('branch.index',compact('branches','totalBranches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        return view('branch.create',compact('status'));
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
        $createBranch = Branch::create($request->except('_token'));

        if (!$createBranch) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Branch has been successfully Created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('branch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        return view('branch.edit',compact('status','branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $updateBranch = $branch->update($request->except('_token'));

        if (!$updateBranch) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Branch has been successfully Updated');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('branch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $deleteBranch = $branch->delete();
        if (!$deleteBranch) {
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else {
            Session::flash('message', 'Branch has been successfully Deleted');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('branch.index');
    }
}
