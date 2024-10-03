<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use App\Models\Jenis;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInfaqRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateInfaqRequest;

class InfaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $infaq = Infaq::with('jenis')->get();
        $jenis = Jenis::all();

        if ($request->ajax()) {
            $query = Infaq::with('jenis');

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
                ->editColumn('jenis_id', function($row) {
                    return $row->jenis->namajenis;
                })
                ->with('totalNominal', "Rp " . number_format($totalNominal, 0, ',', '.'))
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('infaq.index', compact('infaq', 'jenis'));
    }



    public function store(StoreInfaqRequest $request)
    {
        $request->validated();
        Infaq::create([
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'jenis_id' =>  $request->jenis,
        ]);

       return redirect('infaq');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfaqRequest $request, $id)
    {
        $data = $request->validate([
            'tanggal' => 'required|string|max:255',
            'nominal' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
        ]);

        $infaq = Infaq::findOrFail($id);

        $infaq->tanggal = $data['tanggal'];
        $infaq->nominal = $data['nominal'];
        $infaq->jenis_id = $data['jenis'];

        $infaq->save();

        return redirect('infaq');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruang = Infaq::findOrFail($id);
        $ruang->delete();

        return redirect('infaq');
    }
}
