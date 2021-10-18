<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KaryawanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nip' => 'required|min:6', 
            'pendidikan' => 'required', 
            'kota_lahir' => 'required', 
            'tgl_lahir' => 'required', 
            'jk' => 'required', 
            'agama' => 'required', 
            'alamat' => 'required', 
            'jabatan_id' => 'required',
        ];
    }
}


