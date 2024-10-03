@foreach ($pengeluaran as $cdt)
    <div class="modal fade" id="modalUpdate{{ $cdt -> id }}" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalUpdateLabel">Edit Pengeluaran</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('infaq/'. $id = $cdt -> id ) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="kategori" value="{{ old('tanggal', $cdt -> tanggal) }}">
                        @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Pemakaian Transaksi</label>
                        <input type="text" name="pemakaian" class="form-control @error('pemakaian') is-invalid @enderror" id="kategori" value="{{ old('pemakaian', $cdt -> pemakaian) }}">
                        @error('pemakaian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_nominal" class="form-label">Nominal</label>
                        <input type="text" id="edit_formatted_nominalPemakaian" class="form-control @error('nominal') is-invalid @enderror"
                            value="{{ old('nominal', number_format($cdt->nominal, 0, ',', '.')) }}">
                        <input type="hidden" name="nominal" id="edit_nominalPemakaian" value="{{ old('nominal', $cdt->nominal) }}">
                        @error('nominal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- <div class="mb-3">
                        <label for="ruang" class="form-label">Alamat</label>
                        <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="kondisi" >{{ old('alamat', $cdt -> alamat) }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach
