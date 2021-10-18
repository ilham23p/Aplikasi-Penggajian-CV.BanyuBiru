<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Laporan;
use App\JurnalUmum;
use App\BukuBesarKas;
use App\BukuBesarGaji;
use App\User;
use Illuminate\Support\Facades\DB;
use Session;
class LaporanJabatanController extends Controller
{
    public function index()
    {
        $month_now = date('m');
        $data['karyawan'] = User::all();
        $lembur = DB::table('lemburs')->whereMonth('tanggal', $month_now)->get();
        $data['lembur'] = $lembur->sum('lama_lembur');

        /*awal hitung hari libur nasional*/
        $jumlah_hari = date('t');
        date_default_timezone_set("Asia/Jakarta");
      
        $array = json_decode(file_get_contents("calendar.json"),true);
        $month = date('m');
        $year = date('Y');
        $jumlah_libur_minggu=array();
        $jumlah_libur_nasional=array();
        for ($d = 1; $d <= $jumlah_hari; $d++)
        {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month)
            {   
                $hari_bulan = date('Ymd', $time);
                if(isset($array[$hari_bulan]))
                {   
                    $keterangan=$d."-".$month."-".$year." ".$array[$hari_bulan]["deskripsi"];
                    $jumlah_libur_nasional[]=$d;
                }
                elseif(date("D",strtotime($hari_bulan))==="Sun")
                {
                    $jumlah_libur_minggu[]=$d;
                }
            }
        }
        $minggu=count($jumlah_libur_minggu);
        $nasional=count($jumlah_libur_nasional);
        $hari_kerja=($jumlah_hari-($minggu+$nasional));
        /*akhir hitung hari libur nasional*/

        $masuk = DB::table('absensis')->where('status', 'Masuk')->whereMonth('tanggal', $month_now)->get();
        $ijin = DB::table('absensis')->where('status', 'Ijin')->whereMonth('tanggal', $month_now)->get();
        $sakit = DB::table('absensis')->where('status', 'Sakit')->whereMonth('tanggal', $month_now)->get();
        $data['ijin'] = $ijin->count();
        $data['masuk'] = $masuk->count();
        $data['sakit'] = $sakit->count();
        $data['hari_kerja']=$hari_kerja;
        $data['keterangan']=$keterangan;
        $data['laporan'] = Laporan::all();
        return view('laporan_jabatan.index', $data);
    }
}
