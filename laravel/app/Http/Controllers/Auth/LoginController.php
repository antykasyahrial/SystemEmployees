<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use Bcrypt\Bcrypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function index(){
        return view('login');
    }

    

    public function process(Request $request){
        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $result = Employee::where('username', '=', $request->username)->first();
            if($result) {
                $bcrypt = new Bcrypt();
                if($bcrypt->verify($request->password, $result->password)){
                    session(['creds'=>$result]);
                    return redirect(route('handleLogin'));
                } else {
                    return redirect(route('login'))->with('message',"Login gagal");
                }
            } else {
                return redirect(route('login'))->with('message',"Login gagal");
            }
    }

    public function logout(){
        session()->forget('username');
        return redirect('login')->with('message', "Logout Success");
    }

    
    public function authenticated(Request $request)
    {
        $result = session()->get('creds');
        if($result->hasRole('manager')){
            return redirect(route('dashboard'));
        }else if ($result->hasRole('supervisor')){
            return redirect(route('dashboard'));
        } else {
            return redirect(route('profile'));
        }
    }
}
