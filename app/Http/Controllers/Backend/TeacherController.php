<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Teacher;
use App\File;
use Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with('file')->get();
        return view('backend.teacher.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Teacher $teacher)
    {
       
        return view('backend.teacher.create',compact('teacher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id']= auth()->id();
        $password = Hash::make($request->password);
        $request['username'] = $this->genrateUsername($request['designation']);
        if($request->hasFile('profile')){
            $data['user_id'] = auth()->id();
            $data['type'] = $request->profile->extension();
            $data['filepath'] = $request->profile->getClientOriginalName();
            $file = $request->profile->storeAS('images',$data['filepath'],'public');
            $upload = File::create($data);
            $request['file_id'] = $upload->id;
        }else{
            session()->flash('danger','Choose image blog');
            return redirect()->back()->withInput();
        }
        $teacher = Teacher::create($request->except(['_token','profile','aboutme']));
        // $teacher->assignRole('teacher');
        return redirect()->route('teacher.edit',$teacher->id); 


    }
    //Genrate Unique Username 
    public function genrateUsername($designation)
    {
        $register_num = (Teacher::latest()->first()->id ?? 0) +1;  
        $currentyear = date('y');
        return $currentyear.$designation.str_pad($register_num, 4, '0', STR_PAD_LEFT);
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
        // return $id;
        $teacher = Teacher::with('file')->find($id);
        // $teacher->assignRole('teacher');
        return view('backend.teacher.create',compact('teacher'));
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
        
        if($request->password != "" && $request->confirmPassword != ""){
            if($request->password ==  $request->confirmPassword){
                $request["password"]= Hash::make($request->password);
            } else{
                return redirect()->back()->withErrors(["Password and Re-Confirm Password should be same!"]);
            }
        }else{
            $password = Teacher::find($id)->password;
            if($password != ''){
                $request['password'] = $password;
            }else{
                return redirect()->back()->withErrors(["Password and Re-Confirm Password should be same!"]);
            }
        }
        if($request->hasFile('profile')){
            $data['user_id'] = auth()->id();
            $data['type'] = $request->profile->extension();
            $data['filepath'] = $request->profile->getClientOriginalName();
            $file = $request->profile->storeAS('images',$data['filepath'],'public');
            $upload = File::create($data);
            $request['file_id'] = $upload->id;
        }  
        $teacher = Teacher::where('id',$id)->update($request->except(['_token','_method','profile','aboutme','confirmPassword']));
        return redirect()->route('teacher.edit',$id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
