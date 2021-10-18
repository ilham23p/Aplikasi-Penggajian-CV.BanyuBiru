<?php
namespace App\Http\Controllers;
use App\Laporan;
use App\JurnalUmum;
use App\BukuBesarKas;
use App\BukuBesarGaji;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class LaporanController extends Controller
{
    public function index()
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
        $data['hari_kerja'] = $hari_kerja;
        $month_now = date('m');
        $lembur = DB::table('lemburs')->whereMonth('tanggal', $month_now)->get();
        $data['lembur'] = $lembur->sum('lama_lembur');
        $masuk = DB::table('absensis')->where('status', 'Masuk')->whereMonth('tanggal', $month_now)->get();
        $ijin = DB::table('absensis')->where('status', 'Ijin')->whereMonth('tanggal', $month_now)->get();
        $sakit = DB::table('absensis')->where('status', 'Sakit')->whereMonth('tanggal', $month_now)->get();
        $data['ijin'] = $ijin->count();
        $data['masuk'] = $masuk->count();
        $data['sakit'] = $sakit->count();
        $data['laporan'] = Laporan::all();
        return view('laporan.index', $data);
    }
    public function create(Request $request)
    {
        $month_now = date('m');
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
        $data['hari_kerja'] = $hari_kerja;
        $data['karyawan'] = User::all();
        $lembur = DB::table('lemburs')->whereMonth('tanggal', $month_now)->get();
        $data['lembur'] = $lembur->sum('lama_lembur');
        $masuk = DB::table('absensis')->where('status', 'Masuk')->whereMonth('tanggal', $month_now)->get();
        $ijin = DB::table('absensis')->where('status', 'Ijin')->whereMonth('tanggal', $month_now)->get();
        $sakit = DB::table('absensis')->where('status', 'Sakit')->whereMonth('tanggal', $month_now)->get();
        $data['ijin'] = $ijin->count();
        $data['masuk'] = $masuk->count();
        $data['sakit'] = $sakit->count();
        $data['tanggal_awal']=$request->tanggal_awal;
        $data['tanggal_akhir']=$request->tanggal_akhir;
        $data['laporan'] = Laporan::whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        return view('laporan.create', $data);
    }
    public function store(Request $request)
    {
        $cek = Laporan::whereUserId($request->user_id)->whereBulan($request->bulan)->whereTahun($request->tahun)->first();
        $laporan = Laporan::firstOrCreate(['user_id' => $request->user_id, 'bulan' => $request->bulan, 'tahun' => $request->tahun], $request->all());
        if (!$cek) {
            $tanggal = date('Y-m-d');
            Session::flash('message', 'Gaji Karyawan Berhasil.');
            // jurnal 
            $laporan->jurnalUmum()->create(['keterangan' => 'Gaji', 'debit' => $request->gaji_bersih, 'kredit' => '0', 'tanggal' => $tanggal]);
            $laporan->jurnalUmum()->create(['keterangan' => 'Kas', 'kredit' => $request->gaji_bersih, 'debit' => '0', 'tanggal' => $tanggal]);
        } else {
            Session::flash('message', 'Karyawan atas nama ' . $laporan->user->name . ' sudah gajian bulan ini pada tanggal ' . $laporan->created_at->format('d, F Y'));
        }
        return back();
    }
}
