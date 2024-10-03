<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Infaq;
use App\Models\Jurusan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $tanggal = date('Y-m-d');
        $paud = Infaq::where('jenis_id', 1)
                        ->where('tanggal', $tanggal)->first();
        $tpq = Infaq::where('jenis_id', 2)
                        ->where('tanggal', $tanggal)->first();
        $pembayaran = Pembayaran::where('tanggal', $tanggal)->sum('nominal');

        $pengeluaran = Pengeluaran::where('tanggal', $tanggal)->sum('nominal');

    return view('dashboard.index', compact('paud','tpq','pembayaran','pengeluaran'));
    }
}
