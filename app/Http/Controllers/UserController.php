<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use function React\Promise\all;
use App\Traits;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::query()->latest();
        $roles = Role::all()->whereNotIn('name',['super_admin'])->pluck('name');
        if ($request->name) {
            $users = $users->like('name',$request->name);
        }

        if ($request->email) {
            $users = $users->like('email',$request->email);
        }

        if ($request->phone) {
            $users = $users->like('phone',$request->phone);
        }

        if ($request->role) {
            $users = $users->role($request->role);
        }else{
            $users = $users->role($roles);
        }
        $totalUser= $users->count();
        $users = $users->paginate(20);
        return view('user.index',compact('users','roles','totalUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $roles = Role::all()->whereNotIn('name',['super_admin','agent'])->pluck('name');
        return view('user.create',compact('status','roles'));
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
            'name'=>'required',
            'email'=>'nullable|email|unique:users,email',
            'phone' => ['required','regex:'.config('general_setting.phone_number'),'unique:users,phone'],
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('profile_image')){
            $request['profile_image_url']=  $request->profile_image->store('public/image');
        }
        $request['password']=Hash::make(Str::random(8));
        $request['status_id']=3;
        $createUser = User::create($request->except('_token'));
        $createUser->assignRole('vendor');
        if(!$createUser){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'User has been successfully created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('user.index');

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
    public function edit(User $user)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $roles = Role::all()->whereNotIn('name',['super_admin','agent'])->pluck('name');
        return view('user.edit',compact('user','status','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'nullable|email|unique:users,email,'.$user->id,
            'phone' => ['required','regex:'.config('general_setting.phone_number'),'unique:users,phone,'.$user->id],
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
//        $request['meta']= ['commission_rate'=>$request->commission_rate];
        if($request->hasFile('profile_image')){
            $request['profile_image_url']=  $request->profile_image->store('public/image');
        }
        $request['password']=Hash::make(Str::random(8));
        $request['status_id']=3;
        $user->syncRoles('vendor');
        $updateUser = User::whereId($user->id)->update($request->except('_token','_method','profile_image','role'));
        if(!$updateUser){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else{
            Session::flash('message', 'User info has been successfully Updated');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleteUser = $user->delete();
        if(!$deleteUser){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'User has been successfully deleted');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->back();
    }
}
