<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminlsiswacontroller extends Controller
{

    private $sekarang;
    public function __construct(){
        $now = Carbon::now();
        $nowind = $now->setTimezone('Asia/Jakarta');
        $this->sekarang = $nowind->format('ymdHis');
    }
    public function getsiswa(){
        $data = DB::select("select * from siswa");
        $newjsondata = json_encode($data);
        return view('app/admin/kelolasiswa', ['data' => $newjsondata]);
    }


    public function insertsiswa(Request $request)
    {
        $request->validate([
            'nama_siswa'          =>  'required',
            'nisn'         =>  'required',
            'jurusan'         =>  'required',
            'angkatan'         =>  'required',
            'alamat'         =>  'required',
            'telp'         =>  'required',
        ],[
            'nama_siswa.required' => 'nama siswa tidak boleh kosong',
            'nisn.required' => 'nisn tidak boleh kosong',
            'jurusan.required' => 'jurusan tidak boleh kosong',
            'angkatan.required' => 'angkatan tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
            'telp.required' => 'telp tidak boleh kosong' 
        ]);
        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            $file_name = $this->sekarang . '.' . request()->foto->getClientOriginalExtension();
            $image->move($destinationPath,$file_name);
            $foto= $file_name;
        }
        $input = $request->all();
        $nama_siswa = $input["nama_siswa"];
        $NISN = $input["nisn"];
        $jurusan = $input["jurusan"];
        $angkatan = $input["angkatan"];
        $alamat = $input["alamat"];
        $telp = $input["telp"];
        $fotoo = $foto ?? 'profile.jpg';
        $password = "$2y$12$7xX4kCMJ//s0qlNtvIZ4ZecgDfEHVZXF.drhpnwiyV6w.d2QIQ3eK";  //passdefault : 1234
        DB::insert("INSERT INTO siswa(NISN,nama_siswa,jurusan,angkatan,alamat,telp,foto) VALUES (?,?,?,?,?,?,?)", [$NISN, $nama_siswa, $jurusan, $angkatan, $alamat, $telp, $fotoo]);
        DB::insert("INSERT INTO users(name,username,password,role) VALUES (?,?,?,?)", [$nama_siswa,$NISN,$password, 0]);
        return redirect()->route('getsiswa')->with('success', 'Data berhasil dimasukkan');
    }
    public function updatesiswa(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'nisn'         =>  'required',
            'jurusan'         =>  'required',
            'angkatan'         =>  'required',
            'alamat'         =>  'required',
            'telp'         =>  'required',
        ],[
            'name.required' => 'nama siswa tidak boleh kosong',
            'nisn.required' => 'nisn tidak boleh kosong',
            'jurusan.required' => 'jurusan tidak boleh kosong',
            'angkatan.required' => 'angkatan tidak boleh kosong',
            'alamat.required' => 'alamat tidak boleh kosong',
            'telp.required' => 'telp tidak boleh kosong' 
        ]);
        $destinationPath = 'images/';
        $input = $request->all();
        if ($image = $request->file('foto')) {
                $file_name = $this->sekarang. '.' . request()->foto->getClientOriginalExtension();
                $image->move($destinationPath,$file_name);

                if ($request->fotoo !== "profile.jpg") {
                    $pathimgold = $destinationPath.$request->fotoo;
                    if (file_exists($pathimgold)) {
                            @unlink($pathimgold);
                        }
                }
                    $foto = $file_name;
        }else {
                    unset($foto);
        };
        $nama_siswa = $input["name"];
        $NISN = $input["nisn"];
        $jurusan = $input["jurusan"];
        $angkatan = $input["angkatan"];
        $alamat = $input["alamat"];
        $telp = $input["telp"];
        $fotoo = $foto ?? $input["fotoo"];
        $id = $input["iddata"];
        DB::update("UPDATE siswa SET NISN=?,nama_siswa=?,jurusan=?,angkatan=?,alamat=?,telp=?,foto=? WHERE id_siswa = ? ", [$NISN, $nama_siswa, $jurusan, $angkatan, $alamat, $telp, $fotoo, $id]);
        return redirect()->route('getsiswa')->with('success', 'Data berhasil diupdate');
    }
    public function deletesiswa(Request $request)
    {
        
        $all = json_decode($request->dtal);
        $id = $request->id;
        // $siswa = DB::select("select * from siswa where id_siswa = ?", [$id]);
        // var_dump($siswa[0]->NISN);
        // return;
        $foto = $all->foto;
        $destinationPath = 'images/';
        if ($foto !== "profile.jpg") {
            $pathimgold = $destinationPath.$foto;
            if (file_exists($pathimgold)) {
                    @unlink($pathimgold);
                }
        }
        DB::delete("delete from siswa where id_siswa = ?", [$id]);
        DB::delete("delete from users where username = ?", [$all->NISN]);
        return redirect()->route('getsiswa')->with('success', 'Data berhasil didelete');
    }
}
