@extends('layouts.main')
@section('content')


                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Data hari ini</h5>
                    <div class="row align-items-center">
                      <div class="col-md-3">
                        <div class="cards" style="margin-top: -100px; margin-bottom: 10px">
                            <div class="card-body">
                                <div class="card-title text-center"><span style="font-size: 14px;">Harian Infaq Paud</span></div>
                                <div class="card-text text-center">
                                     @if($paud)
                                            <span style="color: black; font-size: large; font-weight: bold;"> Rp {{ number_format($paud->nominal, 0, ',', '.') }}</span>
                                        @else
                                            <span style="color: black; font-size: 12px;" >Data infaq untuk hari ini belum diinput.</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="cards" style="margin-top: -100px; margin-bottom: 10px">
                            <div class="card-body">
                                <div class="card-title text-center"><span style="font-size: 14px;">Harian Infaq TPQ</span></div>
                                <div class="card-text text-center">
                                     @if($tpq)
                                           <span style="color: black; font-size: large; font-weight: bold;">Rp {{ number_format($tpq->nominal, 0, ',', '.') }}</span>
                                        @else
                                            <span style="color: black;" >Data infaq untuk hari ini belum diinput.</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="cards" style="margin-top: -100px; margin-bottom: 10px">
                            <div class="card-body">
                                <div class="card-title text-center"><span style="font-size: 14px;">Pembayaran Biaya</span></div>
                                <div class="card-text text-center">
                                     @if($pembayaran)
                                           <span style="color: black; font-size: large; font-weight: bold;">Rp {{ number_format($pembayaran, 0, ',', '.') }}</span>
                                        @else
                                            <span style="color: black;" >Data infaq untuk hari ini belum diinput.</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="cards" style="margin-top: -100px; margin-bottom: 10px">
                            <div class="card-body">
                                <div class="card-title text-center"><span style="font-size: 14px;">Pengeluaran Dana</span></div>
                                <div class="card-text text-center">
                                     @if($pengeluaran)
                                           <span style="color: black; font-size: large; font-weight: bold;">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</span>
                                        @else
                                            <span style="color: black;" >Data infaq untuk hari ini belum diinput.</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

@endsection
