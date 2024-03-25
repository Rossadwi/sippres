<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminlinfolombacontroller extends Controller
{

    private $sekarang;
    public function __construct()
    {
        $now = Carbon::now();
        $nowind = $now->setTimezone('Asia/Jakarta');
        $this->sekarang = $nowind->format('ymdHis');
    }
    public function getinfolomba()
    {
        $data = DB::select("select * from infolomba");
        $newjsondata = json_encode($data);
        return view('app/admin/infolomba', ['data' => $newjsondata]);
    }


    public function insertlomba(Request $request)
    {
        $request->validate([
            'nama_lomba'         =>  'required',
            'penyelenggara'         =>  'required',
            'deskripsi'         =>  'required',
            'waktu_daftar'         =>  'required',
            'waktu_tutup'         =>  'required',

        ], [
            'nama_lomba.required' => 'nama lomba tidak boleh kosong',
            'penyelenggara.required' => 'penyelenggara tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'waktu_daftar.required' => 'waktu daftar tidak boleh kosong',
            'waktu_tutup.required' => 'waktu tutup tidak boleh kosong'
        ]);
        if ($image = $request->file('foto')) {
            $destinationPath = 'poster/';
            $file_name = $this->sekarang . '.' . request()->foto->getClientOriginalExtension();
            $image->move($destinationPath, $file_name);
            $foto = $file_name;
        }
        $input = $request->all();
        $nama_lomba = $input["nama_lomba"];
        $penyelenggara = $input["penyelenggara"];
        $deskripsi = $input["deskripsi"];
        $waktu_daftar = $input["waktu_daftar"];
        $waktu_tutup = $input["waktu_tutup"];
        $fotoo = $foto ?? 'profile.png';
        $panduan = $input["panduan"];
        DB::insert("INSERT INTO infolomba(nama_lomba,penyelenggara,deskripsi,foto,waktu_daftar,waktu_tutup,panduan) VALUES (?,?,?,?,?,?,?)", [$nama_lomba, $penyelenggara, $deskripsi, $fotoo, $waktu_daftar,$waktu_tutup,$panduan]);

        return redirect()->route('getinfolomba')->with('success', 'Data berhasil dimasukkan');
    }
    public function updatelomba(Request $request)
    {
        $request->validate([
            'nama_lomba'         =>  'required',
            'penyelenggara'         =>  'required',
            'deskripsi'         =>  'required',
            'waktu_daftar'         =>  'required',
            'waktu_tutup'         =>  'required'
        ], [
            'nama_lomba.required' => 'nama lomba tidak boleh kosong',
            'penyelenggara.required' => 'penyelenggara tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
            'waktu_daftar.required' => 'waktu daftar tidak boleh kosong',
            'waktu_tutup.required' => 'waktu tutup tidak boleh kosong'
        ]);
        $destinationPath = 'poster/';
        $input = $request->all();
        if ($image = $request->file('foto')) {
            $file_name = $this->sekarang . '.' . request()->foto->getClientOriginalExtension();
            $image->move($destinationPath, $file_name);

            if ($request->fotoo !== "profile.png") {
                $pathimgold = $destinationPath . $request->fotoo;
                if (file_exists($pathimgold)) {
                    @unlink($pathimgold);
                }
            }
            $foto = $file_name;
        } else {
            unset($foto);
        };
        $nama_lomba = $input["nama_lomba"];
        $penyelenggara = $input["penyelenggara"];
        $deskripsi = $input["deskripsi"];
        $waktu_daftar = $input["waktu_daftar"];
        $waktu_tutup = $input["waktu_tutup"];
        $fotoo = $foto ?? $input["fotoo"];
        $panduan = $input["panduan"];
        $id = $input["iddata"];
        DB::update("UPDATE infolomba SET nama_lomba=?,penyelenggara=?,deskripsi=?,foto=?,waktu_daftar=?,waktu_tutup=?,panduan=? WHERE id_infolomba = ? ", [$nama_lomba, $penyelenggara, $deskripsi, $fotoo, $waktu_daftar,$waktu_tutup,$panduan, $id]);
        return redirect()->route('getinfolomba')->with('success', 'Data berhasil diupdate');
    }
    public function deletelomba(Request $request)
    {
        $id = $request->id;
        $foto = $request->foto;
        $destinationPath = 'poster/';
        if ($foto !== "profile.png") {
            $pathimgold = $destinationPath . $foto;
            if (file_exists($pathimgold)) {
                @unlink($pathimgold);
            }
        }
        DB::delete("delete from infolomba where id_infolomba = ?", [$id]);
        return redirect()->route('getinfolomba')->with('success', 'Data berhasil didelete');
    }
}
