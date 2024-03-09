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
        $dataverif = DB::select("select * from vprestasi where isverif = 1 order by updateat desc;");
        $newjsondataverif = json_encode($dataverif);
        // return $newjsondataverif;
        return view('landing/index', ['data' => $newjsondataverif]);
    }


}
