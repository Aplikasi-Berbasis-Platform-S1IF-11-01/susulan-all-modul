$(document).ready(function () {
  
  // ==================== DATATABLE INITIALIZATION ====================
  let table = null;
  if ($('#inventoryTable').length > 0) {
    table = $('#inventoryTable').DataTable({
      ajax: '/api/inventory',
      responsive: true,
      columns: [
        { 
          data: 'name',
          render: function (data, type, row) {
            return `<strong>${data}</strong>`;
          }
        },
        { data: 'category' },
        { 
          data: 'quantity',
          className: 'text-center'
        },
        { 
          data: 'condition',
          className: 'text-center',
          render: function (data) {
            if (data === 'Baik') {
              return `<span class="badge-good"><i class="fa-solid fa-circle-check me-1"></i>Baik</span>`;
            } else {
              return `<span class="badge-bad"><i class="fa-solid fa-circle-xmark me-1"></i>Rusak</span>`;
            }
          }
        },
        { data: 'location' },
        { 
          data: 'createdAt',
          render: function (data) {
            if (!data) return '-';
            const date = new Date(data);
            return date.toLocaleDateString('id-ID', {
              day: 'numeric',
              month: 'long',
              year: 'numeric',
              hour: '2-digit',
              minute: '2-digit'
            });
          }
        },
        {
          data: null,
          orderable: false,
          searchable: false,
          render: function (data, type, row) {
            return `
              <div class="d-flex gap-1">
                <button class="btn btn-sm btn-earth-secondary btn-view" data-id="${row.id}" title="Detail Barang">
                  <i class="fa-solid fa-eye"></i>
                </button>
                <a href="/form?id=${row.id}" class="btn btn-sm btn-earth-primary btn-edit" title="Edit Barang">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <button class="btn btn-sm btn-danger btn-delete btn-delete-row" data-id="${row.id}" data-name="${row.name}" title="Hapus Barang" style="background-color: var(--danger-color); border-color: var(--danger-color);">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </div>
            `;
          }
        }
      ],
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json', // Indonesian localization
        searchPlaceholder: 'Cari barang...'
      },
      order: [[5, 'desc']] // Order by date added descending
    });

    // Refresh Table Button
    $('#btnRefreshTable').on('click', function () {
      table.ajax.reload();
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Data berhasil diperbarui',
        showConfirmButton: false,
        timer: 1500
      });
    });
  }

  // ==================== FORM SUBMISSION (CREATE & UPDATE) ====================
  const form = $('#inventoryForm');
  if (form.length > 0) {
    form.on('submit', function (e) {
      e.preventDefault();
      
      // Bootstrap validation check
      if (!this.checkValidity()) {
        e.stopPropagation();
        form.addClass('was-validated');
        return;
      }

      const id = $('#itemId').val();
      const isEdit = !!id;
      const url = isEdit ? `/api/inventory/${id}` : '/api/inventory';
      const method = isEdit ? 'PUT' : 'POST';

      const formData = {
        name: $('#name').val(),
        category: $('#category').val(),
        quantity: $('#quantity').val(),
        condition: $('input[name="condition"]:checked').val(),
        location: $('#location').val() || '-',
        notes: $('#notes').val()
      };

      $('#btnSubmitForm').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...');

      $.ajax({
        url: url,
        type: method,
        contentType: 'application/json',
        data: JSON.stringify(formData),
        success: function (response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: isEdit ? 'Diperbarui!' : 'Tersimpan!',
              text: response.message,
              confirmButtonColor: '#8B5A2B',
              timer: 2000,
              timerProgressBar: true
            }).then(() => {
              window.location.href = '/table';
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: response.message,
              confirmButtonColor: '#8B5A2B'
            });
            $('#btnSubmitForm').prop('disabled', false).html('<i class="fa-solid fa-floppy-disk me-1"></i> Simpan Barang');
          }
        },
        error: function (xhr) {
          const err = xhr.responseJSON || { message: 'Terjadi kesalahan sistem' };
          Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: err.message,
            confirmButtonColor: '#8B5A2B'
          });
          $('#btnSubmitForm').prop('disabled', false).html('<i class="fa-solid fa-floppy-disk me-1"></i> Simpan Barang');
        }
      });
    });
  }

  // ==================== CRUD OPERATIONS VIA TABLE (DELETE & READ DETAILS) ====================
  
  // Event Delegation for View Button
  if ($('#inventoryTable').length > 0) {
    $('#inventoryTable').on('click', '.btn-view', function () {
      const id = $(this).data('id');
      loadDetail(id);
    });

    // Event Delegation for Delete Button in Table Row
    $('#inventoryTable').on('click', '.btn-delete-row', function () {
      const id = $(this).data('id');
      const name = $(this).data('name');
      confirmDelete(id, name);
    });
  }

  // Modal Detail Action Buttons
  let currentDetailId = null;
  
  function loadDetail(id) {
    $.ajax({
      url: `/api/inventory/${id}`,
      type: 'GET',
      success: function (response) {
        if (response.success) {
          const item = response.data;
          currentDetailId = item.id;
          
          $('#detailName').text(item.name);
          $('#detailCategory').text(item.category);
          $('#detailQuantity').text(item.quantity + ' Unit');
          
          const conditionHtml = item.condition === 'Baik' 
            ? `<span class="badge-good"><i class="fa-solid fa-circle-check me-1"></i>Baik</span>`
            : `<span class="badge-bad"><i class="fa-solid fa-circle-xmark me-1"></i>Rusak</span>`;
          $('#detailCondition').html(conditionHtml);
          
          $('#detailLocation').text(item.location || '-');
          
          const date = new Date(item.createdAt);
          $('#detailCreatedAt').text(date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          }));
          
          $('#detailNotes').text(item.notes || 'Tidak ada catatan tambahan.');
          
          // Show Modal
          $('#detailModal').modal('show');
        }
      }
    });
  }

  // Edit in Detail Modal
  $('#btnEditDetail').on('click', function () {
    if (currentDetailId) {
      window.location.href = `/form?id=${currentDetailId}`;
    }
  });

  // Delete in Detail Modal
  $('#btnDeleteDetail').on('click', function () {
    if (currentDetailId) {
      const name = $('#detailName').text();
      $('#detailModal').modal('hide');
      confirmDelete(currentDetailId, name);
    }
  });

  // Reusable Delete Confirmation
  function confirmDelete(id, name) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: `Barang "${name}" akan dihapus secara permanen dari inventaris.`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#A94A4A', // danger color
      cancelButtonColor: '#6E8268', // sage color
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/api/inventory/${id}`,
          type: 'DELETE',
          success: function (response) {
            if (response.success) {
              Swal.fire({
                icon: 'success',
                title: 'Dihapus!',
                text: 'Barang telah berhasil dihapus.',
                confirmButtonColor: '#8B5A2B',
                timer: 1500
              });
              if (table) table.ajax.reload();
            }
          },
          error: function () {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: 'Terjadi kesalahan saat menghapus barang.',
              confirmButtonColor: '#8B5A2B'
            });
          }
        });
      }
    });
  }
});
