<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::all();
        return view("guru.index", compact("gurus"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Hapus format Rupiah sebelum melakukan validasi
        $request->merge([
            'nominalpaud' => $this->removeRupiahFormat($request->input('nominalpaud')),
            'nominaltpq' => $this->removeRupiahFormat($request->input('nominaltpq'))
        ]);

        // Validasi input
        $data = $request->validate([
            'namaguru' => 'required|string|max:255',
            'nominalpaud' => 'integer',
            'nominaltpq' => 'integer',
        ]);

        // Simpan data ke database
        Guru::create($data);

        return redirect('guru');
    }

    // Fungsi untuk menghapus format Rupiah
    private function removeRupiahFormat($value)
    {
        // Hapus semua karakter selain angka
        return str_replace('.', '', preg_replace('/[^\d]/', '', $value));
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'namaguru' => 'required|string|max:255',
            'nominalpaud' => 'required|numeric',
            'nominaltpq' => 'required|numeric',
        ]);

        // Cari data guru berdasarkan ID
        $guru = Guru::findOrFail($id);

        // Hapus format Rupiah dari nominal sebelum menyimpan ke database
        $nominalpaud = preg_replace('/[^0-9]/', '', $request->input('nominalpaud'));
        $nominaltpq = preg_replace('/[^0-9]/', '', $request->input('nominaltpq'));

        // Update data guru
        $guru->namaguru = $request->input('namaguru');
        $guru->nominalpaud = (int) $nominalpaud; // Konversi ke integer
        $guru->nominaltpq = (int) $nominaltpq;   // Konversi ke integer
        $guru->save();

        // Redirect atau response setelah update
        return redirect('guru');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect('guru');
    }
}
