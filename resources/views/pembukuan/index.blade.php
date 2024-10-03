@extends('layouts.main')
@section('content')
  <div class="card-body" style="background-color: rgb(255, 255, 255)" >
     <div class="">
      <div class="mb-sm-0 row">
        <div class="col-md-4">
            <h5 class="card-title fw-semibold mb-3">Pembukuan</h5>
        </div>
        <div class="col-md-8">
            <div class="row">
                <label for="" style="color: black" class="mb-3">Filter Tanggal</label>
                <div class="col-md-6">
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
                <div class="col-md-6">
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>
                {{-- <div class="col-md-2">
                    <button id="filterPembukuan" class="btn btn-primary">Filter</button>
                </div> --}}
            </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
        <table id="tablePembukuan" class="table table-striped table-hover mt-5" >
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Debet</th>
            <th scope="col">Kredit</th>
            <th scope="col">Saldo</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transaksi as $key => $trans)
            <tr>
                <td>{{ $loop -> iteration }}</td>
                <td data-tanggal="{{ $trans->tanggal }}">{{  \Carbon\Carbon::parse($trans->tanggal)->locale('id')->translatedFormat('d F Y') }}</td>
                <td>{{ $trans->keterangan }}</td>
                <td data-debet="{{ $trans->debet }}"> Rp.{{ number_format($trans->debet, 0, ',', '.') }}</td>
                <td data-kredit="{{ $trans->kredit }}"> Rp.{{ number_format($trans->kredit, 0, ',', '.') }}</td>
                <td data-saldo="{{ $trans->debet }}">Rp.{{ number_format($trans->saldo, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right"></th>
                <th id="totalDebet">0</th>
                <th id="totalKredit">0</th>
                <th colspan="1"></th>
            </tr>
        </tfoot>
    </table>
    </div>
  </div>



@endsection
