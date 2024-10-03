<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penggajian = Penggajian::with("guru")->get();
        $guru = Guru::all();
        return view("penggajian.index", compact("penggajian", "guru"));
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
            'nominalpaudsakit' => $this->removeRupiahFormat($request->input('nominalpaudsakit')),
            'nominalpaudizin' => $this->removeRupiahFormat($request->input('nominalpaudizin')),
            'nominaltpq' => $this->removeRupiahFormat($request->input('nominaltpq')),
            'nominaltpqsakit' => $this->removeRupiahFormat($request->input('nominaltpqsakit')),
            'nominaltpqizin' => $this->removeRupiahFormat($request->input('nominaltpqizin')),
            'intensif' => $this->removeRupiahFormat($request->input('intensif')),
            'hibah' => $this->removeRupiahFormat($request->input('hibah')),
            'totalpaud' => $this->removeRupiahFormat($request->input('totalpaud')),
            'totalpaudsakit' => $this->removeRupiahFormat($request->input('totalpaudsakit')),
            'totalpaudizin' => $this->removeRupiahFormat($request->input('totalpaudizin')),
            'totaltpq' => $this->removeRupiahFormat($request->input('totaltpq')),
            'totaltpqsakit' => $this->removeRupiahFormat($request->input('totaltpqsakit')),
            'totaltpqizin' => $this->removeRupiahFormat($request->input('totaltpqizin')),
            'totalgaji' => $this->removeRupiahFormat($request->input('totalgaji')),
        ]);

        // Validasi input
        $data = $request->validate([
            'guru_id' => 'required|string|max:255',
            'nominalpaud' => 'required|integer',
            'haripaud' => 'integer',
            'totalpaud' => 'required|integer',
            'nominalpaudsakit' => 'required|integer',
            'nominalpaudizin' => 'required|integer',
            'haripaudsakit' => 'integer',
            'haripaudizin' => 'integer',
            'totalpaudsakit' => 'required|integer',
            'totalpaudizin' => 'required|integer',
            'nominaltpq' => 'required|integer',
            'haritpq' => 'integer',
            'totaltpq' => 'required|integer',
            'nominaltpqsakit' => 'required|integer',
            'nominaltpqizin' => 'required|integer',
            'haritpqsakit' => 'integer',
            'haritpqizin' => 'integer',
            'totaltpqsakit' => 'required|integer',
            'totaltpqizin' => 'required|integer',
            'intensif' => 'integer',
            'hibah' => 'integer',
            'totalgaji' => 'required|integer',
        ]);

        // Simpan data ke database
        Penggajian::create($data);

        return redirect('penggajian');
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
    public function show(Penggajian $penggajian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penggajian $penggajian)
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
        // 'guru_id' => 'required|exists:guru,id',
            'nominalpaud' => 'required|integer',
            'haripaud' => 'integer',
            'totalpaud' => 'required|integer',

            'nominalpaudsakit' => 'required|integer',
            'haripaudsakit' => 'integer',
            'totalpaudsakit' => 'required|integer',

            'nominalpaudizin' => 'required|integer',
            'haripaudizin' => 'integer',
            'totalpaudizin' => 'required|integer',

            'nominaltpq' => 'required|integer',
            'haritpq' => 'integer',
            'totaltpq' => 'required|integer',

            'nominaltpqsakit' => 'required|integer',
            'haritpqsakit' => 'integer',
            'totaltpqsakit' => 'required|integer',

            'nominaltpqizin' => 'required|integer',
            'haritpqizin' => 'integer',
            'totaltpqizin' => 'required|integer',

            'intensif' => 'integer',
            'hibah' => 'integer',
            'totalgaji' => 'required|integer',
    ]);

    // Temukan data penggajian berdasarkan ID
    $penggajian = Penggajian::findOrFail($id);

    // Hilangkan format rupiah dan simpan sebagai integer
    $penggajian->guru_id = $request->input('guru_id');

    $penggajian->nominalpaud = $this->removeRupiahFormat($request->input('nominalpaud'));
    $penggajian->haripaud = $request->input('haripaud');
    $penggajian->totalpaud = $this->removeRupiahFormat($request->input('totalpaud'));

    $penggajian->nominalpaudsakit = $this->removeRupiahFormat($request->input('nominalpaudsakit'));
    $penggajian->haripaudsakit = $request->input('haripaudsakit');
    $penggajian->totalpaudsakit = $this->removeRupiahFormat($request->input('totalpaudsakit'));

    $penggajian->nominaltpqsakit = $this->removeRupiahFormat($request->input('nominaltpqsakit'));
    $penggajian->haritpqsakit = $request->input('haritpqsakit');
    $penggajian->totaltpqsakit = $this->removeRupiahFormat($request->input('totaltpqsakit'));

    $penggajian->nominaltpq = $this->removeRupiahFormat($request->input('nominaltpq'));
    $penggajian->haritpq = $request->input('haritpq');
    $penggajian->totaltpq = $this->removeRupiahFormat($request->input('totaltpq'));

    $penggajian->intensif = $this->removeRupiahFormat($request->input('intensif'));
    $penggajian->hibah = $this->removeRupiahFormat($request->input('hibah'));
    $penggajian->totalgaji = $this->removeRupiahFormat($request->input('totalgaji'));

    // Simpan perubahan
    $penggajian->save();

    return redirect('penggajian');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Penggajian::findOrFail($id);
        $guru->delete();

        return redirect('penggajian');
    }



// public function printView(Request $request)
// {
//     $month = $request->input('month'); // Ambil parameter bulan

//     if ($month) {
//         $data = Penggajian::whereYear('created_at', substr($month, 0, 4))
//                           ->whereMonth('created_at', substr($month, 5, 2))
//                           ->get();

//         if ($data->isEmpty()) {
//             return response('Data tidak ditemukan', 404);
//         }
//     } else {
//         return response('Silakan pilih bulan terlebih dahulu.', 400);
//     }

//     return view('penggajian.print.index', compact('data'))->render(); // Hanya kirimkan HTML
// }



public function printView(Request $request)
    {
        $month = $request->input('month'); // Mengambil input bulan dari form

        if ($month) {
            // Filter berdasarkan bulan yang dipilih
            $data = Penggajian::whereYear('created_at', substr($month, 0, 4))
                        ->whereMonth('created_at', substr($month, 5, 2))
                        ->get();

             // Cek apakah data kosong
        if ($data->isEmpty()) {
            // Kirim pesan ke view jika data kosong
            return view('penggajian.print.index', ['message' => 'Data belum ada untuk bulan yang dipilih']);
        }
        } else {
            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Silakan pilih bulan terlebih dahulu.');
        }
         return view('penggajian.print.index', compact('data'));
    }


}
