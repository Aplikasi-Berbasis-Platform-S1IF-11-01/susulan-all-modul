const API_URL = '/api/products';

// Format Rupiah
const rp = n => new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
}).format(n);

let dt, toastEl;

const showToast = (m) => {
    $('#toastMsg').text(m);
    toastEl.show();
};

$(document).ready(function () {

    // Init Toast
    toastEl = new bootstrap.Toast($('#toast')[0], { autohide: true, delay: 2500 });

    // Init DataTable (hanya berjalan di halaman /produk)
    if ($('#tabel').length) {
        dt = $('#tabel').DataTable({
            processing: true,
            ajax: { url: API_URL, dataSrc: 'data' },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 },
                { data: 'nama' },
                { data: 'kategori' },
                { data: 'harga', render: data => rp(data) },
                {
                    data: 'id',
                    render: id => `
                        <button class="btn btn-sm btn-outline-primary btn-edit" data-id="${id}">Edit</button>
                        <button class="btn btn-sm btn-outline-danger btn-del" data-id="${id}">Hapus</button>`
                }
            ],
            ordering: false,
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_',
                info: '_START_–_END_ dari _TOTAL_',
                infoEmpty: 'Tidak ada data',
                zeroRecords: 'Data tidak ditemukan',
                paginate: { next: '›', previous: '‹' }
            },
            pageLength: 5
        });
    }

    // Validasi Form Tambah (jQuery Validation Plugin)
    $('#form').validate({
        rules: {
            nama: { required: true, minlength: 2 },
            kategori: { required: true },
            harga: { required: true, min: 1, digits: true }
        },
        messages: {
            nama: { required: 'Nama produk wajib diisi', minlength: 'Minimal 2 karakter' },
            kategori: { required: 'Pilih kategori terlebih dahulu' },
            harga: { required: 'Harga wajib diisi', min: 'Harga harus lebih dari 0', digits: 'Hanya boleh angka' }
        },
        errorClass: 'text-danger',
        errorElement: 'small',
        highlight: el => $(el).addClass('is-invalid').removeClass('is-valid'),
        unhighlight: el => $(el).removeClass('is-invalid').addClass('is-valid'),
        submitHandler: async function (form) {
            const payload = {
                nama: $('#nama').val().trim(),
                kategori: $('#kategori').val(),
                harga: $('#harga').val()
            };
            try {
                const res = await fetch(API_URL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                if (!res.ok) throw new Error('Server error');
                showToast('Produk berhasil ditambahkan');
                form.reset();
                $('#form input, #form select').removeClass('is-valid is-invalid');
                if (dt) dt.ajax.reload();
            } catch (err) {
                showToast('Gagal menambahkan produk — pastikan server berjalan');
            }
        }
    });

    // Handle Hapus
    $(document).on('click', '.btn-del', async function () {
        const id = $(this).data('id');
        if (confirm('Yakin hapus produk ini?')) {
            try {
                await fetch(`${API_URL}/${id}`, { method: 'DELETE' });
                dt.ajax.reload();
                showToast('Produk dihapus');
            } catch (err) {
                showToast('Gagal menghapus produk');
            }
        }
    });

    // Handle Edit: Buka Modal dan isi data
    $(document).on('click', '.btn-edit', function () {
        const rowData = dt.row($(this).parents('tr')).data();
        $('#editId').val(rowData.id);
        $('#editNama').val(rowData.nama);
        $('#editKategori').val(rowData.kategori);
        $('#editHarga').val(rowData.harga);
        new bootstrap.Modal($('#modalEdit')[0]).show();
    });

    // Validasi Form Edit
    if ($('#formEdit').length) {
        $('#formEdit').validate({
            rules: {
                editNama: { required: true, minlength: 2 },
                editKategori: { required: true },
                editHarga: { required: true, min: 1, digits: true }
            },
            messages: {
                editNama: { required: 'Nama produk wajib diisi', minlength: 'Minimal 2 karakter' },
                editKategori: { required: 'Pilih kategori terlebih dahulu' },
                editHarga: { required: 'Harga wajib diisi', min: 'Harga harus lebih dari 0', digits: 'Hanya boleh angka' }
            },
            errorClass: 'text-danger',
            errorElement: 'small',
            highlight: el => $(el).addClass('is-invalid').removeClass('is-valid'),
            unhighlight: el => $(el).removeClass('is-invalid').addClass('is-valid')
        });
    }

    // Handle Update
    $('#btnUpdate').click(async function () {
        if (!$('#formEdit').valid()) return;
        const id = $('#editId').val();
        const data = {
            nama: $('#editNama').val(),
            kategori: $('#editKategori').val(),
            harga: $('#editHarga').val()
        };
        try {
            await fetch(`${API_URL}/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            bootstrap.Modal.getInstance($('#modalEdit')[0]).hide();
            dt.ajax.reload();
            showToast('Produk diperbarui');
        } catch (err) {
            showToast('Gagal memperbarui produk');
        }
    });

    // Reset validasi saat modal ditutup
    $('#modalEdit').on('hidden.bs.modal', function () {
        $('#formEdit input, #formEdit select').removeClass('is-valid is-invalid');
        $('#formEdit small.text-danger').remove();
    });

    // Statistik di Halaman Home
    if ($('#bodyHome').length) {
        $.getJSON(API_URL, function (res) {
            const products = res.data;
            const total = products.length;
            const kategori = [...new Set(products.map(p => p.kategori))].length;
            const nilai = products.reduce((sum, p) => sum + p.harga, 0);

            $('#statTotal').text(total);
            $('#statKategori').text(kategori);
            $('#statNilai').text(rp(nilai));

            const recent = products.slice(-5).reverse();
            recent.forEach((p, i) => {
                $('#bodyHome').append(`
                    <tr>
                        <td>${i + 1}</td>
                        <td>${p.nama}</td>
                        <td>${p.kategori}</td>
                        <td>${rp(p.harga)}</td>
                    </tr>
                `);
            });

            if (total === 0) {
                $('#bodyHome').append(`<tr><td colspan="4" class="text-center text-muted py-3">Belum ada produk</td></tr>`);
            }
        });
    }

});
