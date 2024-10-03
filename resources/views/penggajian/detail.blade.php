@foreach ($penggajian as $p)
    <div class="modal fade" id="modalDetail{{ $p -> id }}" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalDetailLabel">Detail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                    <div class="row mb-2 text-dark">
                        <div class="col-md-6 col-6 fw-bolder">{{ $p->guru->namaguru }}</div>
                        <div class="col-md-6 col-6 text-end">{{ \Carbon\Carbon::parse($p->created_at)->locale('id')->translatedFormat('F Y') }}</div>
                    </div>
                    @if($p->nominalpaud)
                        <div class="p-2 border mb-1 text-dark ">
                        <p class="fw-bolder">Paud</p>
                            <div class="row">
                                <div class="col-md-4 col-4">Masuk</div>
                                <div class="col-md-4 col-4">Sakit</div>
                                <div class="col-md-4 col-4">Izin</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4">Rp.{{ number_format($p->nominalpaud, 0, ',', '.') }}x{{ $p->haripaud }} Hari</div>
                                <div class="col-md-4 col-4">Rp.{{ number_format($p->nominalpaudsakit, 0, ',', '.') }}x{{ $p->haripaudsakit }} Hari</div>
                                <div class="col-md-4 col-4">Rp.{{ number_format($p->nominalpaudizin, 0, ',', '.') }}x{{ $p->haripaudizin }} Hari</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 fw-bold">Rp.{{ number_format($p->totalpaud, 0, ',', '.') }}</div>
                                <div class="col-md-4 col-4 fw-bold">Rp.{{ number_format($p->totalpaudsakit, 0, ',', '.') }}</div>
                                <div class="col-md-4 col-4 fw-bold">Rp.{{ number_format($p->totalpaudizin, 0, ',', '.') }}</div>
                            </div>
                            <div class="row mt-2">
                                <p class="fw-bolder">Total : Rp.{{ number_format( ($p->totalpaud ?? 0) + ($p->totalpaudsakit ?? 0) + ($p->totalpaudizin ?? 0), 0, ',', '.')}}</p>
                            </div>
                    </div>
                    @endif
                    @if($p->nominaltpq)
                        <div class="p-2 border text-dark mb-2">
                        <p class="fw-bolder">TPQ</p>
                            <div class="row">
                                <div class="col-md-4 col-4">Masuk</div>
                                <div class="col-md-4 col-4">Sakit</div>
                                <div class="col-md-4 col-4">Izin</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4">Rp.{{ number_format($p->nominaltpq, 0, ',', '.') }}x{{ $p->haritpq }} Hari</div>
                                <div class="col-md-4 col-4">Rp.{{ number_format($p->nominaltpqsakit, 0, ',', '.') }}x{{ $p->haritpqsakit }} Hari</div>
                                <div class="col-md-4 col-4">Rp.{{ number_format($p->nominaltpqizin, 0, ',', '.') }}x{{ $p->haritpqizin }} Hari</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4 fw-bold">Rp.{{ number_format($p->totaltpq, 0, ',', '.') }}</div>
                                <div class="col-md-4 col-4 fw-bold">Rp.{{ number_format($p->totaltpqsakit, 0, ',', '.') }}</div>
                                <div class="col-md-4 col-4 fw-bold">Rp.{{ number_format($p->totaltpqizin, 0, ',', '.') }}</div>
                            </div>
                            <div class="row mt-2">
                                <p class="fw-bolder">Total : Rp.{{ number_format( ($p->totaltpq ?? 0) + ($p->totaltpqsakit ?? 0) + ($p->totaltpqizin ?? 0), 0, ',', '.')}}</p>
                            </div>
                    </div>
                    @endif
                    <div class="p-2 border text-dark ">
                        {{-- <p class="fw-bolder">TPQ</p> --}}
                            <div class="row">
                                <div class="col-md-4 col-4">Intensif </div>
                                <div class="col-md-4 col-4"><span class="fw-bolder">Rp.{{ number_format($p->intensif, 0, ',', '.') }}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4">Hibah </div>
                                <div class="col-md-4 col-4"><span class="fw-bolder">Rp.{{ number_format($p->hibah, 0, ',', '.') }}</span></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 col-4 fw-bolder">Total Gaji </div>
                                <div class="col-md-4 col-4"><span class="fw-bolder">Rp.{{ number_format($p->totalgaji, 0, ',', '.') }}</span></div>

                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach
