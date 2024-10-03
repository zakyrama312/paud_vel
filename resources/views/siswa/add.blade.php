<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalCreateLabel">Tambah Siswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('siswa') }}" method="post">
                     @csrf
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Nama Siswa</label>
                        <input type="text" name="namasiswa" class="form-control @error('namasiswa') is-invalid @enderror" id="kondisi" value="{{ old('namasiswa') }}">
                        @error('namasiswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ruang" class="form-label">Kelas</label>
                        <select name="kelas" class="form-control @error('kelas') is-invalid @enderror" >
                            <option value="">--pilih kelas--</option>
                            @foreach ($kelas as $kl)
                                <option value="{{ old('kelas', $kl->id) }}">{{ $kl->namakelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="ruang" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="kondisi" >{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
