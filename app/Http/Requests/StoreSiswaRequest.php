<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'namasiswa' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Data :attribute harus diisi',
            'unique' => 'Data sudah ada',
            'min' => 'Jumlah karakter kurang',
            'max' => 'Jumlah karakter terlalu panjang',
            'email' => 'Harus berupa Email',
            'numeric' => 'Harus berupa Nomor'
        ];
    }
    public function attributes(): array
    {
        return [
            'namasiswa' => 'Nama Siswa',
            'kelas' => 'Kelas',
            'alamat' => 'Merk Barang',
        ];
    }
}
