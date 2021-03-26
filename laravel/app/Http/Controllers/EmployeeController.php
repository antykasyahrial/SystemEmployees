<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    public function index(){
        return view('login');
    }

    public function add(){
        return view('addData');
    }

    public function process(Request $request){
        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $result = Staff::where('username', '=', $validateData['username'])->first();
            if($result) {
                if(($request -> password == $result->password)){
                    session(['username' => $request->username]);
                    return redirect('/');
                } else {
                    return back()->withInput()->with('pesan', "failed");
                }
            } else {
                return back()->withInput()->with('pesan', "failed");
            }
    }

    public function logout(){
        session()->forget('username');
        return redirect('login')->with('pesan', "success");
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name'      => 'required|min:4|max:250',
            'username'  => 'required|min:4|max:250',
            'password'  => 'required|min:4|max:250',
            'address'   => 'required',
            'jabatan'   => 'required',
        ]);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->username = $request->username;
        $employee->password = $request->password;
        $employee->address = $request->address;
        $employee->jabatan = $request->jabatan;
        $employee->save();
        return 1;
    }
}
