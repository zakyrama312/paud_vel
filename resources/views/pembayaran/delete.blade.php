@foreach ($pembayaran as $cdt)
    <div class="modal fade" id="modalDelete{{ $cdt -> id }}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalDeleteLabel">Hapus Pembayaran</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <form action="{{ url('pembayaran/'. $id = $cdt -> id ) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="mb-3">
                        <p style="color: black">Apakah anda yakin untuk menghapus Pembayaran {{ $cdt -> namapembayaran }} {{ $cdt->namasiswa }} ?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach
