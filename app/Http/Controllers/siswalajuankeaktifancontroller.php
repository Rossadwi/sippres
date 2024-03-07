<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class siswalajuankeaktifancontroller extends Controller
{

    private $sekarang;
    public function __construct()
    {
        $now = Carbon::now();
        $nowind = $now->setTimezone('Asia/Jakarta');
        $this->sekarang = $nowind->format('ymdHis');
    }
    public function getkeaktifan()
    {
        $idsiswa = auth()->user()->tampilnmuser(auth()->user()->username)->id_siswa;
        $data = DB::select("select * from keaktifan where id_siswa = ?",[$idsiswa]);
        $newjsondata = json_encode($data);
        return view('app/siswa/ajuankeaktifan', ['data' => $newjsondata]);
    }


    public function insertkeaktifan(Request $request)
    {
        $idsiswa = auth()->user()->tampilnmuser(auth()->user()->username)->id_siswa;
        // dd($request);
        $request->validate([
            'namakegiatan'    =>  'required',
            'waktu'         =>  'required',
            'penyelenggara'  =>  'required',
            // 'foto'         =>  'required',
        ], [
            'namakegiatan.required' => 'nama kegiatan tidak boleh kosong',
            'waktu.required' => 'waktu tidak boleh kosong',
            'penyelenggara.required' => 'penyelenggara tidak boleh kosong',
            // 'foto.required' => 'foto tidak boleh kosong',
        ]);
        // return;
        if ($image = $request->file('foto')) {
            $destinationPath = 'keaktifan/';
            $file_name = $this->sekarang . '.' . request()->foto->getClientOriginalExtension();
            $image->move($destinationPath, $file_name);
            $foto = $file_name;
        }
        $input = $request->all();
        $namakegiatan = $input["namakegiatan"];
        $waktu = $input["waktu"];
        $penyelenggara = $input["penyelenggara"];
        $fotoo = $foto ?? "";

        DB::insert("INSERT INTO keaktifan(isverif, nama_kegiatan, waktu, foto, penyelenggara,id_siswa) VALUES (?,?,?,?,?,?)", [0, $namakegiatan, $waktu, $fotoo, $penyelenggara,$idsiswa]);
        return redirect()->route('ajuankeaktifan')->with('success', 'Data berhasil dimasukkan');
    }

    public function updatekeaktifan(Request $request)
    {
        $request->validate([
            'namakegiatan'    =>  'required',
            'waktu'         =>  'required',
            'penyelenggara'  =>  'required',
            // 'foto'         =>  'required',
        ], [
            'namakegiatan.required' => 'nama kegiatan tidak boleh kosong',
            'waktu.required' => 'waktu tidak boleh kosong',
            'penyelenggara.required' => 'penyelenggara tidak boleh kosong',
            // 'foto.required' => 'foto tidak boleh kosong',
        ]);
        $destinationPath = 'keaktifan/';
        $input = $request->all();
        if ($image = $request->file('foto')) {
            $file_name = $this->sekarang . '.' . request()->foto->getClientOriginalExtension();
            $image->move($destinationPath, $file_name);
            $pathimgold = $destinationPath . $request->fotoo;
            if (file_exists($pathimgold)) {
                @unlink($pathimgold);
            }
            $foto = $file_name;
        } else {
            unset($foto);
        };
        $namakegiatan = $input["namakegiatan"];
        $waktu = $input["waktu"];
        $penyelenggara = $input["penyelenggara"];
        $fotoo = $foto ?? $input["fotoo"];
        $id = $input["iddata"];

        DB::update("UPDATE keaktifan SET isverif=?,nama_kegiatan=?,waktu=?,foto=?,penyelenggara=?,note=? WHERE id_keaktifan = ? ", [0, $namakegiatan, $waktu, $fotoo, $penyelenggara, "", $id]);
        return redirect()->route('ajuankeaktifan')->with('success', 'Data berhasil diupdate');
    }
    public function deletesiswa(Request $request)
    {
        $id = $request->id;
        $foto = $request->foto;
        $destinationPath = 'images/';
        if ($foto !== "profile.jpg") {
            $pathimgold = $destinationPath . $foto;
            if (file_exists($pathimgold)) {
                @unlink($pathimgold);
            }
        }
        DB::delete("delete from siswa where id_siswa = ?", [$id]);
        return redirect()->route('getsiswa')->with('success', 'Data berhasil didelete');
    }
}
