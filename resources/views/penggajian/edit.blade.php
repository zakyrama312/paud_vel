@foreach ($penggajian as $cdt)
    <div class="modal fade" id="modalUpdate{{ $cdt -> id }}" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalUpdateLabel">Edit Penggajian</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('penggajian/'. $id = $cdt -> id ) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-2">
                        <label for="guru" class="form-label">Nama Guru</label>
                        <select  id="guruSelectEdit" name="guru_id" class="form-control" >
                            <option value="{{ $cdt->guru->id }}">{{ $cdt->guru->namaguru }}</option>
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
                        <label for="ruang" class="form-label">Gaji Paud</label>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <input type="text" name="nominalpaud" readonly class="form-control @error('nominalpaud') is-invalid @enderror" id="nominalPaudEdit" value="{{ old('nominalpaud', $cdt->nominalpaud) }}" >
                                @error('nominalpaud')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haripaud" class="form-control @error('haripaud') is-invalid @enderror" id="hariPaudEdit" value="{{ old('haripaud', $cdt->haripaud) }}">
                                @error('haripaud')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totalpaud" readonly class="form-control @error('totalpaud') is-invalid @enderror" id="totalPaudEdit" value="{{ old('totalpaud', $cdt->totalpaud) }}">
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
                                <input type="text" name="nominalpaudsakit" readonly class="form-control @error('nominalpaudsakit') is-invalid @enderror" id="nominalPaudSakitEdit" value="{{ old('nominalpaudsakit', $cdt->nominalpaudsakit) }}" >
                                @error('nominalpaudsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haripaudsakit" class="form-control @error('haripaudsakit') is-invalid @enderror" id="hariPaudSakitEdit" value="{{ old('haripaudsakit', $cdt->haripaudsakit) }}">
                                @error('haripaudsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totalpaudsakit" readonly class="form-control @error('totalpaudsakit') is-invalid @enderror" id="totalPaudSakitEdit" value="{{ old('totalpaudsakit', $cdt->totalpaudsakit) }}">
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
                                <input type="text" name="nominalpaudizin" readonly class="form-control @error('nominalpaudizin') is-invalid @enderror" id="nominalPaudIzinEdit" value="{{ old('nominalpaudizin', $cdt->nominalpaudizin) }}" >
                                @error('nominalpaudizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haripaudizin" class="form-control @error('haripaudizin') is-invalid @enderror" id="hariPaudIzinEdit" value="{{ old('haripaudizin', $cdt->haripaudizin) }}">
                                @error('haripaudizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totalpaudizin" readonly class="form-control @error('totalpaudizin') is-invalid @enderror" id="totalPaudIzinEdit" value="{{ old('totalpaudizin', $cdt->totalpaudizin) }}">
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
                                <input type="text" name="nominaltpq" readonly class="form-control @error('nominaltpq') is-invalid @enderror" id="nominalTPQEdit" value="{{ old('nominaltpq', $cdt->nominaltpq) }}" readonly>
                                @error('nominaltpq')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haritpq" class="form-control @error('haritpq') is-invalid @enderror" id="hariTPQEdit" value="{{ old('haritpq', $cdt->haritpq) }}">
                                @error('haritpq')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totaltpq" readonly class="form-control @error('totaltpq') is-invalid @enderror" id="totalTPQEdit" value="{{ old('totaltpq', $cdt->totaltpq) }}">
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
                                <input type="text" name="nominaltpqsakit" readonly class="form-control @error('nominaltpqsakit') is-invalid @enderror" id="nominalTPQSakitEdit" value="{{ old('nominaltpqsakit', $cdt->nominaltpqsakit) }}" >
                                @error('nominaltpqsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haritpqsakit" class="form-control @error('haritpqsakit') is-invalid @enderror" id="hariTPQSakitEdit" value="{{ old('haritpqsakit', $cdt->haritpqsakit) }}">
                                @error('haritpqsakit')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totaltpqsakit" readonly class="form-control @error('totaltpqsakit') is-invalid @enderror" id="totalTPQSakitEdit" value="{{ old('totaltpqsakit', $cdt->totaltpqsakit) }}">
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
                                <input type="text" name="nominaltpqizin" readonly class="form-control @error('nominaltpqizin') is-invalid @enderror" id="nominalTPQIzinEdit" value="{{ old('nominaltpqizin', $cdt->nominaltpqizin) }}" >
                                @error('nominaltpqizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" placeholder="Hari" inputmode="numeric" name="haritpqizin" class="form-control @error('haritpqizin') is-invalid @enderror" id="hariTPQIzinEdit" value="{{ old('haritpqizin',  $cdt->haritpqizin) }}">
                                @error('haritpqizin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="totaltpqizin" readonly class="form-control @error('totaltpqizin') is-invalid @enderror" id="totalTPQIzinEdit" value="{{ old('totaltpqizin', $cdt->totaltpqizin) }}">
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
                                <input type="text" name="intensif"  class="form-control @error('intensif') is-invalid @enderror" id="intensifEdit" value="{{ old('intensif', $cdt->intensif) }}" >
                                @error('nominaltpq')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="ruang" class="form-label">Hibah</label>
                                <input type="text" name="hibah"  class="form-control @error('hibah') is-invalid @enderror hibah" id="hibahEdit" value="{{ old('hibah', $cdt->hibah) }}">
                                @error('hibah')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="create_nominal" class="form-label">Total</label>
                        <input type="text" id="totalGajiEdit" name="totalgaji" readonly class="form-control @error('total') is-invalid @enderror"
                            value="{{ old('total', $cdt->totalgaji) }}">
                        @error('nominal')
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
