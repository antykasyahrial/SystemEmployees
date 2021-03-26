<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Bcrypt\Bcrypt;
use DataTables;
class EmployeeController extends Controller
{
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
}
