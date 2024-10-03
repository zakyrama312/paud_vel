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
document
    .getElementById("hariPaudEdit")
    .addEventListener("input", hitungTotalPaudEdit);
document
    .getElementById("hariPaudSakit")
    .addEventListener("input", hitungTotalPaudEdit);
document
    .getElementById("hariPaudIzin")
    .addEventListener("input", hitungTotalPaudEdit);

// Tambahkan event listener untuk input jumlah hari TPQ, sakit, dan izin
document
    .getElementById("hariTPQEdit")
    .addEventListener("input", hitungTotalTPQEdit);
document
    .getElementById("hariTPQSakit")
    .addEventListener("input", hitungTotalTPQEdit);
document
    .getElementById("hariTPQIzin")
    .addEventListener("input", hitungTotalTPQEdit);

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
