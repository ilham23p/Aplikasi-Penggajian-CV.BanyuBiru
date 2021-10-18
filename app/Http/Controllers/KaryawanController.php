<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\KaryawanRequest;
use Session;
use DB;
class KaryawanController extends Controller
{
    public function index()
    {
        $data['karyawan'] = User::where('level', 'karyawan')->get();
        return view('karyawan.index', $data);
    }
    public function store(KaryawanRequest $request)
    {
        User::create($request->all());
        return redirect()->route('karyawan.index');
    }
    public function update(Request $request, $id)
    {
        $requestData = $request->except('password');
        $user = User::findOrFail($id);
        $user->update($requestData);
        return redirect()->route('karyawan.index');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
    public function trash()
    {
        $pengguna = User::onlyTrashed()->get();
        return view('karyawan/pengguna_trash', ['pengguna' => $pengguna]);
    }
    public function restore($id)
    {
        $pengguna = User::onlyTrashed()->where('id', $id);
        $pengguna->restore();
        return redirect()->route('karyawan.index');
    }
    public function force_delete($id)
    {
        $pengguna = User::onlyTrashed()->where('id', $id);
        $pengguna->forceDelete();
        return redirect()->route('karyawan.index');
    }
    public function getNip($id)
    {
        $kode_jabatan = DB::table('jabatans')->select('kode_jabatan')->where('id', $id)->first();
        $max_id = DB::table('users')->select('nip')->where('jabatan_id', $id)->max('nip');
        $urutan = (int) substr($max_id, 3, 3);
        $urutan++;
        $nip= $kode_jabatan->kode_jabatan . sprintf("%03s", $urutan);

        $pendidikan_min=DB::table('jabatans')->select('pendidikan_min')->where('id', $id)->first();
     
        return Response::json(['success'=>true,'nip'=>$nip,'pendidikan'=>$pendidikan_min]);
        
    }
}
