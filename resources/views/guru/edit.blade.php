@foreach ($gurus as $cdt)
    <div class="modal fade" id="modalUpdate{{ $cdt -> id }}" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalUpdateLabel">Edit Guru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('guru/'. $id = $cdt -> id ) }}" id="" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Nama Guru</label>
                        <input type="text" name="namaguru" class="form-control @error('namaguru') is-invalid @enderror" id="kondisi" value="{{ old('namaguru', $cdt->namaguru) }}">
                        @error('namaguru')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Nominal Paud Perhari</label>
                        <input type="text" name="nominalpaud" inputmode="numeric" class="form-control @error('nominalpaud') is-invalid @enderror" id="nominalpaudEdit" value="{{ old('nominalpaud', $cdt->nominalpaud) }}">
                        @error('nominalpaud')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Nominal TPQ Perhari</label>
                        <input type="text" name="nominaltpq" inputmode="numeric" class="form-control @error('nominaltpq') is-invalid @enderror" id="nominaltpqEdit" value="{{ old('nominaltpq', $cdt->nominaltpq) }}">
                        @error('nominaltpq')
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
