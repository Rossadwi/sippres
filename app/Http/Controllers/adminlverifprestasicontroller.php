<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminlverifprestasicontroller extends Controller
{

    private $sekarang;
    public function __construct()
    {
        $now = Carbon::now();
        $nowind = $now->setTimezone('Asia/Jakarta');
        $this->sekarang = $nowind->format('ymdHis');
    }

    public function getverifprestasi()
    {
        $data = DB::select("select * from vprestasi where isverif = 0;");
        $newjsondata = json_encode($data);
        $dataverif = DB::select("select * from vprestasi where isverif = 1;");
        $newjsondataverif = json_encode($dataverif);
        return view('app/admin/verifprestasi', ['data' => $newjsondata, 'dataverif' => $newjsondataverif]);
    }


    public function insertajuanprestasi(Request $request)
    {
        // dd($request);
        $request->validate([
            'judul'          =>  'required',
            'penyelenggara'  =>  'required',
            'bukti'         =>  'required',
            'tingkat'         =>  'required',
            'tanggal'         =>  'required',
        ], [
            'judul.required' => 'judul tidak boleh kosong',
            'penyelenggara.required' => 'penyelenggara tidak boleh kosong',
            'bukti.required' => 'bukti tidak boleh kosong',
            'tingkat.required' => 'tingkat tidak boleh kosong',
            'tanggal.required' => 'tanggal tidak boleh kosong',
        ]);
        // return;
        if ($image = $request->file('bukti')) {
            $destinationPath = 'prestasi/';
            $file_name = $this->sekarang . '.' . request()->bukti->getClientOriginalExtension();
            $image->move($destinationPath, $file_name);
            $foto = $file_name;
        }
        $input = $request->all();
        $judul = $input["judul"];
        $penyelenggara = $input["penyelenggara"];
        $tingkat = $input["tingkat"];
        $tanggal = $input["tanggal"];
        DB::insert("INSERT INTO prestasi(judul, penyelenggara,bukti, tingkat, tanggal) VALUES (?,?,?,?,?)", [$judul, $penyelenggara, $foto, $tingkat, $tanggal]);

        return redirect()->route('ajuanprestasi')->with('success', 'Data berhasil dimasukkan');
    }

    public function updateverifprestasi(Request $request)
    {
        // dd($request);
        // return;
        $request->validate([
            'isverif'          =>  'required'
        ], [
            'isverif.required' => 'isverif tidak boleh kosong'
        ]);
        $input = $request->all();
        $id = $input["id_prestasi"];
        $isverif = $input["isverif"];
        $note = $input["note"] ?? "";

        DB::update("UPDATE prestasi SET isverif=?,note=?,updateat=? WHERE id_prestasi = ? ", [$isverif, $note,$this->sekarang, $id]);
        return redirect()->route('verifprestasi')->with('success', 'Data berhasil diupdate');
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
