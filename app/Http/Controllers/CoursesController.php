<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;

class CoursesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('course')->only(['details']);
        $this->middleware('teacher')->only(['createView', 'editView', 'start', 'stop', 'edit', 'create']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user  = User::findOrFail(Auth::User()->id);
        $courses = Course::all();
        return view('home', compact('courses', 'user'));
    }
    public function details($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.details', compact('course'));
    }
    public function createView()
    {
        return view('courses.create');
    }
    public function editView($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }
    public function start($id)
    {
        $course = Course::findOrFail($id);
        $course->start();
        return redirect('/insider/courses/'.$course->id);
    }
    public function stop($id)
    {
        $course = Course::findOrFail($id);
        $course->end();
        return redirect('/insider/courses/'.$course->id);
    }
    public function edit($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpg,png|max:1000'
        ]);

        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->description = $request->description;
        if ($request->hasFile('image'))
        {
            $extn = '.'.$request->file('image')->guessClientExtension();
            $path = $request->file('image')->storeAs('course_avatars', $course->id.$extn);
            $course->image = $path;

        }
        $course->save();
        return redirect('/insider/courses/'.$course->id);
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpg,png|max:1000'
        ]);
        $course = Course::createCourse($request);
        if ($request->hasFile('image'))
        {
            $extn = '.'.$request->file('image')->guessClientExtension();
            $path = $request->file('image')->storeAs('course_avatars', $course->id.$extn);
            $course->image = $path;

        }
        else {
            $course->image = 'course_avatars/blank.png';
        }
        $course->save();
        return redirect('/insider/courses');
    }
}
