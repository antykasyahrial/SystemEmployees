<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view('login');
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
}
