<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Http\Requests\StoreJenisRequest;
use App\Http\Requests\UpdateJenisRequest;

class JenisController extends Controller
{
     public function index()
    {
        $jenis = Jenis::all();
        return view('jenis.index', compact('jenis'));
    }


    public function store(StorejenisRequest $request)
    {
        $request->validated();
        Jenis::create([
            'namajenis' => $request->namajenis,
        ]);

       return redirect('jenis');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejenisRequest $request, $id)
    {
        $data = $request->validate([
            'namajenis' => 'required|string|max:255',
        ]);

        $ruang = Jenis::findOrFail($id);

        $ruang->namajenis = $data['namajenis'];

        $ruang->save();

        return redirect('jenis');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruang = Jenis::findOrFail($id);
        $ruang->delete();

        return redirect('jenis');
    }
}
