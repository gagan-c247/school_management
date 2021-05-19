<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Student;
use App\File;
use Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
class StudentController extends Controller
{
    protected $student;
    public function __construct(Student $student)
    {
        $this->middleware(['auth:web'],['permission:student-create','role:teacher'], ['only' => ['index']]);
        $this->student = $student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(config('app')); 
        $students = $this->student->orderby('id','desc')->with('studentclass')->get();
        return view('backend.student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::get();
        $roles = Role::where('guard_name','student')->pluck('name','name')->all();
        return view('backend.student.create',compact('courses','roles'))->with('student',$this->student);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        // return Student::latest()->first();
        // return $request->all();
        if($request->password != "" && $request->confirmPassword != ""){
            if($request->password ==  $request->confirmPassword){
                $request["password"]= Hash::make($request->password);
            } else{
                return redirect()->back()->withErrors(["Password and Re-Confirm Password should be same!"]);
            }
        }
        $request['user_id']= auth()->id();
        $class = Course::find($request['class_id'])->name;
        $request['username'] = '21ST'.$class.'0001';
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
        $student = Student::create($request->except(['_token','profile','confirmPassword','role']));
        $student->assignRole($request->role);
        return redirect()->route('student.edit',$student->id);
        // return $request->all();
       
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
        $student = Student::with('studentclass','file')->find($id);
        $roles = Role::where('guard_name','student')->pluck('name','name')->all();
        $studentRole = $student->roles->where('guard_name','student')->pluck('name','name')->first();
        $courses = Course::get();
        return view('backend.student.create',compact('courses','student','studentRole','roles'));
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
        // return $request;
        if($request->password != "" && $request->confirmPassword != ""){
            if($request->password ==  $request->confirmPassword){
                $request["password"]= Hash::make($request->password);
            } else{
                return redirect()->back()->withErrors(["Password and Re-Confirm Password should be same!"]);
            }
        }else{
            $password = Student::find($id)->password;
            if($password != ''){
                $request['password'] = $password;
            }else{
                return redirect()->back()->withErrors(["Password and Re-Confirm Password should be same!"]);
            }
        }        
        $request['class_id'] = $request['class_id'] == '' ? Student::find($id)->class_id : $request['class_id'];
        if($request->hasFile('profile')){
            $data['user_id'] = auth()->id();
            $data['type'] = $request->profile->extension();
            $data['filepath'] = $request->profile->getClientOriginalName();
            $file = $request->profile->storeAS('images',$data['filepath'],'public');
            $upload = File::create($data);
            $request['file_id'] = $upload->id;
        }
        $student = Student::where('id',$id)->update($request->except(['_token','_method','role','confirmPassword','profile']));
        if($request->role != ''){
            $student = Student::find($id);
            DB::table('model_has_roles')->where('model_id',$id)->where('model_type','App\Student')->delete();
            $student->assignRole($request->role); 
        }

        return redirect()->route('admin.student.edit',$id);
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
