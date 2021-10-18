<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class SlipGajiController extends Controller
{
    public function index()
    {
        
        $data['karyawan'] = User::where('level', 'karyawan')->whereId(auth()->user()->id)->get();
        return view('penggajian.index', $data);
    }

    public function show($id)
    {
        /*awal hitung hari libur nasional*/
        $jumlah_hari = date('t');
        date_default_timezone_set("Asia/Jakarta");

        $array = json_decode(file_get_contents("calendar.json"), true);
        $month = date('m');
        $year = date('Y');
        $jumlah_libur_minggu = array();
        $jumlah_libur_nasional = array();
        for ($d = 1; $d <= $jumlah_hari; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month) {
                $hari_bulan = date('Ymd', $time);
                if (isset($array[$hari_bulan])) {
                    $keterangan = $d . "-" . $month . "-" . $year . " " . $array[$hari_bulan]["deskripsi"];
                    $jumlah_libur_nasional[] = $d;
                } elseif (date("D", strtotime($hari_bulan)) === "Sun") {
                    $jumlah_libur_minggu[] = $d;
                }
            }
        }
        $minggu = count($jumlah_libur_minggu);
        $nasional = count($jumlah_libur_nasional);
        $hari_kerja = ($jumlah_hari - ($minggu + $nasional));
        /*akhir hitung hari libur nasional*/
        
        $month_now = date('m');
        $data['karyawan'] = User::find($id);
        $data['hari_kerja'] = $hari_kerja;
        $lembur = DB::table('lemburs')->where('user_id', $id)->whereMonth('tanggal', $month_now)->get();
        $data['lembur'] = $lembur->sum('lama_lembur');
        $masuk = DB::table('absensis')->where('user_id', $id)->where('status', 'Masuk')->whereMonth('tanggal', $month_now)->get();
        $data['masuk'] = $masuk->count();
        return view('slipgaji.cetak', $data);
    }
}
