<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $users =User::get();
        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::where('guard_name','web')->pluck('name','name')->all();
        return view('backend.user.create',compact('roles'))->with('user',$user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // return $request->all();
        if($request->password != '' && $request->password_confirmation){
            if($request->password == $request->password_confirmation){
                $request['password'] = Hash::make($request->password);
            }else{
                session()->flash('danger','password doesn\'t match');
                return redirect()->back()->withInput();
            }
        }else{
            session()->flash('danger','password should not be empty');
            return redirect()->back()->withInput();
        }
        
        $user = User::create($request->except(['_token','role']));
        $user->assignRole($request->role);
        session()->flash('success','Inserted Successfully!');   
        return redirect()->back();
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
        $user = User::find($id);
        $roles = Role::where('guard_name','web')->pluck('name','name')->all();
        $userRole = $user->roles->where('guard_name','web')->pluck('name','name')->first();
        return view('backend.user.create',compact('user','roles','userRole'));
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
        if($request->password != ''){
            if($request->password == $request->password_confirmation){
                $request['password'] = Hash::make($request->password);
            }else{
                session()->flash('danger','password doesn\'t match');
                return redirect()->back()->withInput();
            }
        }
        User::create($request->except(['_token','method','role']));
        if($request->role != ''){
            $user = User::find($id);
            $user->assignRole($request->role);
        }

        session()->flash('success','Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user != '' && $user->id != '1'){
            $user->delete();  
            return response()->json(['status'=>'success', 'message'=>'Data Successfully Deleted']);
        }
        return response()->json(['status'=>'failed', 'message'=>'data not found or already deleted!!']);
    }
}
