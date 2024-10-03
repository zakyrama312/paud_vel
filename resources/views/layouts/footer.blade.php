
  <script src="{{ asset('/')}}assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="{{ asset('/')}}assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('/')}}assets/js/sidebarmenu.js"></script>
  <script src="{{ asset('/')}}assets/js/app.min.js"></script>
  <script src="{{ asset('/')}}assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="{{ asset('/')}}assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="{{ asset('/')}}assets/js/dashboard.js"></script>
  <script src="{{ asset('/')}}assets/datatables/datatables.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>

    <!-- JSZip for Excel Export -->
    <script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/js/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>


    <!-- PDFMake for PDF Export -->
    <script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/pdfmake-00.2.7/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/pdfmake-00.2.7/vfs_fonts.js"></script>

    <!-- DataTables HTML5 Buttons -->
    <script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/js/buttons.html5.min.js"></script>

    <!-- DataTables Print Button -->
    <script src="{{ asset('/') }}assets/datatables/Buttons-2.4.2/js/buttons.print.min.js"></script>

    {{-- search --}}
      {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.3.1/html-docx.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script src="{{ asset('/') }}assets/select2/select2.min.js"></script>
<script>
$("#country").select2( {
	placeholder: "Select Country",
	allowClear: true
	} );

    $('#modalCreate').on('shown.bs.modal', function () {
    $('#country').select2({
        dropdownParent: $('#modalCreate') // Set parent dropdown ke modal
    });
});

</script>
  <script>
    $(document).ready(function() {
        $('#tabeldata').DataTable( {
            // dom: 'Bfrtip',

        } );
    } );
  </script>

  <script>
    document.querySelectorAll('.sidebar-link').forEach(function(link) {
    link.addEventListener('click', function() {
        // Toggle kelas 'open' pada klik
        this.classList.toggle('open');
    });
});

  </script>






<script>
    const dropdownSelect = document.querySelector('.dropdown-select');
    const dropdownList = document.getElementById('dropdownList');

    dropdownSelect.addEventListener('focus', () => {
        dropdownList.style.display = 'block';
    });

    dropdownSelect.addEventListener('blur', () => {
        setTimeout(() => {
            dropdownList.style.display = 'none';
        }, 200);
    });

    dropdownList.addEventListener('mousedown', (e) => {
        e.preventDefault();
        const selectedOption = e.target.textContent;
        dropdownSelect.value = selectedOption;
        dropdownList.style.display = 'none';
    });

    function filterFunction() {
        const filter = dropdownSelect.value.toLowerCase();
        const divs = dropdownList.getElementsByTagName('div');

        for (let i = 0; i < divs.length; i++) {
            const txtValue = divs[i].textContent || divs[i].innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                divs[i].style.display = "";
            } else {
                divs[i].style.display = "none";
            }
        }
    }
</script>

<script>
$(document).ready(function() {
    var tableInfaq = $('#tableInfaq').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("infaq.index") }}',
            data: function(d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },
            dataSrc: function(json) {
                $('#totalNominal').html(json.totalNominal);
                return json.data;
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'jenis_id', name: 'jenis_id', className: 'text-center' },
            { data: 'nominal', name: 'nominal' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }
        ],
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        @if (Auth::user()->role=='admin')
        dom: 'Blfrtip',
        @endif
        buttons: [

            { extend: 'excelHtml5', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } },
            { extend: 'pdfHtml5', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } },
            { extend: 'print', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } }
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            var total = api
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return parseInt(a) + parseInt(b.toString().replace(/[\Rp. ,]/g, ''));
                }, 0);

            var pageTotal = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function(a, b) {
                    return parseInt(a) + parseInt(b.toString().replace(/[\Rp. ,]/g, ''));
                }, 0);

            $(api.column(3).footer()).html('Rp ' + pageTotal.toLocaleString('id-ID'));

            $('.buttons-csv, .buttons-excel, .buttons-pdf, .buttons-print').on('click', function() {
                $(api.column(3).footer()).html('Rp ' + total.toLocaleString('id-ID'));
            });
        }
    });

    var tablePembayaran = $('#tablePembayaran').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("pembayaran.index") }}',
            data: function(d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },
            dataSrc: function(json) {
                $('#totalNominalPembayaran').html(json.totalNominalPembayaran);
                return json.data;
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'namasiswa', name: 'namasiswa', className: 'text-center' },
            { data: 'namapembayaran', name: 'namapembayaran', className: 'text-center' },
            { data: 'nominal', name: 'nominal' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }
        ],
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        @if (Auth::user()->role=='admin')
        dom: 'Blfrtip',
        @endif
        buttons: [

            { extend: 'excelHtml5', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } },
            { extend: 'pdfHtml5', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } },
            { extend: 'print', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } }
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            var total = api
                .column(4)
                .data()
                .reduce(function(a, b) {
                    return parseInt(a) + parseInt(b.toString().replace(/[\Rp. ,]/g, ''));
                }, 0);

            var pageTotal = api
                .column(4, { page: 'current' })
                .data()
                .reduce(function(a, b) {
                    return parseInt(a) + parseInt(b.toString().replace(/[\Rp. ,]/g, ''));
                }, 0);

            $(api.column(4).footer()).html('Rp ' + pageTotal.toLocaleString('id-ID'));

            $('.buttons-csv, .buttons-excel, .buttons-pdf, .buttons-print').on('click', function() {
                $(api.column(4).footer()).html('Rp ' + total.toLocaleString('id-ID'));
            });
        }
    });

    var tablePengeluaran = $('#tablePengeluaran').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("pengeluaran.index") }}',
            data: function(d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            },
            dataSrc: function(json) {
                $('#totalNominalPengeluaran').html(json.totalNominalPengeluaran);
                return json.data;
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'pemakaian', name: 'pemakaian', className: 'text-center' },
            { data: 'nominal', name: 'nominal' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }
        ],
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        @if (Auth::user()->role=='admin')
        dom: 'Blfrtip',
        @endif
        buttons: [

            { extend: 'excelHtml5', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } },
            { extend: 'pdfHtml5', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } },
            { extend: 'print', footer: true, exportOptions: { columns: ':not(:last-child)', modifier: { page: 'all' } } }
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            var total = api
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return parseInt(a) + parseInt(b.toString().replace(/[\Rp. ,]/g, ''));
                }, 0);

            var pageTotal = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function(a, b) {
                    return parseInt(a) + parseInt(b.toString().replace(/[\Rp. ,]/g, ''));
                }, 0);

            $(api.column(3).footer()).html('Rp ' + pageTotal.toLocaleString('id-ID'));

            $('.buttons-csv, .buttons-excel, .buttons-pdf, .buttons-print').on('click', function() {
                $(api.column(3).footer()).html('Rp ' + total.toLocaleString('id-ID'));
            });
        }
    });



    $('#filter').click(function() {
        tableInfaq.ajax.reload();
    });
    $('#filter1').click(function() {
        tablePembayaran.ajax.reload();
    });
    $('#filter2').click(function() {
        tablePengeluaran.ajax.reload();
    });


});

</script>

<script>

$(document).ready(function() {
    // Inisialisasi DataTable
    var tablePembukuan = $('#tablePembukuan').DataTable({
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        @if (Auth::user()->role=='admin')
        dom: 'Blfrtip',
        @endif
        buttons: [
            { extend: 'excelHtml5',
              footer: true,
              exportOptions: {
                modifier: {
                    page: 'all'
                }

            } },
            { extend: 'pdfHtml5', footer: true, exportOptions: {  modifier: { page: 'all' } } },
            { extend: 'print', footer: true, exportOptions: {  modifier: { page: 'all' } } }
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();

            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\.,]/g, '').replace(/[^\d\-]/g, '')*1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            var totalDebet = api.column(3, { page: 'current' }).nodes().reduce(function(a, b) {
                return a + intVal($(b).data('debet'));
            }, 0);

            var totalKredit = api.column(4, { page: 'current' }).nodes().reduce(function(a, b) {
                return a + intVal($(b).data('kredit'));
            }, 0);

            var totalSaldo = api.column(5, { page: 'current' }).nodes().reduce(function(a, b) {
                return a + intVal($(b).data('saldo'));
            }, 0);

            $('#totalDebet').html('Rp ' + totalDebet.toLocaleString('id-ID'));
            $('#totalKredit').html('Rp ' + totalKredit.toLocaleString('id-ID'));
            $('#totalSaldo').html(totalSaldo.toLocaleString('id-ID'));
        }
    });

    function filterByDate() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();

        $.fn.dataTable.ext.search.pop();

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            // Ambil tanggal dari atribut data-tanggal
            var date = $(tablePembukuan.row(dataIndex).node()).find('td[data-tanggal]').data('tanggal');

            // Pastikan date, startDate, dan endDate dalam format yyyy-mm-dd
            if (startDate && date < startDate) {
                return false;
            }
            if (endDate && date > endDate) {
                return false;
            }
            return true;
        });

        tablePembukuan.draw();
    }

    // Event listener untuk tombol filter
    $('#filterPembukuan').on('click', function() {
        filterByDate();
    });

    // Optional: Filter otomatis saat mengubah tanggal
    $('#start_date, #end_date').on('change', function() {
        filterByDate();
    });
});




</script>




<script>
    // JavaScript for Create Form
    const createFormattedNominalInput = document.getElementById('create_formatted_nominal');
    const createNominalInput = document.getElementById('create_nominal');

    createFormattedNominalInput.addEventListener('keyup', function(e) {
        let value = createFormattedNominalInput.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        createFormattedNominalInput.value = 'Rp ' + rupiah;

        // Set the value to the hidden input without formatting
        createNominalInput.value = value.replace(/\./g, '');
    });

    // JavaScript for Create Form



    // JavaScript for Edit Form
    const editFormattedNominalInput = document.getElementById('edit_formatted_nominal');
    const editNominalInput = document.getElementById('edit_nominal');

    editFormattedNominalInput.addEventListener('keyup', function(e) {
        let value = editFormattedNominalInput.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        editFormattedNominalInput.value = 'Rp ' + rupiah;

        // Set the value to the hidden input without formatting
        editNominalInput.value = value.replace(/\./g, '');
    });

</script>

<script>
     // JavaScript for Create Form
const createFormattedNominalInputPembayaran = document.getElementById('create_formatted_nominalPembayaran');
const createNominalInputPembayaran = document.getElementById('create_nominalPembayaran');

createFormattedNominalInputPembayaran.addEventListener('keyup', function(e) {
    let value = createFormattedNominalInputPembayaran.value.replace(/[^,\d]/g, '').toString();
    let split = value.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    createFormattedNominalInputPembayaran.value = 'Rp ' + rupiah;

    // Set the value to the hidden input without formatting
    createNominalInputPembayaran.value = value.replace(/\./g, '');
});


</script>
<script>
    // JavaScript for Edit Form Pembayaran
    const editFormattedNominalInputPembayaran = document.getElementById('edit_formatted_nominalPembayaran');
    const editNominalInputPembayaran = document.getElementById('edit_nominalPembayaran');

    editFormattedNominalInputPembayaran.addEventListener('keyup', function(e) {
        let value = editFormattedNominalInputPembayaran.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        editFormattedNominalInputPembayaran.value = 'Rp ' + rupiah;

        // Set the value to the hidden input without formatting
        editNominalInputPembayaran.value = value.replace(/\./g, '');
    });
</script>
<script>
     // JavaScript for Create Form
const createFormattedNominalInputPemakaian = document.getElementById('create_formatted_nominalPemakaian');
const createNominalInputPemakaian = document.getElementById('create_nominalPemakaian');

createFormattedNominalInputPemakaian.addEventListener('keyup', function(e) {
    let value = createFormattedNominalInputPemakaian.value.replace(/[^,\d]/g, '').toString();
    let split = value.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    createFormattedNominalInputPemakaian.value = 'Rp ' + rupiah;

    // Set the value to the hidden input without formatting
    createNominalInputPemakaian.value = value.replace(/\./g, '');
});


</script>
<script>
    // JavaScript for Edit Form Pembayaran
    const editFormattedNominalInputPemakaian = document.getElementById('edit_formatted_nominalPemakaian');
    const editNominalInputPemakaian = document.getElementById('edit_nominalPemakaian');

    editFormattedNominalInputPemakaian.addEventListener('keyup', function(e) {
        let value = editFormattedNominalInputPemakaian.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        editFormattedNominalInputPemakaian.value = 'Rp ' + rupiah;

        // Set the value to the hidden input without formatting
        editNominalInputPemakaian.value = value.replace(/\./g, '');
    });
</script>

<script>
   document.getElementById('guruSelect').addEventListener('change', function () {
    let guruId = this.value;

    // Cek ID guru
    console.log('Guru ID:', guruId);

    // Mengambil data nominal berdasarkan ID guru
    fetch(`/get-nominal/${guruId}`)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Cek respons dari server
            if (data.nominalpaud !== null && data.nominaltpq !== null) {
                // Isi form nominal PAUD dan TPQ dengan format Rupiah
                document.getElementById('nominalPaud').value = formatRupiah(data.nominalpaud.toString(), 'Rp. ');
                document.getElementById('nominalTPQ').value = formatRupiah(data.nominaltpq.toString(), 'Rp. ');

                // Hitung nominal sakit dan izin (50% dari nominal PAUD dan TPQ)
                document.getElementById('nominalPaudSakit').value = formatRupiah((data.nominalpaud * 0.5).toString(), 'Rp. ');
                document.getElementById('nominalPaudIzin').value = formatRupiah((data.nominalpaud * 0.5).toString(), 'Rp. ');
                document.getElementById('nominalTPQSakit').value = formatRupiah((data.nominaltpq * 0.5).toString(), 'Rp. ');
                document.getElementById('nominalTPQIzin').value = formatRupiah((data.nominaltpq * 0.5).toString(), 'Rp. ');

                // Hitung total untuk PAUD dan TPQ jika jumlah hari sudah diisi
                hitungTotalPaud();
                hitungTotalTPQ();
            } else {
                // Kosongkan nilai jika tidak ada nominal
                document.getElementById('nominalPaud').value = '';
                document.getElementById('nominalTPQ').value = '';
            }
        })
        .catch(error => console.error('Error:', error));
});

// Fungsi untuk menghitung total nominal PAUD berdasarkan hari
function hitungTotalPaud() {
    let nominalPaud = parseFloat(removeRupiahFormat(document.getElementById('nominalPaud').value)) || 0;
    let hariPaud = parseFloat(document.getElementById('hariPaud').value) || 0;
    let hariPaudSakit = parseFloat(document.getElementById('hariPaudSakit').value) || 0;
    let hariPaudIzin = parseFloat(document.getElementById('hariPaudIzin').value) || 0;

    // Perhitungan total berdasarkan hari sakit dan izin (50% dari nominal PAUD)
    let totalPaud = nominalPaud * hariPaud;
    let totalPaudSakit = (nominalPaud * 0.5) * hariPaudSakit;
    let totalPaudIzin = (nominalPaud * 0.5) * hariPaudIzin;

    // Set hasil perkalian ke dalam form dengan format Rupiah
    document.getElementById('totalPaud').value = formatRupiah(totalPaud.toString(), 'Rp. ');
    document.getElementById('totalPaudSakit').value = formatRupiah(totalPaudSakit.toString(), 'Rp. ');
    document.getElementById('totalPaudIzin').value = formatRupiah(totalPaudIzin.toString(), 'Rp. ');

    // Panggil fungsi hitung total keseluruhan
    hitungTotalKeseluruhan();
}

// Fungsi untuk menghitung total nominal TPQ berdasarkan hari
function hitungTotalTPQ() {
    let nominalTPQ = parseFloat(removeRupiahFormat(document.getElementById('nominalTPQ').value)) || 0;
    let hariTPQ = parseFloat(document.getElementById('hariTPQ').value) || 0;
    let hariTPQSakit = parseFloat(document.getElementById('hariTPQSakit').value) || 0;
    let hariTPQIzin = parseFloat(document.getElementById('hariTPQIzin').value) || 0;

    // Perhitungan total berdasarkan hari sakit dan izin (50% dari nominal TPQ)
    let totalTPQ = nominalTPQ * hariTPQ;
    let totalTPQSakit = (nominalTPQ * 0.5) * hariTPQSakit;
    let totalTPQIzin = (nominalTPQ * 0.5) * hariTPQIzin;

    // Set hasil perkalian ke dalam form dengan format Rupiah
    document.getElementById('totalTPQ').value = formatRupiah(totalTPQ.toString(), 'Rp. ');
    document.getElementById('totalTPQSakit').value = formatRupiah(totalTPQSakit.toString(), 'Rp. ');
    document.getElementById('totalTPQIzin').value = formatRupiah(totalTPQIzin.toString(), 'Rp. ');

    // Panggil fungsi hitung total keseluruhan
    hitungTotalKeseluruhan();
}

// Fungsi untuk menghitung total gaji keseluruhan
function hitungTotalKeseluruhan() {
    let totalPaud = parseFloat(removeRupiahFormat(document.getElementById('totalPaud').value)) || 0;
    let totalTPQ = parseFloat(removeRupiahFormat(document.getElementById('totalTPQ').value)) || 0;
    let totalPaudSakit = parseFloat(removeRupiahFormat(document.getElementById('totalPaudSakit').value)) || 0;
    let totalPaudIzin = parseFloat(removeRupiahFormat(document.getElementById('totalPaudIzin').value)) || 0;
    let totalTPQSakit = parseFloat(removeRupiahFormat(document.getElementById('totalTPQSakit').value)) || 0;
    let totalTPQIzin = parseFloat(removeRupiahFormat(document.getElementById('totalTPQIzin').value)) || 0;
    let intensif = parseFloat(removeRupiahFormat(document.getElementById('intensif').value)) || 0;
    let hibah = parseFloat(removeRupiahFormat(document.getElementById('hibah').value)) || 0;

    // Jumlahkan total PAUD, TPQ, sakit, izin, Intensif, dan Hibah
    let totalGaji = totalPaud + totalTPQ + totalPaudSakit + totalPaudIzin + totalTPQSakit + totalTPQIzin + intensif + hibah;

    // Set total gaji ke form dengan format Rupiah
    document.getElementById('totalGaji').value = formatRupiah(totalGaji.toString(), 'Rp. ');
}

// Tambahkan event listener untuk input jumlah hari PAUD, sakit, dan izin
document.getElementById('hariPaud').addEventListener('input', hitungTotalPaud);
document.getElementById('hariPaudSakit').addEventListener('input', hitungTotalPaud);
document.getElementById('hariPaudIzin').addEventListener('input', hitungTotalPaud);

// Tambahkan event listener untuk input jumlah hari TPQ, sakit, dan izin
document.getElementById('hariTPQ').addEventListener('input', hitungTotalTPQ);
document.getElementById('hariTPQSakit').addEventListener('input', hitungTotalTPQ);
document.getElementById('hariTPQIzin').addEventListener('input', hitungTotalTPQ);

// Event listener untuk input Intensif dan Hibah dengan format Rupiah
document.getElementById('intensif').addEventListener('input', function(e) {
    e.target.value = formatRupiah(e.target.value, 'Rp. ');
    hitungTotalKeseluruhan();
});
document.getElementById('hibah').addEventListener('input', function(e) {
    e.target.value = formatRupiah(e.target.value, 'Rp. ');
    hitungTotalKeseluruhan();
});

// Fungsi format Rupiah
function formatRupiah(angka, prefix) {
    let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
}

// Fungsi menghapus format Rupiah (untuk perhitungan)
function removeRupiahFormat(value) {
    return value.replace(/[^0-9]/g, ''); // Hapus semua karakter selain angka
}

// Hilangkan format Rupiah sebelum submit ke backend
document.getElementById('formGaji').addEventListener('submit', function() {
    document.getElementById('nominalPaud').value = removeRupiahFormat(document.getElementById('nominalPaud').value);
    document.getElementById('nominalTPQ').value = removeRupiahFormat(document.getElementById('nominalTPQ').value);
    document.getElementById('intensif').value = removeRupiahFormat(document.getElementById('intensif').value);
    document.getElementById('hibah').value = removeRupiahFormat(document.getElementById('hibah').value);
});


</script>

<script>
    document
    .getElementById("guruSelectEdit")
    .addEventListener("change", function () {
        let guruId = this.value;

        // Cek ID guru
        console.log("Guru ID:", guruId);

        // Mengambil data nominal berdasarkan ID guru
        fetch(`/get-nominal/${guruId}`)
            .then((response) => response.json())
            .then((data) => {
                console.log(data); // Cek respons dari server
                if (data.nominalpaud !== null && data.nominaltpq !== null) {
                    // Isi form nominal PAUD dan TPQ dengan format Rupiah
                    document.getElementById("nominalPaudEdit").value =
                        formatRupiah(data.nominalpaud.toString(), "Rp. ");
                    document.getElementById("nominalTPQEdit").value =
                        formatRupiah(data.nominaltpq.toString(), "Rp. ");

                    // Hitung nominal sakit dan izin (50% dari nominal PAUD dan TPQ)
                    document.getElementById("nominalPaudSakitEdit").value =
                        formatRupiah(
                            (data.nominalpaud * 0.5).toString(),
                            "Rp. "
                        );
                    document.getElementById("nominalPaudIzinEdit").value =
                        formatRupiah(
                            (data.nominalpaud * 0.5).toString(),
                            "Rp. "
                        );
                    document.getElementById("nominalTPQSakitEdit").value =
                        formatRupiah(
                            (data.nominaltpq * 0.5).toString(),
                            "Rp. "
                        );
                    document.getElementById("nominalTPQIzinEdit").value =
                        formatRupiah(
                            (data.nominaltpq * 0.5).toString(),
                            "Rp. "
                        );

                    // Hitung total untuk PAUD dan TPQ jika jumlah hari sudah diisi
                    hitungTotalPaudEdit();
                    hitungTotalTPQEdit();
                } else {
                    // Kosongkan nilai jika tidak ada nominal
                    document.getElementById("nominalPaudEdit").value = "";
                    document.getElementById("nominalTPQEdit").value = "";
                }
            })
            .catch((error) => console.error("Error:", error));
    });

// Fungsi untuk menghitung total nominal PAUD berdasarkan hari
function hitungTotalPaudEdit() {
    let nominalPaud =
        parseFloat(
            removeRupiahFormat(document.getElementById("nominalPaudEdit").value)
        ) || 0;
    let hariPaud =
        parseFloat(document.getElementById("hariPaudEdit").value) || 0;
    let hariPaudSakit =
        parseFloat(document.getElementById("hariPaudSakitEdit").value) || 0;
    let hariPaudIzin =
        parseFloat(document.getElementById("hariPaudIzinEdit").value) || 0;

    // Perhitungan total berdasarkan hari sakit dan izin (50% dari nominal PAUD)
    let totalPaud = nominalPaud * hariPaud;
    let totalPaudSakit = nominalPaud * 0.5 * hariPaudSakit;
    let totalPaudIzin = nominalPaud * 0.5 * hariPaudIzin;

    // Set hasil perkalian ke dalam form dengan format Rupiah
    document.getElementById("totalPaudEdit").value = formatRupiah(
        totalPaud.toString(),
        "Rp. "
    );
    document.getElementById("totalPaudSakitEdit").value = formatRupiah(
        totalPaudSakit.toString(),
        "Rp. "
    );
    document.getElementById("totalPaudIzinEdit").value = formatRupiah(
        totalPaudIzin.toString(),
        "Rp. "
    );

    // Panggil fungsi hitung total keseluruhan
    hitungTotalKeseluruhanEdit();
}

// Fungsi untuk menghitung total nominal TPQ berdasarkan hari
function hitungTotalTPQEdit() {
    let nominalTPQ =
        parseFloat(
            removeRupiahFormat(document.getElementById("nominalTPQEdit").value)
        ) || 0;
    let hariTPQ = parseFloat(document.getElementById("hariTPQEdit").value) || 0;
    let hariTPQSakit =
        parseFloat(document.getElementById("hariTPQSakitEdit").value) || 0;
    let hariTPQIzin =
        parseFloat(document.getElementById("hariTPQIzinEdit").value) || 0;

    // Perhitungan total berdasarkan hari sakit dan izin (50% dari nominal TPQ)
    let totalTPQ = nominalTPQ * hariTPQ;
    let totalTPQSakit = nominalTPQ * 0.5 * hariTPQSakit;
    let totalTPQIzin = nominalTPQ * 0.5 * hariTPQIzin;

    // Set hasil perkalian ke dalam form dengan format Rupiah
    document.getElementById("totalTPQEdit").value = formatRupiah(
        totalTPQ.toString(),
        "Rp. "
    );
    document.getElementById("totalTPQSakitEdit").value = formatRupiah(
        totalTPQSakit.toString(),
        "Rp. "
    );
    document.getElementById("totalTPQIzinEdit").value = formatRupiah(
        totalTPQIzin.toString(),
        "Rp. "
    );

    // Panggil fungsi hitung total keseluruhan
    hitungTotalKeseluruhanEdit();
}

// Fungsi untuk menghitung total gaji keseluruhan
function hitungTotalKeseluruhanEdit() {
    let totalPaud =
        parseFloat(
            removeRupiahFormat(document.getElementById("totalPaudEdit").value)
        ) || 0;
    let totalTPQ =
        parseFloat(
            removeRupiahFormat(document.getElementById("totalTPQEdit").value)
        ) || 0;
    let totalPaudSakit =
        parseFloat(
            removeRupiahFormat(
                document.getElementById("totalPaudSakitEdit").value
            )
        ) || 0;
    let totalPaudIzin =
        parseFloat(
            removeRupiahFormat(
                document.getElementById("totalPaudIzinEdit").value
            )
        ) || 0;
    let totalTPQSakit =
        parseFloat(
            removeRupiahFormat(
                document.getElementById("totalTPQSakitEdit").value
            )
        ) || 0;
    let totalTPQIzin =
        parseFloat(
            removeRupiahFormat(
                document.getElementById("totalTPQIzinEdit").value
            )
        ) || 0;
    let intensif =
        parseFloat(
            removeRupiahFormat(document.getElementById("intensifEdit").value)
        ) || 0;
    let hibah =
        parseFloat(
            removeRupiahFormat(document.getElementById("hibahEdit").value)
        ) || 0;

    // Jumlahkan total PAUD, TPQ, sakit, izin, Intensif, dan Hibah
    let totalGaji =
        totalPaud +
        totalTPQ +
        totalPaudSakit +
        totalPaudIzin +
        totalTPQSakit +
        totalTPQIzin +
        intensif +
        hibah;

    // Set total gaji ke form dengan format Rupiah
    document.getElementById("totalGajiEdit").value = formatRupiah(
        totalGaji.toString(),
        "Rp. "
    );
}

// Tambahkan event listener untuk input jumlah hari PAUD, sakit, dan izin
document.getElementById("hariPaudEdit").addEventListener("input", hitungTotalPaudEdit);
document.getElementById("hariPaudSakitEdit").addEventListener("input", hitungTotalPaudEdit);
document.getElementById("hariPaudIzinEdit").addEventListener("input", hitungTotalPaudEdit);

// Tambahkan event listener untuk input jumlah hari TPQ, sakit, dan izin
document.getElementById("hariTPQEdit").addEventListener("input", hitungTotalTPQEdit);
document.getElementById("hariTPQSakitEdit").addEventListener("input", hitungTotalTPQEdit);
document.getElementById("hariTPQIzinEdit").addEventListener("input", hitungTotalTPQEdit);

// Event listener untuk input Intensif dan Hibah dengan format Rupiah
document.getElementById("intensifEdit").addEventListener("input", function (e) {
    e.target.value = formatRupiah(e.target.value, "Rp. ");
    hitungTotalKeseluruhanEdit();
});
document.getElementById("hibahEdit").addEventListener("input", function (e) {
    e.target.value = formatRupiah(e.target.value, "Rp. ");
    hitungTotalKeseluruhanEdit();
});

// Fungsi format Rupiah
function formatRupiah(angka, prefix) {
    let number_string = angka.replace(/[^,\d]/g, "Edit").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
    return prefix === undefined ? rupiah : rupiah ? prefix + rupiah : "";
}

// Fungsi menghapus format Rupiah (untuk perhitungan)
function removeRupiahFormat(value) {
    return value.replace(/[^0-9]/g, ""); // Hapus semua karakter selain angka
}

// Hilangkan format Rupiah sebelum submit ke backend
document.getElementById("formGajiEdit").addEventListener("submit", function () {
    document.getElementById("nominalPaudEdit").value = removeRupiahFormat(
        document.getElementById("nominalPaudEdit").value
    );
    document.getElementById("nominalTPQEdit").value = removeRupiahFormat(
        document.getElementById("nominalTPQEdit").value
    );
    document.getElementById("intensifEdit").value = removeRupiahFormat(
        document.getElementById("intensifEdit").value
    );
    document.getElementById("hibahEdit").value = removeRupiahFormat(
        document.getElementById("hibahEdit").value
    );
});

</script>
<script>
    function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }

    // Fungsi menghapus format Rupiah (untuk perhitungan)
    function removeRupiahFormat(value) {
        return value.replace(/[^0-9]/g, ""); // Hapus semua karakter selain angka
    }

    // Event listener saat modal ditampilkan
    document.querySelectorAll('.modal').forEach(function(modalElement) {
        modalElement.addEventListener('shown.bs.modal', function(event) {
            // Ambil modal yang sedang dibuka
            let modal = event.target;

            // Cari input dengan nama 'nominalpaud' dan 'nominaltpq' di dalam modal yang dibuka
            let nominalpaudInput = modal.querySelector('input[name="nominalpaud"]');
            let nominalpaudInputSakit = modal.querySelector('input[name="nominalpaudsakit"]');
            let nominalpaudInputIzin = modal.querySelector('input[name="nominalpaudizin"]');
            let nominaltpqInputSakit = modal.querySelector('input[name="nominaltpqsakit"]');
            let nominaltpqInputIzin = modal.querySelector('input[name="nominaltpqizin"]');
            let nominaltpqInput = modal.querySelector('input[name="nominaltpq"]');
            let totalPaud = modal.querySelector('input[name="totalpaud"]');
            let totalPaudsakit = modal.querySelector('input[name="totalpaudsakit"]');
            let totalPaudizin = modal.querySelector('input[name="totalpaudizin"]');
            let totalTpq = modal.querySelector('input[name="totaltpq"]');
            let totalTpqsakit = modal.querySelector('input[name="totaltpqsakit"]');
            let totalTpqizin = modal.querySelector('input[name="totaltpqizin"]');
            let intensif = modal.querySelector('input[name="intensif"]');
            let hibah = modal.querySelector('input[name="hibah"]');
            let totalgaji = modal.querySelector('input[name="totalgaji"]');

            // Format nilai saat modal dibuka
            if (nominalpaudInput) {
                nominalpaudInput.value = formatRupiah(nominalpaudInput.value, "Rp. ");
            }
            if (nominalpaudInputSakit) {
                nominalpaudInputSakit.value = formatRupiah(nominalpaudInputSakit.value, "Rp. ");
            }
            if (nominalpaudInputIzin) {
                nominalpaudInputIzin.value = formatRupiah(nominalpaudInputIzin.value, "Rp. ");
            }
            if (nominaltpqInputSakit) {
                nominaltpqInputSakit.value = formatRupiah(nominaltpqInputSakit.value, "Rp. ");
            }
            if (nominaltpqInputIzin) {
                nominaltpqInputIzin.value = formatRupiah(nominaltpqInputIzin.value, "Rp. ");
            }
            if (nominaltpqInput) {
                nominaltpqInput.value = formatRupiah(nominaltpqInput.value, "Rp. ");
            }
            if (totalPaud) {
                totalPaud.value = formatRupiah(totalPaud.value, "Rp. ");
            }
            if (totalPaudsakit) {
                totalPaudsakit.value = formatRupiah(totalPaudsakit.value, "Rp. ");
            }
            if (totalPaudizin) {
                totalPaudizin.value = formatRupiah(totalPaudizin.value, "Rp. ");
            }
            if (totalTpq) {
                totalTpq.value = formatRupiah(totalTpq.value, "Rp. ");
            }
            if (totalTpqsakit) {
                totalTpqsakit.value = formatRupiah(totalTpqsakit.value, "Rp. ");
            }
            if (totalTpqizin) {
                totalTpqizin.value = formatRupiah(totalTpqizin.value, "Rp. ");
            }
            if (intensif) {
                intensif.value = formatRupiah(intensif.value, "Rp. ");
            }
            if (hibah) {
                hibah.value = formatRupiah(hibah.value, "Rp. ");
            }
            if (totalgaji) {
                totalgaji.value = formatRupiah(totalgaji.value, "Rp. ");
            }

            // Tambahkan event listener untuk mengupdate format saat ada perubahan
            nominalpaudInput?.addEventListener("input", function (e) {
                let value = e.target.value;
                e.target.value = formatRupiah(value, "Rp. ");
            });

            nominaltpqInput?.addEventListener("input", function (e) {
                let value = e.target.value;
                e.target.value = formatRupiah(value, "Rp. ");
            });
        });
    });

    // Event listener untuk menghilangkan format rupiah sebelum form dikirim
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            // Hilangkan format Rupiah sebelum dikirim ke backend
            form.querySelectorAll('input[name="nominalpaud"]').forEach(function(element) {
                element.value = removeRupiahFormat(element.value);
            });
            form.querySelectorAll('input[name="nominaltpq"]').forEach(function(element) {
                element.value = removeRupiahFormat(element.value);
            });
        });
    });
</script>

<script>
    document.getElementById('filterBulan').addEventListener('click', function() {
        let selectedDate = document.getElementById('start_date').value;

        if (selectedDate) {
            let selectedMonth = new Date(selectedDate).getMonth() + 1; // Ambil bulan dari selectedDate
            let selectedYear = new Date(selectedDate).getFullYear(); // Ambil tahun dari selectedDate

            // Konversi bulan Inggris ke Indonesia
            let monthNamesIndo = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                'September', 'Oktober', 'November', 'Desember'
            ];

            let selectedMonthNameIndo = monthNamesIndo[selectedMonth - 1]; // Ambil nama bulan dalam Bahasa Indonesia

            let rows = document.querySelectorAll('#tablePenggajian tbody tr'); // Ambil semua baris tabel

            rows.forEach(function(row) {
                let dateCell = row.cells[1].innerText; // Ambil kolom tanggal yang berformat F Y (misal: Agustus 2023)

                let rowMonthName = dateCell.split(' ')[0]; // Ambil nama bulan dari cell tanggal (contoh: "Agustus")
                let rowYear = dateCell.split(' ')[1]; // Ambil tahun dari cell tanggal

                // Bandingkan bulan dan tahun, lalu sembunyikan/tampilkan baris
                if (rowMonthName === selectedMonthNameIndo && rowYear == selectedYear) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        } else {
            alert('Pilih bulan terlebih dahulu!');
        }
    });
</script>

<!-- Tambahkan logika Fetch API untuk download -->
<script>
    document.getElementById('downloadWord').addEventListener('click', function(event) {

    // Ambil nilai bulan dari input form
    const month = document.getElementById('start_date').value;

    if (!month) {
        event.preventDefault();  // Mencegah submit form

        alert('Pilih bulan terlebih dahulu!');
        return;
    }

    // Ambil konten halaman print dengan parameter bulan
    fetch(`/print?month=${month}`)  // Kirim permintaan ke URL print dengan parameter bulan

        .then(response => {
            if (!response.ok) {
                event.preventDefault();
                throw new Error('Data tidak ditemukan');
            }
            return response.text();  // Ambil konten sebagai teks
        })
        .catch(error => {
            alert(error.message);
            console.error('Error:', error);
        });
});

</script>


</body>

</html>
