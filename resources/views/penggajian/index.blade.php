@extends('layouts.main')
@section('content')
  <div class="card-body" style="background-color: rgb(255, 255, 255)" >
     <div class="">
      <div class="mb-sm-0 row">
        <div class="col-md-4">
            <h5 class="card-title fw-semibold mb-3">Penggajian</h5>
            <a href="" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Data</a>
            {{-- <a href="{{ url('barang-masuk/create') }}" class="btn btn-outline-primary mb-3" >Tambah Data</a> --}}
        </div>
        <div class="col-md-8 align-self-end">
            <form action="{{ route('printView') }}" method="GET">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-5">
                        <label for="" style="color: black" class="mb-3">Filter Bulan</label>
                        <input type="month" id="start_date" name="month" name="start_date" class="form-control">
                    </div>
                    {{-- <div class="col-md-5">
                        <input type="month" id="end_date" name="end_date" class="form-control">
                    </div> --}}
                    <div class="col-md-2 d-flex align-items-center gap-1" >
                        <button id="filterBulan" class="btn btn-primary" style="margin-top: 35px">Filter</button>
                        <button  id="downloadWord"  class="btn btn-success" style="margin-top: 35px">Print</button>
                    </div>
                </div>
            </form>

        </div>


      </div>
    </div>
    @if (session('error'))
        <div class="alert alert-danger mt-2 " role="alert">
            {{ session('error') }}
        </div>

    @endif
    <div class="table-responsive">
        <table id="tablePenggajian" class="table table-striped table-hover mt-5" >
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama</th>
            {{-- <th scope="col">Hari</th> --}}
            <th scope="col">Paud</th>
            {{-- <th scope="col">Hari</th> --}}
            <th scope="col">TPQ</th>
            <th scope="col">Intensif</th>
            <th scope="col">Hibah</th>
            <th scope="col">Total</th>
            <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penggajian as $gaji)
                <tr>
                    <td>{{ $loop -> iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($gaji->created_at)->locale('id')->translatedFormat('F Y') }}</td>
                    <td>{{ $gaji->guru->namaguru }}</td>
                    {{-- <td>{{ $gaji->haripaud }} hari</td> --}}
                    <td> Rp. {{ number_format(
                        ($gaji->totalpaud ?? 0) +
                        ($gaji->totalpaudsakit ?? 0) +
                        ($gaji->totalpaudizin ?? 0),
                        0, ',', '.')
                    }}</td>
                    {{-- <td>{{ $gaji->haritpq }} hari</td> --}}
                    <td> Rp. {{ number_format(
                        ($gaji->totaltpq ?? 0) +
                        ($gaji->totaltpqsakit ?? 0) +
                        ($gaji->totaltpqizin ?? 0),
                        0, ',', '.')
                    }}</td>
                    <td>Rp.{{ number_format($gaji->intensif, 0, ',', '.') }}</td>
                    <td>Rp.{{ number_format($gaji->hibah, 0, ',', '.') }}</td>
                    <td>Rp.{{ number_format($gaji->totalgaji, 0, ',', '.') }}</td>
                    <td>
                        {{-- <a href="" class="badge text-bg-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $gaji -> id }}"><i class="ti ti-edit"></i></a> --}}
                        <a href="" class="badge text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $gaji -> id }}"><i class="ti ti-trash"></i></a>
                        <a href="" class="badge text-bg-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $gaji -> id }}"><i class="ti ti-details"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>


  <!-- Modal Create-->
  @include('penggajian.add')
  {{-- modal Update --}}
  {{-- @include('penggajian.edit') --}}
  {{-- Modal Delete --}}
   @include('penggajian.delete')
  {{-- Modal Detail --}}
   @include('penggajian.detail')
@endsection


