<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Student;
use App\File;
use App\Family;
use App\Guardian;
use Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use App\Http\Requests\StudentRequest;
class StudentController extends Controller
{
    protected $student;
    public function __construct(Student $student)
    {
        $this->middleware('permission:student-section');
        $this->middleware('permission:student-list',['only'=>['index']]);
        $this->middleware('permission:student-create',['only'=>['create','store']]);
        $this->middleware('permission:student-edit',['only'=>['update','edit']]);
        $this->middleware('permission:student-view',['only'=>['show']]);
        $this->middleware('permission:student-delete',['only'=>['destroy']]);
        
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
        $students = $this->student->orderby('id','desc')->with('studentclass','file')->get();
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
     * @return \Illuminate\Http\Response StudentRequest
     */
    public function store(StudentRequest $request)
    {
        // return $request->all();
        // return Student::latest()->first();
        // return $request->all();
       
        $request['user_id']= auth()->id();

        if($request['g_name'] != ''){
            if($request['g_relation'] == '' || $request['g_mobile'] == '' || $request['g_address'] == '' ){
                session()->flash('danger','Fileds  required- ' .($request['g_relation'] == '' ?'guardian name,' :'').' '.
                                                            ($request['g_mobile'] == '' ? 'guardian Mobile Number,' : '').' '.
                                                            ($request['g_address'] == ''? 'guardian Address' : ''));
                return redirect()->back()->withInput();
            }  
        }
        if($request->password != "" && $request->password_confirmation != ""){
            if($request->password ==  $request->password_confirmation){
                $request["password"]= Hash::make($request->password);
            } else{
                return redirect()->back()->withErrors(["Password and Re-Confirm Password should be same!"]);
            }
        }
        $register_num = (Student::latest()->first()->id ?? 0) +1;  
        $class = Course::find($request['class_id'])->name;
        $currentyear = date('y');
        $request['username'] = $currentyear.$class.str_pad($register_num, 4, '0', STR_PAD_LEFT);
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
        // return $request->all();
       $student = Student::create($request->except(['_token','profile','password_confirmation','role',
                                                    'father_name','mother_name','f_mobile','m_mobile',
                                                    'f_email','m_email','parent_address','parent_city',
                                                    'parent_country','parent_pincode','g_name','g_relation',
                                                    'g_mobile','g_email','g_address','g_city','g_country','g_pincode']));
        $student->assignRole($request->role);
        $family_id = '';
        if($request->father_name != '' && $request->mother_name != ''){
            $parent=['father_name'=>$request->father_name,
                    'f_mobile'=>$request->f_mobile,
                    'f_email'=>$request->f_email,
                    'mother_name'=>$request->mother_name,
                    'm_mobile'=>$request->m_mobile,
                    'm_email'=>$request->m_email,
                    'address'=>$request->parent_address,
                    'city'=>$request->parent_city,
                    'country'=>$request->parent_country,
                    'pincode'=>$request->parent_pincode,
                    'user_id'=>auth()->id(),
                    'student_id'=>$student->id,
            ];
            $family_id = $this->storeParent($parent);
        }
        // return $request->all();  
       $guardian_id = '';
        if($family_id != '' && $request['g_name']!= ''){
            $guardian =[
                'name'=>$request->g_name,
                'relationship'=>$request->g_relation,
                'mobile'=>$request->g_mobile,
                'email'=>$request->g_email,
                'address'=>$request->g_address,
                'city'=>$request->g_city,
                'country'=>$request->g_country,
                'pincode'=>$request->g_pincode,
                'user_id'=>auth()->id(),
                'family_id'=>$family_id,
                'student_id'=>$student->id,
            ];
            $guardian_id = $this->storeGuardian($guardian);
        }

        if($family_id != '' && $guardian_id != ''){

            Student::where('id',$student->id)->update(['family_id'=>$family_id,'guardian_id'=>$guardian_id]);
     
        }
      
        session()->flash('success','Student is created Successfully!');
        return redirect()->route('admin.student.edit',$student->id);
    }

    public function storeParent(Array $parent)
    {
      $family = Family::create($parent);
      return $family->id;
    }

    public function storeGuardian(Array $guardian){
       $guardian = Guardian::create($guardian);
        return $guardian->id;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::with('studentClass')->find($id);
        return view('backend.student.show',compact('student'));
    }
    public function showFamily($id)
    {
        $student = Student::with('family')->find($id);
        return view('backend.student.profileFamily',compact('student'));
    }
    public function showGuardian($id)
    {
        $student = Student::with('guardian')->find($id);
        return view('backend.student.profileGuardian',compact('student'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::with('studentclass','file','family','guardian')->find($id);
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
        // return $request->all();
        if($request['g_name'] != ''){
            if($request['g_relation'] == '' || $request['g_mobile'] == '' || $request['g_address'] == '' ){
                session()->flash('danger','Fileds  required- ' .($request['g_relation'] == '' ?'guardian name,' :'').' '.
                                                            ($request['g_mobile'] == '' ? 'guardian Mobile Number,' : '').' '.
                                                            ($request['g_address'] == ''? 'guardian Address' : ''));
                return redirect()->back()->withInput();
            }  
        }
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

        $student = Student::where('id',$id)->update($request->except([  '_token','_method','password_confirmation','profile','role',
                                                                        'father_name','mother_name','f_mobile','m_mobile',
                                                                        'f_email','m_email','parent_address','parent_city',
                                                                        'parent_country','parent_pincode','g_name','g_relation',
                                                                        'g_mobile','g_email','g_address','g_city','g_country','g_pincode'
                                                                    ]));
        
        if($request->role != ''){
            $student = Student::find($id);
            DB::table('model_has_roles')->where('model_id',$id)->where('model_type','App\Student')->delete();
            $student->assignRole($request->role); 
        }
        $family_id = Student::find($id)->family_id;
        
        if($request->father_name != '' && $request->mother_name != ''){
            $parent=['father_name'=>$request->father_name,
                    'f_mobile'=>$request->f_mobile,
                    'f_email'=>$request->f_email,
                    'mother_name'=>$request->mother_name,
                    'm_mobile'=>$request->m_mobile,
                    'm_email'=>$request->m_email,
                    'address'=>$request->parent_address,
                    'city'=>$request->parent_city,
                    'country'=>$request->parent_country,
                    'pincode'=>$request->parent_pincode,
                    'user_id'=>auth()->id(),
                    'student_id'=>$id,
            ];
            if($family_id == ''){
                $this->storeParent($parent);
            }else{
                Family::where('id',$family_id)->update($parent);
            }
        }
        $guardian_id = Student::find($id)->guardian_id;
        if($family_id != '' && $request['g_name']!= ''){
            $guardian =[
                'name'=>$request->g_name,
                'relationship'=>$request->g_relation,
                'mobile'=>$request->g_mobile,
                'email'=>$request->g_email,
                'address'=>$request->g_address,
                'city'=>$request->g_city,
                'country'=>$request->g_country,
                'pincode'=>$request->g_pincode,
                'user_id'=>auth()->id(),
                'family_id'=>$family_id,
                'student_id'=>$student->id,
            ];
            if($guardian_id == ''){
                $this->storeGuardian($guardian);
            }else{
                Guardian::where('id',$guardian_id)->update($guardian);
            }
        }
        if($family_id != '' && $guardian_id != ''){

            Student::where('id',$student->id)->update(['family_id'=>$family_id,'guardian_id'=>$guardian_id]);
     
        }
        session()->flash('success','Student Profile Updated Successfully');
        return redirect()->route('admin.student.show',$id);
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
