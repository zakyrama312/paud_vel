<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }


    public function store(StoreKelasRequest $request)
    {
        $request->validated();
        Kelas::create([
            'namakelas' => $request->namakelas,
        ]);

       return redirect('kelas');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasRequest $request, $id)
    {
        $data = $request->validate([
            'namakelas' => 'required|string|max:255',
        ]);

        $ruang = Kelas::findOrFail($id);

        $ruang->namakelas = $data['namakelas'];

        $ruang->save();

        return redirect('kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruang = Kelas::findOrFail($id);
        $ruang->delete();

        return redirect('kelas');
    }
}
