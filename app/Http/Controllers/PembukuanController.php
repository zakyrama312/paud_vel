<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembukuanController extends Controller
{
    public function index(){
        $transaksi = DB::table('infaqs')
                    ->select(DB::raw("tanggal, namajenis as keterangan, nominal as debet, null as kredit"))
                    ->join('jenis', 'infaqs.jenis_id', '=', 'jenis.id')
                    ->union(
                        DB::table('pengeluarans')
                            ->select(DB::raw("tanggal, pemakaian as keterangan, null as debet, nominal as kredit"))
                    )
                    ->orderBy('tanggal', 'asc')
                    ->get();
        $saldo_awal = 2049750; // misal saldo awal
        $saldo = $saldo_awal;
        $transaksi = $transaksi->map(function($item) use (&$saldo) {
            $item->saldo = $saldo += ($item->debet ?? 0) - ($item->kredit ?? 0);
            return $item;
        });

        return view('pembukuan.index', compact('transaksi'));
    }
}
