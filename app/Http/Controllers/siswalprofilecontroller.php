<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class siswalprofilecontroller extends Controller
{

    private $sekarang;
    public function __construct()
    {
        $now = Carbon::now();
        $nowind = $now->setTimezone('Asia/Jakarta');
        $this->sekarang = $nowind->format('ymdHis');
    }

    public function getprofile()
    {
        // $iduser = $request->input('idsiswa');
        // $iduser = auth()->user()->tampilnmuser(auth()->user()->username);
        $iduser = auth()->user()->username;
        // dd($iduser->nama_siswa);
        // return;
        $data = DB::select("select * from siswa where nisn =?", [$iduser]);
        $newjsondata = json_encode($data);
        return view('app/siswa/profile', ['data' => $newjsondata]);
    }


    public function editpwd(Request $request)
    {
        $pwdnew = Hash::make($request->password);
        $id = auth()->user()->id;
        DB::update("UPDATE users SET password=? WHERE id = ? ", [$pwdnew, $id]);
        return redirect()->route('profilesiswa')->with('success', 'Password berhasil diupdate');
    }

    public function editfoto(Request $request)
    {

        $destinationPath = 'images/';
        $input = $request->all();
        if ($image = $request->file('foto')) {
            $file_name = $this->sekarang . '.' . request()->foto->getClientOriginalExtension();
            $image->move($destinationPath, $file_name);

            if ($request->fotoo !== "profile.jpg") {
                $pathimgold = $destinationPath . $request->fotoo;
                if (file_exists($pathimgold)) {
                    @unlink($pathimgold);
                }
            }
            $foto = $file_name;
        } else {
            unset($foto);
        };
        $fotoo = $foto ?? $input["fotoo"];
        $id = $input["iddata"];
        DB::update("UPDATE siswa SET foto=? WHERE id_siswa = ? ", [$fotoo, $id]);
        return redirect()->route('profilesiswa')->with('success', 'Password berhasil diupdate');
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
