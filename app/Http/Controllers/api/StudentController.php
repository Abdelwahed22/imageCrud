<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
     public function index(){
       $Students=  Student::all();

       $Students->each(function ($s) {
           $s->profile_image = asset("uploads/students/" . $s->profile_image);
       });

       return response()->json([
           "message"=>"reteval Secessfull",
           "data" => $Students,
       ], status: 200);
     }

    public function store(Request $request){
        $student = new Student();
        $student->name=$request->input('name');
        $student->email=$request->input('email');
       // $student->id=$request->input('id');

        if($request->hasFile('profile_image')){

            $file= $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'. $extention;
            $file->move('uploads/students/',$filename);
            $student->profile_image=$filename;
        }
        $student->save();
        return response()->json([
            "message"=>"Saved  Secessfull",

        ], status: 200);





    }


}
