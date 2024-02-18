<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Validator;

class StudentController extends Controller
{   //show data from database 
    public function index(){
        $student = Student::all();
        $data =['student' =>$student];
        return response()->json($data,200);
        
    }
    // insert data from json format to database
    public function create(Request $request){
        $validator = validator::make($request->all(),
        [
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required',
        ]);
        if ($validator->fails()){
            $data =['message'=>$validator->messages()];
            return response()->json($data,422);
        }
        else{
            $student = new Student;
            $student->name=$request->name;
            $student->email=$request->email;
            $student->phone=$request->phone;
            $student->save();
            $data = ['message'=>'datauploaded succesfully'];
            return response()->json($data,200);
        }
    }
     // update data from json format to database
    public function update(Request $request,$id){

        $validator = validator::make($request->all(),
        [
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required',
        ]);
        if ($validator->fails()){
            $data =['message'=>$validator->messages()];
            return response()->json($data,422);
        }
        else{
            $student = Student::find($id);
            $student->name=$request->name;
            $student->email=$request->email;
            $student->phone=$request->phone;
            $student->save();
            $data = ['message'=>'data updated succesfully'];
            return response()->json($data,200);
        }

    }
    //show Specific data request from json to database
    public function show(Request $request,$id){

        $student = Student::find($id);
        $data =['student' =>$student];
        return response()->json($data,200);
    }
    //Delete specific data from database
    public function delete($id){

        $student = Student::find($id);
        $student ->delete();
        $data = ['message'=>'data deleted succesfully'];
        return response()->json($data,200);

    }

}
