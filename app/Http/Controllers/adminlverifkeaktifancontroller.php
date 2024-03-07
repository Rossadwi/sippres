<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminlverifkeaktifancontroller extends Controller
{

    private $sekarang;
    public function __construct()
    {
        $now = Carbon::now();
        $nowind = $now->setTimezone('Asia/Jakarta');
        $this->sekarang = $nowind->format('ymdHis');
    }

    public function getverifkeaktifan()
    {
        $data = DB::select("select * from vkeaktifan where isverif = 0;");
        $newjsondata = json_encode($data);
        $dataverif = DB::select("select * from vkeaktifan where isverif = 1;");
        $newjsondataverif = json_encode($dataverif);
        return view('app/admin/verifkeaktifan', ['data' => $newjsondata, 'dataverif' => $newjsondataverif]);
    }


    public function insertkeaktifan(Request $request)
    {
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

        DB::insert("INSERT INTO keaktifan(isverif, nama_kegiatan, waktu, foto, penyelenggara) VALUES (?,?,?,?,?)", [0, $namakegiatan, $waktu, $fotoo, $penyelenggara]);
        return redirect()->route('ajuankeaktifan')->with('success', 'Data berhasil dimasukkan');
    }

    public function updateverifkeaktifan(Request $request)
    {
        // dd($request);
        // return;
        $request->validate([
            'isverif'          =>  'required'
        ], [
            'isverif.required' => 'isverif tidak boleh kosong'
        ]);
        $input = $request->all();
        $id = $input["id_keaktifan"];
        $isverif = $input["isverif"];
        $note = $input["note"] ?? "";

        DB::update("UPDATE keaktifan SET isverif=?,note=? ,updateat =? WHERE id_keaktifan = ? ", [$isverif, $note,$this->sekarang, $id]);
        return redirect()->route('verifkeaktifan')->with('success', 'Data berhasil diupdate');
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
