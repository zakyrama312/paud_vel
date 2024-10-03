<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePembayaranRequest extends FormRequest
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
            'tanggal' => 'required',
            'namasiswa' => 'required',
            'namapembayaran' => 'required',
            'nominal' => 'required',
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
            'tanggal' => 'Tanggal',
            'namasiswa' => 'Nama Siswa',
            'namapembayaran' => 'Nama Pembayaran',
            'nominal' => 'Nominal',
        ];
    }
}
