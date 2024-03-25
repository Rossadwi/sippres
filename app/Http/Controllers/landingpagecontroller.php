<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class landingpagecontroller extends Controller
{

    private $sekarang;
    public function __construct()
    {
        $now = Carbon::now();
        $nowind = $now->setTimezone('Asia/Jakarta');
        $this->sekarang = $nowind->format('ymdHis');
    }

    public function getdata()
    {
        // $dataverif = DB::select("select * from vprestasi where isverif = 1 order by updateat desc;");
        $data = DB::table('vprestasi')->where('isverif',"=",1)->orderBy('updateat', 'DESC')->paginate(3);
        // $data = DB::select("SELECT * FROM infolomba ORDER BY createddate DESC");
        // $newjsondata = json_encode($data);
        // return view('app/siswa/infolomba', ['data' => $data]);
        // $newjsondataverif = json_encode($dataverif);
        // return $newjsondataverif;
        return view('landing/index', ['data' => $data]);
    }


}
