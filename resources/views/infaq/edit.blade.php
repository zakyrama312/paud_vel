@foreach ($infaq as $cdt)
    <div class="modal fade" id="modalUpdate{{ $cdt -> id }}" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalUpdateLabel">Edit Infaq</h1>
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
                        <label for="ruang" class="form-label">Jenis Infaq</label>
                        <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" ">
                            <option value="{{ $cdt->jenis->id }}">{{ $cdt->jenis->namajenis }}</option>
                            <option value="">--pilih jenis--</option>
                            @foreach ($jenis as $kl)
                                <option value="{{ old('jenis', $kl->id) }}">{{ $kl->namajenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="edit_nominal" class="form-label">Nominal</label>
                        <input type="text" id="edit_formatted_nominal" class="form-control @error('nominal') is-invalid @enderror"
                            value="{{ old('nominal', number_format($cdt->nominal, 0, ',', '.')) }}">
                        <input type="hidden" name="nominal" id="edit_nominal" value="{{ old('nominal', $cdt->nominal) }}">
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
