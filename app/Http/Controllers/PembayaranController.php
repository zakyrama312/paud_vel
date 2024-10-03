<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $pembayaran = Pembayaran::all();

        if ($request->ajax()) {
            $query = Pembayaran::query();

            // Terapkan filter tanggal
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $startDate = \Carbon\Carbon::parse($request->start_date)->startOfDay();
                $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            }

            $data = $query->orderBy('tanggal', 'desc')->get();
              // Hitung total nominal
            $totalNominal = $data->sum('nominal');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate'. $row->id .'""><i class="ti ti-edit text-warning"></i></a>';
                    $btn .= '<a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete'. $row->id .'"><i class="ti ti-trash text-danger"></i></a>';
                    return $btn;
                })
                ->editColumn('tanggal', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal)->locale('id')->translatedFormat('d F Y');
                })
                ->editColumn('nominal', function($row) {
                    return "Rp ". number_format($row->nominal, 0, ',', '.');
                })
                ->with('totalNominal', "Rp " . number_format($totalNominal, 0, ',', '.'))
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pembayaran.index', compact('pembayaran'));
    }



    public function store(StorePembayaranRequest $request)
    {
        $request->validated();
        Pembayaran::create([
            'tanggal' => $request->tanggal,
            'namasiswa' => $request->namasiswa,
            'namapembayaran' => $request->namapembayaran,
            'nominal' => $request->nominal,
        ]);

       return redirect('pembayaran');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePembayaranRequest $request, $id)
    {
        $data = $request->validate([
            'tanggal' => 'required|date|max:255',
            'namasiswa' => 'required|string|max:255',
            'namapembayaran' => 'required|string|max:255',
            'nominal' => 'required|string|max:255',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->tanggal = $data['tanggal'];
        $pembayaran->namasiswa = $data['namasiswa'];
        $pembayaran->namapembayaran = $data['namapembayaran'];
        $pembayaran->nominal = $data['nominal'];

        $pembayaran->save();

        return redirect('pembayaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruang = Pembayaran::findOrFail($id);
        $ruang->delete();

        return redirect('pembayaran');
    }
}
