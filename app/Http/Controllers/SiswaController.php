<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Kelas;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas')->get();
        $kelas = Kelas::all();
        return view('siswa.index', compact('siswas', 'kelas'));
    }


    public function store(StoreSiswaRequest $request)
    {
        $request->validated();
        Siswa::create([
            'namasiswa' => $request->namasiswa,
            'kelas_id' => $request->kelas,
            'alamat' => "-"
        ]);

       return redirect('siswa');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, $id)
    {
        $data = $request->validate([
            'namasiswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $siswa = Siswa::findOrFail($id);

        $siswa->namasiswa = $data['namasiswa'];
        $siswa->kelas_id = $data['kelas'];

        $siswa->save();

        return redirect('siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruang = Siswa::findOrFail($id);
        $ruang->delete();

        return redirect('siswa');
    }
}
