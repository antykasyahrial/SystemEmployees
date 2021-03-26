<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Bcrypt\Bcrypt;
use DataTables;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class EmployeeController extends Controller
{
    use AuthenticatesUsers;
    public function index(){
        return view('login');
    }

    public function add(){
        return view('addData');
    }

    public function edit($id){
        $employee = Employee::find($id);
        return view('editData', ['data'=>$employee]);
    }

    public function staff($id){
        $employee = Employee::find($id);
        return view('profileData', ['data'=>$employee]);
    }

    public function profile(){
        $employee = session()->get('creds');
        return view('staffView', ['data'=>$employee]);   
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
        return redirect('login')->with('pesan', "success");
    }

    public function store(Request $request){
        $bcrypt = new Bcrypt();
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
        $employee->password = $bcrypt->encrypt($request->password);
        $employee->address = $request->address;
        $employee->jabatan = $request->jabatan;
        $employee->save();
        return redirect(route('dashboard'))->with('message',"Data Employee Ditambah");
    }

    public function show(Request $request){
        if ($request->ajax()) {
            $data = Employee::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="edit/'. $row->id .'" class="edit btn btn-primary btn-sm">Edit</a>
                           <a href="delete/'.$row->id.'" class="edit btn btn-danger btn-sm">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard');
    }

    public function destroy($id)
    {
        Employee::where('id', $id)->delete();
        return redirect(route('dashboard'))->with('message',"Data Employee Dihapus");
    }

    public function update(Request $request, $id){
        $bcrypt = new Bcrypt();
        if (Employee::where('id', $id)->exists()){
            $validateData = $request->validate([
                'name'      => 'required|min:4|max:250',
                'username'  => 'required|min:4|max:250',
                'password'  => 'nullable|min:4|max:250',
                'address'   => 'required',
                'jabatan'   => 'required',
            ]);

            $employee = Employee::find($id);
            $employee->name = $request->name;
            $employee->username = $request->username;
            $employee->address = $request->address;
            $employee->jabatan = $request->jabatan;
            if ($request->password != null){
                $employee->password = $bcrypt->encrypt($request->password);
            }
            $employee->save();
            return redirect(route('dashboard'))->with('message',"Data Employee Diubah");
        }
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
