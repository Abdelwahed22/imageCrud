<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $student = Student::all();
        return view('student.index', compact('student'));
    }
    public function create(){
        return view('student.create');
    }
    public function store(Request $request){
        $student = new Student();
        $student->name=$request->input('name');
        $student->email=$request->input('email');

        if($request->hasFile('profile_image')){

            $file= $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'. $extention;
            $file->move('uploads/students/',$filename);
            $student->profile_image=$filename;
        }
        $student->save();

        return redirect()->back()->with('status','Student image added successfully');

//        return response()->json([
//            "message" => "success",
//            "data" => [
//                [
//                    "name" => "kareem"
//                ]
//            ]
//        ]);


    }
    public function edit($id){
     $student = Student::find($id);
     return view('student/edit',compact('student'));
    }

    public function update(Request $request , $id){
        $student=Student::find($id);
        $student->name=$request->input('name');
        $student->email=$request->input('email');

        if($request->hasFile('profile_image')){

            $destination = 'uploads/students/'.$student->profile_image;
            if (File::exists( $destination)){
                File::delete( $destination);
            }
            $file= $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'. $extention;
            $file->move('uploads/students/',$filename);
            $student->profile_image=$filename;
        }
        $student->Update();

        return redirect()->back()->with('status','Student image Updated successfully');


    }
    public function destroy($id){
        $student=Student::find($id);
        $destination = 'uploads/students/'.$student->profile_image;
        if (File::exists( $destination)){
            File::delete( $destination);
        }
        $student->delete();
        return redirect()->back()->with('status','Student image deleted  successfully');

    }
}
