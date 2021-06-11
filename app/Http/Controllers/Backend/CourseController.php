<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Http\Requests\CourseRequest;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:course-section');
        $this->middleware('permission:course-list',['only'=>['create']]);
        $this->middleware('permission:course-create',['only'=>['store']]);
        $this->middleware('permission:course-edit',['only'=>['update','edit']]);
        $this->middleware('permission:course-view',['only'=>['show']]);
        $this->middleware('permission:course-destroy',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $courses = Course::paginate(10);
        return view('backend.settings.index',compact('courses'))->with('course',$course);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        // return $request->all();

        Course::create($request->except(['_token']));
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
        $course = Course::find($id);
        $courses = Course::paginate(10);
        return view('backend.settings.index',compact('course','courses'));
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
        //  return $request;
        Course::where('id',$id)->update($request->except('_token','_method'));
        session()->flash('success','Updated Suceessfully');
        return redirect()->route('admin.course.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if($course != ''){
            $course->delete();  
            return response()->json(['status'=>'success', 'message'=>'Data Successfully Deleted']);
        }
        return response()->json(['status'=>'failed', 'message'=>'data not found or already deleted!!']);
    }
}
