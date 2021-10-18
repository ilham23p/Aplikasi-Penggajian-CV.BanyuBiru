<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Level;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;


class PenggunaController extends Controller
{
    public function index()
    {
        if ( Auth::user()->level== "owner") {
            $level = "admin";
        } elseif (Auth::user()->level == "admin") {
            $level = "karyawan";
        }
        $data['user'] = User::where('level', $level)->get();
        //print("<pre>".print_r($data,true)."</pre>");
        $data['roles'] = Level::all();
        return view('pengguna.index', $data);
    }

    public function store(UserRequest $request)
    {
        $post = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'level' => $request->input('role'),
            'password' => $request->input('password'),
        ];
        // dd($post);
        User::create($post);
        return redirect()->route('pengguna.index');
    }

    public function update(Request $request, $id)
    {
        $post = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'level' => $request->input('role'),
            'password' => $request->input('password'),
        ];
        $user = User::findOrFail($id);
        $user->update($post);
        return redirect()->route('pengguna.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('pengguna.index');
    }
}
