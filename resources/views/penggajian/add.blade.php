<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalCreateLabel">Tambah Penggajian</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('penggajian') }}" id="formGaji" method="post">
                     @csrf
                    <div class="mb-2">
                        <label for="guru" class="form-label">Nama Guru</label>
                        <select  id="guruSelect" name="guru_id" class="form-control" >
                            <option value="">--Pilih Guru--</option>
                            @foreach ($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->namaguru }}</option>
                            @endforeach
                        </select>
                        @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="ruang" class="form-label">Gaji Masuk Paud</label>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" name="nominalpaud" readonly class="form-control @error('nominalpaud') is-invalid @enderror" id="nominalPaud" value="{{ old('nominalpaud') }}" >
                                @error('nominalpaud')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haripaud" class="form-control @error('haripaud') is-invalid @enderror" id="hariPaud" value="{{ old('haripaud') }}">
                                @error('haripaud')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totalpaud" readonly class="form-control @error('totalpaud') is-invalid @enderror" id="totalPaud" value="{{ old('totalpaud') }}">
                                @error('totalpaud')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="ruang" class="form-label">Sakit</label>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" name="nominalpaudsakit" readonly class="form-control @error('nominalpaudsakit') is-invalid @enderror" id="nominalPaudSakit" value="{{ old('nominalpaudsakit') }}" >
                                @error('nominalpaudsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haripaudsakit" class="form-control @error('haripaudsakit') is-invalid @enderror" id="hariPaudSakit" value="{{ old('haripaudsakit') }}">
                                @error('haripaudsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totalpaudsakit" readonly class="form-control @error('totalpaudsakit') is-invalid @enderror" id="totalPaudSakit" value="{{ old('totalpaudsakit') }}">
                                @error('totalpaudsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="ruang" class="form-label">Izin</label>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" name="nominalpaudizin" readonly class="form-control @error('nominalpaudizin') is-invalid @enderror" id="nominalPaudIzin" value="{{ old('nominalpaudizin') }}" >
                                @error('nominalpaudizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haripaudizin" class="form-control @error('haripaudizin') is-invalid @enderror" id="hariPaudIzin" value="{{ old('haripaudizin') }}">
                                @error('haripaudizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totalpaudizin" readonly class="form-control @error('totalpaudizin') is-invalid @enderror" id="totalPaudIzin" value="{{ old('totalpaudizin') }}">
                                @error('totalpaudizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="ruang" class="form-label">Gaji TPQ</label>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" name="nominaltpq" readonly class="form-control @error('nominaltpq') is-invalid @enderror" id="nominalTPQ" value="{{ old('nominaltpq') }}" readonly>
                                @error('nominaltpq')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haritpq" class="form-control @error('haritpq') is-invalid @enderror" id="hariTPQ" value="{{ old('haritpq') }}">
                                @error('haritpq')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totaltpq" readonly class="form-control @error('totaltpq') is-invalid @enderror" id="totalTPQ" value="{{ old('totaltpq') }}">
                                @error('totaltpq')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="ruang" class="form-label">Sakit</label>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" name="nominaltpqsakit" readonly class="form-control @error('nominaltpqsakit') is-invalid @enderror" id="nominalTPQSakit" value="{{ old('nominaltpqsakit') }}" >
                                @error('nominaltpqsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haritpqsakit" class="form-control @error('haritpqsakit') is-invalid @enderror" id="hariTPQSakit" value="{{ old('haritpqsakit') }}">
                                @error('haritpqsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totaltpqsakit" readonly class="form-control @error('totaltpqsakit') is-invalid @enderror" id="totalTPQSakit" value="{{ old('totaltpqsakit') }}">
                                @error('totaltpqsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="ruang" class="form-label">Izin</label>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" name="nominaltpqizin" readonly class="form-control @error('nominaltpqizin') is-invalid @enderror" id="nominalTPQIzin" value="{{ old('nominaltpqizin') }}" >
                                @error('nominaltpqizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haritpqizin" class="form-control @error('haritpqizin') is-invalid @enderror" id="hariTPQIzin" value="{{ old('haritpqizin') }}">
                                @error('haritpqizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totaltpqizin" readonly class="form-control @error('totaltpqizin') is-invalid @enderror" id="totalTPQIzin" value="{{ old('totaltpqizin') }}">
                                @error('totaltpqizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="ruang" class="form-label">Intensif</label>
                                <input type="text" name="intensif"  class="form-control @error('intensif') is-invalid @enderror" id="intensif" value="{{ old('intensif') }}" >
                                @error('nominaltpq')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="ruang" class="form-label">Hibah</label>
                                <input type="text" name="hibah"  class="form-control @error('hibah') is-invalid @enderror hibah" id="hibah" value="{{ old('hibah') }}">
                                @error('hibah')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="create_nominal" class="form-label">Total</label>
                        <input type="text" id="totalGaji" name="totalgaji" readonly class="form-control @error('total') is-invalid @enderror"
                            value="{{ old('total') }}">
                        @error('nominal')
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
