<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class siswalajuanprestasicontroller extends Controller
{

    private $sekarang;
    public function __construct(){
        $now = Carbon::now();
        $nowind = $now->setTimezone('Asia/Jakarta');
        $this->sekarang = $nowind->format('ymdHis');
    }
    public function getajuanprestasi(){
        $data = DB::select("select * from prestasi");
        $newjsondata = json_encode($data);
        return view('app/siswa/ajuanprestasi', ['data' => $newjsondata]);
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
        ],[
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
            $image->move($destinationPath,$file_name);
            $foto= $file_name;
        }
        $input = $request->all();
        $judul = $input["judul"];
        $penyelenggara = $input["penyelenggara"];
        $tingkat = $input["tingkat"];
        $tanggal = $input["tanggal"];
        DB::insert("INSERT INTO prestasi(judul, penyelenggara,bukti, tingkat, tanggal) VALUES (?,?,?,?,?)", [$judul, $penyelenggara, $foto, $tingkat, $tanggal]);

        return redirect()->route('ajuanprestasi')->with('success', 'Data berhasil dimasukkan');
    }
    public function updateajuanprestasi(Request $request)
    {
        $request->validate([
            'judul'          =>  'required',
            'penyelenggara'  =>  'required',
            'tingkat'         =>  'required',
            'tanggal'         =>  'required',
        ],[
            'judul.required' => 'judul tidak boleh kosong',
            'penyelenggara.required' => 'penyelenggara tidak boleh kosong',
            'tingkat.required' => 'tingkat tidak boleh kosong',
            'tanggal.required' => 'tanggal tidak boleh kosong',
        ]);
        $destinationPath = 'prestasi/';
        $input = $request->all();
        if ($image = $request->file('bukti')) {
                $file_name = $this->sekarang. '.' . request()->bukti->getClientOriginalExtension();
                $image->move($destinationPath,$file_name);
                    $pathimgold = $destinationPath.$request->buktii;
                    if (file_exists($pathimgold)) {
                            @unlink($pathimgold);
                        }
                    $foto = $file_name;
        }else {
                    unset($foto);
        };
        $judul = $input["judul"];
        $penyelenggara = $input["penyelenggara"];
        $tingkat = $input["tingkat"];
        $tanggal = $input["tanggal"];
        $fotoo = $foto ?? $input["buktii"];
        $id = $input["iddata"];

        DB::update("UPDATE prestasi SET judul=?,penyelenggara=?,bukti=?,tingkat=?,tanggal=?,isverif=? WHERE id_prestasi = ? ", [$judul, $penyelenggara, $fotoo, $tingkat, $tanggal,0, $id]);
        return redirect()->route('ajuanprestasi')->with('success', 'Data berhasil diupdate');
    }
    public function deletesiswa(Request $request)
    {
        $id = $request->id;
        $foto = $request->foto;
        $destinationPath = 'images/';
        if ($foto !== "profile.jpg") {
            $pathimgold = $destinationPath.$foto;
            if (file_exists($pathimgold)) {
                    @unlink($pathimgold);
                }
        }
        DB::delete("delete from siswa where id_siswa = ?", [$id]);
        return redirect()->route('getsiswa')->with('success', 'Data berhasil didelete');
    }
}
