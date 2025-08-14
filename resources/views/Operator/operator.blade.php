@extends('pelaporan.master')

@section('content')
<div class="container mt-5">
  <h3 class="text-center mb-4">Laporan Operator</h3>
  <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#ModalOperator">
    <i class="fas fa-plus-circle me-2"></i> TAMBAH DATA
  </button>

  <div class="card shadow">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table id="myTable" class="table table-striped table-bordered" style="width:100%">
          <thead class="table-primary">
            <tr class="text-center">
              <th>No</th>
              <th>Nama</th>
              <th>Debit Air</th>
              <th>Waktu Pengisian</th>
              <th>Tinggi Reservoir</th>
              <th>Status Pompa</th>
              <th>Frekuensi Pompa</th>
              <th>Pompa</th>
              <th>Keluhan</th>
              <th>Status</th>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($operator as $opera)
            <tr>
              {{-- {{ dd($opera) }} --}}
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $opera->user->name }}</td>
              <td class="text-center">{{ $opera->Debit_air }} L/s</td>
              <td>{{ $opera->created_at->format('d F Y / H:i') }}</td>
              <td class="text-center">{{ $opera->tinggi_reservoard }} m</td>
              <td class="text-center">
                <span class="badge bg-{{ $opera->status_pompa == 'Menyala' ? 'success' : 'danger' }}">
                  {{ $opera->status_pompa }}
                </span>
              </td>
              <td class="text-center">{{ $opera->frekuensi_pompa }} Hz</td>
              <td class="text-center">{{ $opera->pompa }}</td>
              <td>{{ $opera->keluhan }}</td>
              <td>
                @if($opera->Debit_air < 250)
                  <span class="badge bg-warning">Debit Air Rendah</span>
                @else
                  <span class="badge bg-success">Normal</span>
                @endif
              </td>
              <td class="text-center">
                @if($opera->image)
                <img src="{{ asset('storage/' . $opera->image) }}" 
                     alt="Foto Operator"
                     class="img-fluid" 
                     style="max-height: 80px;">
                @else
                <span class="text-muted">Tidak ada foto</span>
                @endif
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-warning edit-operator" data-id="{{ $opera->id }}" title="Edit">
                  <i class="fas fa-edit"></i>
                </button>
                <form action="{{ route('Operator.destroy', $opera->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Data -->
    <div class="modal fade" id="ModalOperator" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="ModalLabel">Tambah Data Laporan Operator</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formLaporan" action="{{ route('Operator.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                {{-- <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div> --}}
                <div class="mb-3">
                  <label for="Debit_air" class="form-label">Debit Air (L/s)</label>
                  <input type="number" step="0.01" class="form-control" id="Debit_air" name="Debit_air" required>
                </div>
                <div class="mb-3">
                  <label for="tinggi_reservoard" class="form-label">Tinggi Reservoir (m)</label>
                  <input type="number" step="0.01" class="form-control" id="tinggi_reservoard" name="tinggi_reservoard" required>
                </div>
                <div class="mb-3">
                  <label for="status_pompa" class="form-label">Status Pompa</label>
                  <select class="form-select" id="status_pompa" name="status_pompa" required>
                    <option value="Menyala">Menyala</option>
                    <option value="Mati">Mati</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="frekuensi_pompa" class="form-label">Frekuensi Pompa (Hz)</label>
                  <input type="number" step="0.1" class="form-control" id="frekuensi_pompa" name="frekuensi_pompa" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Pompa</label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="pompa[]" value="Pompa 1" id="pompa1">
                  <label class="form-check-label" for="pompa1">Pompa 1</label>
                  <input class="form-check-input" type="checkbox" name="pompa[]" value="Pompa 2" id="pompa2">
                  <label class="form-check-label" for="pompa2">Pompa 2</label>
                  <input class="form-check-input" type="checkbox" name="pompa[]" value="Pompa 3" id="pompa3">
                  <label class="form-check-label" for="pompa3">Pompa 3</label>
                </div>
              </div>

                <div class="mb-3">
                  <label for="keluhan" class="form-label">Keluhan</label>
                  <textarea class="form-control" id="keluhan" name="keluhan" rows="3"></textarea>
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Gambar</label>
                  <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Edit Data -->
  <div class="modal fade" id="ModalEditOperator" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="EditModalLabel">Edit Data Laporan Operator</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formEditLaporan" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-id" name="id">
              <input type="hidden" id="id_op" name="id_op">

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="edit-nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="edit-nama" name="nama" readonly>
                  {{-- <input type="text" class="form-control" id="id_op" name="id_op" hidden> --}}
                </div>
                <div class="mb-3">
                  <label for="edit-Debit_air" class="form-label">Debit Air (L/s)</label>
                  <input type="number" step="0.01" class="form-control" id="edit-Debit_air" name="Debit_air" required>
                </div>
                <div class="mb-3">
                  <label for="edit-tinggi_reservoard" class="form-label">Tinggi Reservoir (m)</label>
                  <input type="number" step="0.01" class="form-control" id="edit-tinggi_reservoard" name="tinggi_reservoard" required>
                </div>
                <div class="mb-3">
                  <label for="edit-status_pompa" class="form-label">Status Pompa</label>
                  <select class="form-select" id="edit-status_pompa" name="status_pompa" required>
                    <option value="Menyala">Menyala</option>
                    <option value="Mati">Mati</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="edit-frekuensi_pompa" class="form-label">Frekuensi Pompa (Hz)</label>
                  <input type="number" step="0.1" class="form-control" id="edit-frekuensi_pompa" name="frekuensi_pompa" required>
                </div>
                <div class="mb-3">
                <label class="form-label">Pompa</label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="pompa[]" value="Pompa 1" id="pompa1">
                  <label class="form-check-label" for="pompa1">Pompa 1</label>
                  <input class="form-check-input" type="checkbox" name="pompa[]" value="Pompa 2" id="pompa2">
                  <label class="form-check-label" for="pompa2">Pompa 2</label>
                  <input class="form-check-input" type="checkbox" name="pompa[]" value="Pompa 3" id="pompa3">
                  <label class="form-check-label" for="pompa3">Pompa 3</label>
                </div>
              </div>
                <div class="mb-3">
                  <label for="edit-keluhan" class="form-label">Keluhan</label>
                  <textarea class="form-control" id="edit-keluhan" name="keluhan" rows="3"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Gambar</label>
                  <div id="current-image-container" class="mb-2 text-center">
                    <!-- Current image will be shown here -->
                  </div>
                  <label for="edit-image" class="form-label">Unggah Gambar Baru</label>
                  <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                  <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="remove-image" name="remove_image">
                    <label class="form-check-label" for="remove-image">
                      Hapus Gambar Saat Ini
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('styles')
<style>
  /* Improved table styling */
  #myTable {
    width: 100% !important;
    table-layout: fixed;
  }
  
  #myTable td, #myTable th {
    vertical-align: middle;
    word-wrap: break-word;
    padding: 8px 12px;
  }
  
  #myTable .img-fluid {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
  }
  
  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  
  @media (max-width: 768px) {
    #myTable td, #myTable th {
      padding: 6px 8px;
      font-size: 0.9rem;
    }
    
    #myTable .btn {
      padding: 0.2rem 0.4rem;
      font-size: 0.8rem;
      margin: 2px;
    }
  }
</style>
@endpush

@push('scripts')
<!-- SweetAlert2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<script>
$(document).ready(function () {
  // Initialize DataTable with proper image handling
  $('#myTable').DataTable({
    dom: '<"row"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"l><"col-md-6"p>>',
    responsive: true,
    autoWidth: false,
    scrollX: true,
    buttons: [
      {
        extend: 'copy',
        text: '<i class="fas fa-copy me-1"></i> Copy',
        className: 'btn btn-info btn-sm',
        exportOptions: { columns: ':not(:last-child)' }
      },
      {
        extend: 'csv',
        text: '<i class="fas fa-file-csv me-1"></i> CSV',
        className: 'btn btn-success btn-sm',
        exportOptions: { columns: ':not(:last-child)' }
      },
      {
        extend: 'excel',
        text: '<i class="fas fa-file-excel me-1"></i> Excel',
        className: 'btn btn-success btn-sm',
        exportOptions: { columns: ':not(:last-child)' }
      },
      {
        extend: 'pdf',
        text: '<i class="fas fa-file-pdf me-1"></i> PDF',
        className: 'btn btn-danger btn-sm',
        exportOptions: { columns: ':not(:last-child)' }
      },
      {
        extend: 'print',
        text: '<i class="fas fa-print me-1"></i> Print',
        className: 'btn btn-primary btn-sm',
        exportOptions: { columns: ':not(:last-child)' },
        customize: function (win) {
          $(win.document.body).find('table').addClass('display').css('font-size', '10px');
          $(win.document.body).find('tr:nth-child(odd) td').css('background-color','#f9f9f9');
          $(win.document.body).find('h1').css({ 'text-align':'center', 'font-size': '16px' });
        }
      }
    ],
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Cari...",
      lengthMenu: "Tampilkan _MENU_ data",
      info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
      infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
      infoFiltered: "(disaring dari _MAX_ total data)",
      paginate: {
        first: "Pertama",
        last: "Terakhir",
        next: "Selanjutnya",
        previous: "Sebelumnya"
      }
    },
    columnDefs: [
      { responsivePriority: 1, targets: 0 },
      { responsivePriority: 2, targets: -1 },
      { width: '5%', targets: 0 },
      { width: '10%', targets: 9 },  // Foto column (index 9)
      { width: '10%', targets: 10 }, // Aksi column (index 10)
      {
        targets: 9, // Explicitly target Foto column by index
        createdCell: function (td, cellData, rowData, row, col) {
          // This ensures the image rendering is preserved
          if (cellData) {
            $(td).html(`<img src="${cellData}" class="img-fluid" style="max-height:80px;">`);
          } else {
            $(td).html('<span class="text-muted">Tidak ada foto</span>');
          }
        }
      }
    ],
    columnDefs: [
      { responsivePriority: 1, targets: 0 },
      { responsivePriority: 2, targets: -1 },
      { width: '5%', targets: 0 },
      { width: '15%', targets: -3 },
      { width: '10%', targets: -1 },
    ]
  });

  // Submit form menggunakan AJAX
  function submitFormData(form) {
    const formData = new FormData(form);

    $.ajax({
      url: $(form).attr('action'),
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function () {
        Swal.fire({
          icon: 'success',
          title: 'Sukses',
          text: 'Data berhasil disimpan dan Pesan Terkirim Ke Whatsapp!',
        }).then(() => {
          $(".modal").modal("hide");
          location.reload();
        });
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Terjadi kesalahan saat menyimpan data.',
        });
      }
    });
  }

  // Validasi dan kirim Form Tambah
  $("#formLaporan").submit(function (e) {
    e.preventDefault();
    const debitAir = parseFloat($("#Debit_air").val());

    if (debitAir > 421) {
      Swal.fire({
        icon: 'warning',
        title: 'Peringatan',
        text: 'Nilai Debit Air lebih dari rata-rata!',
      });
    } else if (debitAir < 350) {
      Swal.fire({
        icon: 'warning',
        title: 'Peringatan',
        text: 'Debit Air di bawah standar!',
        showCancelButton: true,
        confirmButtonText: 'Lanjutkan',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          submitFormData(this);
        }
      });
    } else {
      submitFormData(this);
    }
  });

  // Isi data saat tombol edit diklik
$('body').on('click', '.edit-operator', function () {
  const id = $(this).data('id');

  $.get('/Operator/' + id + '/edit', function (data) {
    if (!data || typeof data !== 'object') {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Data operator tidak ditemukan.',
      });
      return;
    }

    $('#edit-id').val(data.id);
    $('#edit-nama').val(data.nama);
    $('#edit-Debit_air').val(data.Debit_air);
    $('#edit-tinggi_reservoard').val(data.tinggi_reservoard);
    $('#edit-status_pompa').val(data.status_pompa);
    $('#edit-frekuensi_pompa').val(data.frekuensi_pompa);
    $('#edit-keluhan').val(data.keluhan);

    // ✅ Reset dulu semua checkbox pompa
    $('input[name="pompa[]"]').prop('checked', false);

    // ✅ Tangani data.pompa sebagai string atau array
    if (data.pompa) {
      let selectedPompa = [];

      if (Array.isArray(data.pompa)) {
        selectedPompa = data.pompa;
      } else if (typeof data.pompa === 'string') {
        selectedPompa = data.pompa.split(',').map(p => p.trim());
      }

      selectedPompa.forEach(val => {
        $(`input[name="pompa[]"][value="${val}"]`).prop('checked', true);
      });
    }

    // ✅ Tampilkan gambar
    const imageContainer = $('#current-image-container');
    imageContainer.empty();

    if (data.image) {
      imageContainer.append(`
        <img src="/storage/${data.image}" 
             alt="Gambar Saat Ini" 
             class="img-thumbnail"
             style="max-width: 150px; max-height: 150px;">
      `);
    } else {
      imageContainer.html('<p class="text-muted">Tidak Ada Gambar</p>');
    }

    // ✅ Set action form
    $('#formEditLaporan').attr('action', '/Operator/' + data.id);
    
    // ✅ Tampilkan modal
    $('#ModalEditOperator').modal('show');
  }).fail(function (xhr, status, error) {
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: 'Gagal mengambil data operator.',
    });
    console.error("AJAX Error:", status, error);
  });
});

  // Submit form edit
// Submit form edit
$("#formEditLaporan").submit(function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    // Add CSRF token to the form data
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('_method', 'PUT');

    $.ajax({
        url: $(this).attr('action'),
        type: "POST", // Laravel expects POST for PUT/PATCH methods
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Data berhasil diupdate!',
            }).then(() => {
                $("#ModalEditOperator").modal("hide");
                location.reload();
            });
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMsg = '';
            
            // Display validation errors if any
            if (errors) {
                $.each(errors, function(key, value) {
                    errorMsg += value + '<br>';
                });
            } else {
                errorMsg = 'Terjadi kesalahan saat mengupdate data.';
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: errorMsg
            });
        }
    });
});
});
</script>
@endpush
