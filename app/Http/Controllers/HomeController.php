<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Teacher;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $studentCount = Student::count();
        $latestStudent = Student::with('studentclass')->take(5)->latest()->get();
        $teacherCount = Teacher::count();
        $latestTeacher = Teacher::take(5)->latest()->get();
        return view('home',compact('studentCount','latestStudent','teacherCount','latestTeacher'));
    }
}
