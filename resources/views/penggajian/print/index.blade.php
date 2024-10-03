<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.3.1/html-docx.js"></script> --}}
  </head>
  <body>
    <div class="container-fluid" id="content">
        @if (isset($message))
        <div class="alert alert-warning">
            {{ $message }}
        </div>
        @else
        <div class="row justify-content-between g-2">
            @foreach ($data as $p)
            <div class="col-md-4 col-6 p-2 border border-dark-light">
                <div class="row mb-2 text-dark">
                    <div class="col-md-6 col-6 fw-bolder fs-6 fs-md-5 fs-lg-4">{{ $p->guru->namaguru }}</div> <!-- Responsive font-size -->
                    <div class="col-md-6 col-6 text-end fs-6 fs-md-5 fs-lg-4">{{ \Carbon\Carbon::parse($p->created_at)->locale('id')->translatedFormat('F Y') }}</div> <!-- Responsive font-size -->
                </div>
                @if($p->nominalpaud)
                <div class="p-2 border mb-1 text-dark">
                    <p class="fw-bolder fs-6 fs-md-5">Paud</p> <!-- Responsive font-size -->
                    <div class="row">
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Masuk</div> <!-- Responsive font-size -->
                        @if($p->haripaudsakit)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Sakit</div> <!-- Responsive font-size -->
                        @endif
                        @if($p->haripaudizin)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Izin</div> <!-- Responsive font-size -->
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Rp.{{ number_format($p->nominalpaud, 0, ',', '.') }}x{{ $p->haripaud }} Hari</div> <!-- Responsive font-size -->
                        @if($p->haripaudsakit)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Rp.{{ number_format($p->nominalpaudsakit, 0, ',', '.') }}x{{ $p->haripaudsakit }} Hari</div> <!-- Responsive font-size -->
                        @endif
                        @if($p->haripaudizin)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Rp.{{ number_format($p->nominalpaudizin, 0, ',', '.') }}x{{ $p->haripaudizin }} Hari</div> <!-- Responsive font-size -->
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-4 fw-bold fs-7 fs-md-6">Rp.{{ number_format($p->totalpaud, 0, ',', '.') }}</div> <!-- Responsive font-size -->
                        @if($p->haripaudsakit)
                        <div class="col-md-4 col-4 fw-bold fs-7 fs-md-6">Rp.{{ number_format($p->totalpaudsakit, 0, ',', '.') }}</div> <!-- Responsive font-size -->
                        @endif
                        @if($p->haripaudizin)
                        <div class="col-md-4 col-4 fw-bold fs-7 fs-md-6">Rp.{{ number_format($p->totalpaudizin, 0, ',', '.') }}</div> <!-- Responsive font-size -->
                        @endif
                    </div>
                    <div class="row mt-2">
                        <p class="fw-bolder fs-6 fs-md-5">Total: Rp.{{ number_format( ($p->totalpaud ?? 0) + ($p->totalpaudsakit ?? 0) + ($p->totalpaudizin ?? 0), 0, ',', '.')}}</p> <!-- Responsive font-size -->
                    </div>
                </div>
                @endif
                @if($p->nominaltpq)
                <div class="p-2 border text-dark mb-2">
                    <p class="fw-bolder fs-6 fs-md-5">TPQ</p> <!-- Responsive font-size -->
                    <div class="row">
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Masuk</div> <!-- Responsive font-size -->
                        @if($p->haritpqsakit)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Sakit</div> <!-- Responsive font-size -->
                        @endif
                        @if($p->haritpqizin)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Izin</div> <!-- Responsive font-size -->
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Rp.{{ number_format($p->nominaltpq, 0, ',', '.') }}x{{ $p->haritpq }} Hari</div> <!-- Responsive font-size -->
                        @if($p->haritpqsakit)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Rp.{{ number_format($p->nominaltpqsakit, 0, ',', '.') }}x{{ $p->haritpqsakit }} Hari</div> <!-- Responsive font-size -->
                        @endif
                        @if($p->haritpqizin)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Rp.{{ number_format($p->nominaltpqizin, 0, ',', '.') }}x{{ $p->haritpqizin }} Hari</div> <!-- Responsive font-size -->
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-4 fw-bold fs-7 fs-md-6">Rp.{{ number_format($p->totaltpq, 0, ',', '.') }}</div> <!-- Responsive font-size -->
                        @if($p->haritpqsakit)
                        <div class="col-md-4 col-4 fw-bold fs-7 fs-md-6">Rp.{{ number_format($p->totaltpqsakit, 0, ',', '.') }}</div> <!-- Responsive font-size -->
                        @endif
                        @if($p->haritpqizin)
                        <div class="col-md-4 col-4 fw-bold fs-7 fs-md-6">Rp.{{ number_format($p->totaltpqizin, 0, ',', '.') }}</div> <!-- Responsive font-size -->
                        @endif
                    </div>
                    <div class="row mt-2">
                        <p class="fw-bolder fs-6 fs-md-5">Total: Rp.{{ number_format( ($p->totaltpq ?? 0) + ($p->totaltpqsakit ?? 0) + ($p->totaltpqizin ?? 0), 0, ',', '.')}}</p> <!-- Responsive font-size -->
                    </div>
                </div>
                @endif
                <div class="p-2 border text-dark">
                    <div class="row">
                        @if($p->intensif)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Intensif</div> <!-- Responsive font-size -->
                        <div class="col-md-4 col-4 fs-7 fs-md-6"><span class="fw-bolder">Rp.{{ number_format($p->intensif, 0, ',', '.') }}</span></div> <!-- Responsive font-size -->
                        @endif
                    </div>
                    <div class="row">
                        @if($p->hibah)
                        <div class="col-md-4 col-4 fs-7 fs-md-6">Hibah</div> <!-- Responsive font-size -->
                        <div class="col-md-4 col-4 fs-7 fs-md-6"><span class="fw-bolder">Rp.{{ number_format($p->hibah, 0, ',', '.') }}</span></div> <!-- Responsive font-size -->
                        @endif
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 col-4 fw-bolder fs-6 fs-md-5">Total Gaji</div> <!-- Responsive font-size -->
                        <div class="col-md-4 col-4 fs-6 fs-md-5"><span class="fw-bolder">Rp.{{ number_format($p->totalgaji, 0, ',', '.') }}</span></div> <!-- Responsive font-size -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.3.1/html-docx.js"></script>
    <script>
        window.print()
    </script>
  </body>
</html>
