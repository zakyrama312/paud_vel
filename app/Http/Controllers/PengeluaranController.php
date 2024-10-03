<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pengeluaran = Pengeluaran::all();


        if ($request->ajax()) {
            $query = Pengeluaran::query();

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

        return view('pengeluaran.index', compact('pengeluaran'));
    }



    public function store(StorepengeluaranRequest $request)
    {
        $request->validated();
        Pengeluaran::create([
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'pemakaian' =>  $request->pemakaian,
        ]);

       return redirect('pengeluaran');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update( $request, $id)
    {
        $data = $request->validate([
            'tanggal' => 'required|string|max:255',
            'nominal' => 'required|string|max:255',
            'pemakaian' => 'required|string|max:255',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->tanggal = $data['tanggal'];
        $pengeluaran->nominal = $data['nominal'];
        $pengeluaran->pemakaian = $data['pemakaian'];

        $pengeluaran->save();

        return redirect('pengeluaran');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruang = Pengeluaran::findOrFail($id);
        $ruang->delete();

        return redirect('pengeluaran');
    }
}
