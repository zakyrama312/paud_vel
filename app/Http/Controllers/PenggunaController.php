<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePenggunaRequest;

class PenggunaController extends Controller
{
    public function index()
    {

        $users = User::all();
        return view('pengguna.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenggunaRequest $request)
    {
        // $idjurusan = Auth::user()->id_jurusan;
        $request->validated();
        User::create([
            'name' => $request->namapengguna,
            'email' => "contoh@gmail.com",
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);


        return redirect('pengguna');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi request
        $data = $request->validate([
            'namapengguna' => 'required|string|max:255',
            // 'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'role' => 'required|string',
            // tambahkan validasi lainnya sesuai kebutuhan Anda
        ]);

        // Temukan model berdasarkan $id
        $pengguna = User::findOrFail($id);

        // Update nilai-nilai model
        $pengguna->name = $data['namapengguna'];
        $pengguna->username = $data['username'];
        $pengguna->password = bcrypt($data['password']);
        $pengguna->role = $data['role'];

        // Simpan perubahan
        $pengguna->save();

        // Redirect atau kembali ke halaman yang sesuai
        return redirect('pengguna');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return redirect('pengguna');
    }
}
