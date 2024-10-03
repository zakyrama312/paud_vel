<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalCreateLabel">Tambah Guru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('guru') }}" method="post">
                     @csrf
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Nama Guru</label>
                        <input type="text" name="namaguru" class="form-control @error('namaguru') is-invalid @enderror" id="kondisi" value="{{ old('namaguru') }}">
                        @error('namaguru')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Nominal Paud Perhari</label>
                        <input type="text" name="nominalpaud" inputmode="numeric" class="form-control @error('nominalpaud') is-invalid @enderror" id="nominalpaud" value="{{ old('nominalpaud') }}">
                        @error('nominalpaud')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Nominal TPQ Perhari</label>
                        <input type="text" name="nominaltpq" inputmode="numeric" class="form-control @error('nominaltpq') is-invalid @enderror" id="nominaltpq" value="{{ old('nominaltpq') }}">
                        @error('nominaltpq')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
