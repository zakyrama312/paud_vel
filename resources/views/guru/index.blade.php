@extends('layouts.main')
@section('content')
  <div class="card-body" style="background-color: rgb(255, 255, 255)" >
    <div class="d-sm-flex d-block align-items-center justify-content-between">
      <div class="mb-3 mb-sm-0">
        <h5 class="card-title fw-semibold mb-3">Guru</h5>
       <a href="" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Data</a>
      </div>
    </div>
    <div class="table-responsive">
        <table id="tabeldata" class="table table-striped table-hover mt-5" >
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Guru</th>
            <th scope="col">Nominal Paud Perhari</th>
            <th scope="col">Nominal TPQ Perhari</th>
            <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gurus as $cdt)
            <tr>
                <td scope="row">{{ $loop -> iteration }}</td>
                <td>{{ $cdt -> namaguru }}</td>
                <td>Rp.{{ number_format($cdt->nominalpaud, 0, ',', '.') }}</td>
                <td>Rp.{{ number_format($cdt->nominaltpq, 0, ',', '.') }}</td>
                {{-- <td>{{ $cdt -> alamat }}</td> --}}
                <td>
                    <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $cdt -> id }}"><i class="ti ti-edit"></i></a>
                    <a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $cdt -> id }}"><i class="ti ti-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </div>


  <!-- Modal Create-->
  @include('guru.add')
  {{-- modal Update --}}
  @include('guru.edit')
  {{-- Modal Delete --}}
  @include('guru.delete')
@endsection
