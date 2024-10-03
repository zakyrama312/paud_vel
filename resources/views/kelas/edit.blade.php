@foreach ($kelas as $cdt)
    <div class="modal fade" id="modalUpdate{{ $cdt -> id }}" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalUpdateLabel">Edit Kelas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('kelas/'. $id = $cdt -> id ) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Nama Kelas</label>
                        <input type="text" name="namakelas" class="form-control @error('namakelas') is-invalid @enderror" id="kategori" value="{{ old('namakelas', $cdt -> namakelas) }}">
                        @error('namakelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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
