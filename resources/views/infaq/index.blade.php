@extends('layouts.main')
@section('content')
  <div class="card-body" style="background-color: rgb(255, 255, 255)" >
     <div class="">
      <div class="mb-sm-0 row">
        <div class="col-md-4">
            <h5 class="card-title fw-semibold mb-3">Infaq</h5>
            <a href="" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah Data</a>
            {{-- <a href="{{ url('barang-masuk/create') }}" class="btn btn-outline-primary mb-3" >Tambah Data</a> --}}
        </div>
        <div class="col-md-8">
            <div class="row">
                <label for="" style="color: black" class="mb-3">Filter Tanggal</label>
                <div class="col-md-5">
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
                <div class="col-md-5">
                    <input type="date" id="end_date" name="end_date" class="form-control">
                </div>
                <div class="col-md-2">
                    <button id="filter" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
        <table id="tableInfaq" class="table table-striped table-hover mt-5" >
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Jenis</th>
            <th scope="col">Nominal</th>
            <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end"></th>
                <th id="totalNominal"></th>
                <th colspan="1"></th>
            </tr>
        </tfoot>
    </table>
    </div>
  </div>


  <!-- Modal Create-->
  @include('infaq.add')
  {{-- modal Update --}}
  @include('infaq.edit')
  {{-- Modal Delete --}}
  @include('infaq.delete')
@endsection
