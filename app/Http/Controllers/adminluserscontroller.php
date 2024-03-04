<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminluserscontroller extends Controller
{
    public function getusers(){
        $datauser = DB::select("select * from users");
        $newjsondatauser = json_encode($datauser);
        return view('app/admin/users', ['datauser' => $newjsondatauser]);
    }


    public function insertuser(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'email'         =>  'required|email',
            'password'         =>  'required',
            'role'         =>  'required',
        ],[
            'name.required' => 'nama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'email tidak valid',
            'password.required' => 'password tidak boleh kosong',
            'role.required' => 'role tidak boleh kosong' 
        ]);
        $input = $request->all();
        $name = $input["name"];
        $email = $input["email"];
        $password = Hash::make($input["password"]);
        $role = $input["role"];
        DB::insert("INSERT INTO users(name,email,password,role) VALUES (?,?,?,?)", [$name, $email, $password, $role]);

        return redirect()->route('getusers')->with('success', 'Data berhasil dimasukkan');
    }
    public function updateuser(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'email'         =>  'required|email',
            'role'         =>  'required',
        ],[
            'name.required' => 'nama tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
            'email.email' => 'email tidak valid',
            'role.required' => 'role tidak boleh kosong' 
        ]);
        $input = $request->all();
        $id = $input["iddata"];
        $name = $input["name"];
        $email = $input["email"];
        $password = $input["password"] ? Hash::make($input["password"]) : $input["passwordd"];
        $role = $input["role"];
        DB::update("UPDATE users SET name=?,email=?,password=?,role=? WHERE id = ? ", [$name, $email, $password, $role, $id]);

        return redirect()->route('getusers')->with('success', 'Data berhasil diupdate');
    }
    public function deleteuser(Request $request)
    {
        $id = $request->id;
        DB::delete("delete from users where id = ?", [$id]);
        return redirect()->route('getusers')->with('success', 'Data berhasil didelete');
    }
}
