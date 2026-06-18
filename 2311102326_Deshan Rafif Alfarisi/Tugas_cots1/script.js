/**
 * MotoRent Management System — script.js
 * CRUD sederhana dengan penyimpanan berbasis mapping object (Map)
 * Menggunakan jQuery + Bootstrap 5 + DataTables 1.13
 */

'use strict';

/* ====================================================
   1. STORAGE — Map<id, motorObject>
   ==================================================== */
const motorStorage = new Map();
let nextId = 1;
let deleteTargetId = null;
let dataTable = null;

/* Data awal (seed) pesewaan motor */
const seedData = [
  { namaProduk: 'Honda Beat 2023',    kategori: 'Matic',   harga: 75000,  stok: 4, status: 'Tersedia',  keterangan: 'Warna putih, kondisi prima' },
  { namaProduk: 'Yamaha NMAX 2022',   kategori: 'Matic',   harga: 130000, stok: 2, status: 'Disewa',    keterangan: 'Full-fairing, abs system' },
  { namaProduk: 'Honda Scoopy 2023',  kategori: 'Matic',   harga: 80000,  stok: 3, status: 'Tersedia',  keterangan: 'Retro style, warna cream' },
  { namaProduk: 'Yamaha RX-King',     kategori: 'Manual',  harga: 60000,  stok: 1, status: 'Perawatan', keterangan: 'Klasik, perlu servis rutin' },
  { namaProduk: 'Honda CB150R 2022',  kategori: 'Sport',   harga: 150000, stok: 2, status: 'Tersedia',  keterangan: 'Sporty, warna hitam merah' },
  { namaProduk: 'Kawasaki KLX 150',   kategori: 'Trail',   harga: 120000, stok: 1, status: 'Tersedia',  keterangan: 'Trail adventure, cocok offroad' },
  { namaProduk: 'Honda Revo 110',     kategori: 'Manual',  harga: 55000,  stok: 5, status: 'Tersedia',  keterangan: 'Irit bahan bakar, bebek standar' },
  { namaProduk: 'Yamaha XSR 155',     kategori: 'Cruiser', harga: 175000, stok: 1, status: 'Disewa',    keterangan: 'Neo-retro, warna hitam silver' },
];

/* ====================================================
   2. CRUD OPERATIONS
   ==================================================== */

/**
 * Tambah motor baru ke storage
 * @param {Object} data - data motor dari form
 * @returns {number} id baru yang dibuat
 */
function createMotor(data) {
  const id = nextId++;
  motorStorage.set(id, {
    id,
    namaProduk: data.namaProduk,
    kategori:   data.kategori,
    harga:      Number(data.harga),
    stok:       Number(data.stok),
    status:     data.status,
    keterangan: data.keterangan || '-',
    createdAt:  new Date().toLocaleString('id-ID'),
  });
  return id;
}

/**
 * Ambil satu data motor berdasarkan id
 * @param {number} id
 * @returns {Object|undefined}
 */
function readMotor(id) {
  return motorStorage.get(id);
}

/**
 * Update data motor
 * @param {number} id
 * @param {Object} data - field yang diperbarui
 */
function updateMotor(id, data) {
  if (!motorStorage.has(id)) return false;
  const existing = motorStorage.get(id);
  motorStorage.set(id, {
    ...existing,
    namaProduk: data.namaProduk,
    kategori:   data.kategori,
    harga:      Number(data.harga),
    stok:       Number(data.stok),
    status:     data.status,
    keterangan: data.keterangan || '-',
    updatedAt:  new Date().toLocaleString('id-ID'),
  });
  return true;
}

/**
 * Hapus motor dari storage
 * @param {number} id
 */
function deleteMotor(id) {
  return motorStorage.delete(id);
}

/**
 * Ambil semua data motor sebagai array
 * @returns {Array}
 */
function getAllMotors() {
  return Array.from(motorStorage.values());
}

/* ====================================================
   3. DATATABLE HELPERS
   ==================================================== */

/** Kembalikan class badge berdasarkan kategori */
function getKategoriBadge(kategori) {
  const map = {
    'Matic':   'badge-matic',
    'Manual':  'badge-manual',
    'Sport':   'badge-sport',
    'Trail':   'badge-trail',
    'Cruiser': 'badge-cruiser',
  };
  return map[kategori] || 'badge-secondary';
}

/** Kembalikan class badge berdasarkan status */
function getStatusBadge(status) {
  const map = {
    'Tersedia':  'status-tersedia',
    'Disewa':    'status-disewa',
    'Perawatan': 'status-perawatan',
  };
  return map[status] || '';
}

/** Format angka ke Rupiah */
function formatRupiah(angka) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency', currency: 'IDR', minimumFractionDigits: 0
  }).format(angka);
}

/** Render satu baris <tr> untuk DataTable */
function buildRow(motor, rowNum) {
  const katBadge  = getKategoriBadge(motor.kategori);
  const statBadge = getStatusBadge(motor.status);
  const hargaFmt  = formatRupiah(motor.harga);

  return `
    <tr data-id="${motor.id}">
      <td class="no-cell">${rowNum}</td>
      <td class="fw-semibold" style="color:#f1f5f9">${escapeHtml(motor.namaProduk)}</td>
      <td><span class="badge-kategori ${katBadge}">${escapeHtml(motor.kategori)}</span></td>
      <td class="harga-cell">${hargaFmt}<span class="text-muted fw-normal" style="font-size:.72rem">/hari</span></td>
      <td class="text-center">${motor.stok} unit</td>
      <td><span class="badge-status ${statBadge}">${escapeHtml(motor.status)}</span></td>
      <td style="max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"
          title="${escapeHtml(motor.keterangan)}">${escapeHtml(motor.keterangan)}</td>
      <td class="text-center">
        <div class="d-flex justify-content-center gap-1">
          <button class="btn-aksi btn-detail" title="Lihat Detail" onclick="showDetail(${motor.id})">
            <i class="bi bi-eye-fill"></i>
          </button>
          <button class="btn-aksi btn-edit" title="Edit Data" onclick="startEdit(${motor.id})">
            <i class="bi bi-pencil-fill"></i>
          </button>
          <button class="btn-aksi btn-hapus" title="Hapus Data" onclick="confirmDelete(${motor.id})">
            <i class="bi bi-trash-fill"></i>
          </button>
        </div>
      </td>
    </tr>`;
}

/** Simple HTML escaping untuk keamanan */
function escapeHtml(str) {
  if (typeof str !== 'string') return str;
  return str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

/* ====================================================
   4. INISIALISASI DATATABLE
   ==================================================== */
function initDataTable() {
  dataTable = $('#motorTable').DataTable({
    language: {
      emptyTable:   'Belum ada data motor',
      zeroRecords:  'Data tidak ditemukan',
      info:         'Menampilkan _START_ - _END_ dari _TOTAL_ data',
      infoEmpty:    'Tidak ada data',
      infoFiltered: '(difilter dari _MAX_ total data)',
      search:       'Cari:',
      lengthMenu:   'Tampilkan _MENU_ data',
      paginate: {
        first:    'Pertama',
        last:     'Terakhir',
        next:     'Berikutnya',
        previous: 'Sebelumnya',
      },
    },
    pageLength: 5,
    lengthMenu: [5, 10, 25, 50],
    order: [],
    columnDefs: [
      { orderable: false,  targets: [7] },
      { searchable: false, targets: [0, 7] },
    ],
    drawCallback: function () {
      // Re-number baris sesuai halaman aktif
      let start = this.api().page.info().start;
      this.api().rows({ page: 'current' }).nodes().each(function (row, i) {
        $('td:first', row).text(start + i + 1);
      });
    },
  });
}

/* ====================================================
   5. RENDER / REFRESH TABEL
   ==================================================== */
function renderTable() {
  if (!dataTable) return;

  dataTable.clear();

  getAllMotors().forEach(function (motor, idx) {
    dataTable.row.add($(buildRow(motor, idx + 1)));
  });

  dataTable.draw();
  updateStats();
}

/* ====================================================
   6. STATISTIK HEADER
   ==================================================== */
function updateStats() {
  const all      = getAllMotors();
  const total    = all.length;
  const tersedia = all.filter(function(m){ return m.status === 'Tersedia'; })
                      .reduce(function(s, m){ return s + m.stok; }, 0);
  const disewa   = all.filter(function(m){ return m.status === 'Disewa'; }).length;

  $('#statTotal').text(total);
  $('#statAvailable').text(tersedia);
  $('#statRented').text(disewa);
  $('#totalCount').text(total);
}

/* ====================================================
   7. FORM — TAMBAH / SIMPAN
   ==================================================== */
$('#motorForm').on('submit', function (e) {
  e.preventDefault();

  // Validasi HTML5
  if (!this.checkValidity()) {
    this.classList.add('was-validated');
    return;
  }

  var data = {
    namaProduk: $.trim($('#namaProduk').val()),
    kategori:   $('#kategori').val(),
    harga:      $('#harga').val(),
    stok:       $('#stok').val(),
    status:     $('#status').val(),
    keterangan: $.trim($('#keterangan').val()),
  };

  var editId = $('#editId').val();

  if (editId) {
    // Mode Edit — perbarui data yang sudah ada
    var ok = updateMotor(Number(editId), data);
    if (ok) {
      showAlert('success',
        '<i class="bi bi-check-circle-fill me-2"></i>Data <strong>' +
        escapeHtml(data.namaProduk) + '</strong> berhasil diperbarui.');
    }
    cancelEdit();
  } else {
    // Mode Tambah — buat data baru
    createMotor(data);
    showAlert('success',
      '<i class="bi bi-plus-circle-fill me-2"></i>Data <strong>' +
      escapeHtml(data.namaProduk) + '</strong> berhasil ditambahkan.');
  }

  renderTable();
  resetForm();
});

/* ====================================================
   8. RESET FORM
   ==================================================== */
function resetForm() {
  $('#motorForm')[0].reset();
  $('#motorForm').removeClass('was-validated');
  $('#editId').val('');
  $('#kategori').val('');
  $('#status').val('Tersedia');
}

/* ====================================================
   9. EDIT — isi form dengan data terpilih
   ==================================================== */
function startEdit(id) {
  var motor = readMotor(id);
  if (!motor) return;

  // Isi form dengan data motor
  $('#editId').val(motor.id);
  $('#namaProduk').val(motor.namaProduk);
  $('#kategori').val(motor.kategori);
  $('#harga').val(motor.harga);
  $('#stok').val(motor.stok);
  $('#status').val(motor.status);
  $('#keterangan').val(motor.keterangan === '-' ? '' : motor.keterangan);

  // Ubah tampilan form ke mode Edit
  $('#formCard').addClass('edit-mode');
  $('#formTitle').text('Edit Data Motor');
  $('#btnSubmit').removeClass('btn-primary').addClass('btn-warning');
  $('#btnIcon').attr('class', 'bi bi-pencil-square me-2');
  $('#btnText').text('Simpan Perubahan');
  $('#btnCancelEdit').show();

  // Scroll ke form
  $('html, body').animate({ scrollTop: $('#formCard').offset().top - 90 }, 400);
}

function cancelEdit() {
  resetForm();
  $('#formCard').removeClass('edit-mode');
  $('#formTitle').text('Tambah Data Motor');
  $('#btnSubmit').removeClass('btn-warning').addClass('btn-primary');
  $('#btnIcon').attr('class', 'bi bi-plus-circle me-2');
  $('#btnText').text('Tambah Data');
  $('#btnCancelEdit').hide();
}

/* ====================================================
   10. HAPUS — konfirmasi modal, lalu hapus
   ==================================================== */
function confirmDelete(id) {
  var motor = readMotor(id);
  if (!motor) return;

  deleteTargetId = id;
  $('#deleteModalName').text(motor.namaProduk);

  var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
  modal.show();
}

$('#btnConfirmDelete').on('click', function () {
  if (deleteTargetId === null) return;

  var motor = readMotor(deleteTargetId);
  var nama  = motor ? motor.namaProduk : '';

  deleteMotor(deleteTargetId);
  deleteTargetId = null;

  bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();

  renderTable();
  showAlert('danger',
    '<i class="bi bi-trash-fill me-2"></i>Data <strong>' +
    escapeHtml(nama) + '</strong> telah dihapus.');
});

/* ====================================================
   11. DETAIL MODAL
   ==================================================== */
function showDetail(id) {
  var m = readMotor(id);
  if (!m) return;

  var statBadge = getStatusBadge(m.status);
  var katBadge  = getKategoriBadge(m.kategori);

  var updatedRow = m.updatedAt
    ? '<div class="detail-row">' +
        '<span class="detail-label">Diperbarui</span>' +
        '<span class="detail-value" style="font-size:.82rem;color:#64748b">' + m.updatedAt + '</span>' +
      '</div>'
    : '';

  var html =
    '<div class="px-1">' +
      '<div class="detail-row">' +
        '<span class="detail-label">Nama Produk</span>' +
        '<span class="detail-value fw-bold" style="color:#a5b4fc">' + escapeHtml(m.namaProduk) + '</span>' +
      '</div>' +
      '<div class="detail-row">' +
        '<span class="detail-label">Kategori</span>' +
        '<span class="detail-value"><span class="badge-kategori ' + katBadge + '">' + escapeHtml(m.kategori) + '</span></span>' +
      '</div>' +
      '<div class="detail-row">' +
        '<span class="detail-label">Harga Sewa</span>' +
        '<span class="detail-value harga-cell">' + formatRupiah(m.harga) +
          ' <span class="text-muted fw-normal" style="font-size:.78rem">/ hari</span></span>' +
      '</div>' +
      '<div class="detail-row">' +
        '<span class="detail-label">Stok Unit</span>' +
        '<span class="detail-value">' + m.stok + ' unit</span>' +
      '</div>' +
      '<div class="detail-row">' +
        '<span class="detail-label">Status</span>' +
        '<span class="detail-value"><span class="badge-status ' + statBadge + '">' + escapeHtml(m.status) + '</span></span>' +
      '</div>' +
      '<div class="detail-row">' +
        '<span class="detail-label">Keterangan</span>' +
        '<span class="detail-value" style="color:#94a3b8">' + escapeHtml(m.keterangan) + '</span>' +
      '</div>' +
      '<div class="detail-row">' +
        '<span class="detail-label">Ditambahkan</span>' +
        '<span class="detail-value" style="font-size:.82rem;color:#64748b">' + (m.createdAt || '-') + '</span>' +
      '</div>' +
      updatedRow +
    '</div>';

  $('#detailModalBody').html(html);
  new bootstrap.Modal(document.getElementById('detailModal')).show();
}

/* ====================================================
   12. ALERT HELPER
   ==================================================== */
function showAlert(type, message) {
  var alertId = 'alert-' + Date.now();
  var alertHtml =
    '<div id="' + alertId + '" class="alert alert-' + type +
    ' alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">' +
      '<div>' + message + '</div>' +
      '<button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" ' +
        'aria-label="Close" style="filter:brightness(1.5)"></button>' +
    '</div>';

  $('#alertContainer').prepend(alertHtml);

  setTimeout(function () {
    $('#' + alertId).alert('close');
  }, 4000);
}

/* ====================================================
   13. NAVBAR SCROLL EFFECT
   ==================================================== */
$(window).on('scroll', function () {
  if ($(this).scrollTop() > 50) {
    $('#mainNavbar').css('background', 'rgba(15,23,42,0.97)');
  } else {
    $('#mainNavbar').css('background', 'rgba(15,23,42,0.85)');
  }
});

/* ====================================================
   14. INISIALISASI APLIKASI
   ==================================================== */
$(document).ready(function () {
  // 1. Inisialisasi DataTable
  initDataTable();

  // 2. Isi seed data awal
  seedData.forEach(function (d) { createMotor(d); });

  // 3. Render tabel pertama kali
  renderTable();

  // 4. Set default select status
  $('#status').val('Tersedia');
});
