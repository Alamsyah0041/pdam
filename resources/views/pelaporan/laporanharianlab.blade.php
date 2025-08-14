@extends('pelaporan.master')

@section('content')
<div class="container mt-5">
  <h3 class="text-center mb-4">Laporan Harian Lab</h3>
  @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <h5>Daftar Laporan Harian Lab</h5>
  <h5>{{ Carbon\Carbon::now()->translatedFormat('d F Y') }}</h5>
  {{-- <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#ModalOperator">
    <i class="fas fa-plus-circle me-2"></i> TAMBAH DATA
  </button> --}}

  <div class="card shadow">
    <div class="card-body">
      <table id="myTable" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead class="table-primary">
          <tr class="text-center">
            <th width="5%">No</th>
            <th>Waktu Pengisian</th>
            <th>NTU AIR BERSIH</th>
            <th>NTU AIR BAKU</th>
            <th>SISA CHLOR</th>
            <th>PH</th>
            <th>Status</th>
        
          </tr>
        </thead>
        <tbody>
          @foreach ($lab as $la)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-center">{{ $la->created_at->format('d F Y H:i') }}</td>
            <td class="text-center">{{ $la->ntu_air_bersih }}</td>
            <td class="text-center">{{ $la->ntu_air_baku }}</td>
            <td class="text-center">{{ $la->sisa_chlor }}</td>
            <td class="text-center">{{ $la->ph }}</td>
            <td>
              @if($la->ntu_air_bersih < 5 )
                <span class="badge bg-warning">Ntu Air Bersih Dibawah Standar </span>
              @else
                <span class="badge bg-success">Sesuai Standar</span>
              @endif
              @if($la->ntu_air_baku > 25 )
                <span class="badge bg-warning">Sesuai Standar </span>
              @else
                <span class="badge bg-success">Normal</span>
              @endif
              @if($la->sisa_chlor > 8 )
                <span class="badge bg-warning">Sesuai Standar </span>
              @else
                <span class="badge bg-success">Normal</span>
              @endif
              @if($la->ph > 9)
                <span class="badge bg-warning">Sesuai Standar </span>
              @else
                <span class="badge bg-success">Normal</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
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
                  <label for="pompa" class="form-label">Pompa</label>
                  <select class="form-select" id="pompa" name="pompa" required>
                    <option value="Pompa 1">Pompa 1</option>
                    <option value="Pompa 2">Pompa 2</option>
                    <option value="Pompa 3">Pompa 3</option>
                  </select>
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
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="edit-nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="edit-nama" name="nama" required>
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
                  <label for="edit-pompa" class="form-label">Pompa</label>
                  <select class="form-select" id="edit-pompa" name="pompa" required>
                    <option value="Pompa 1">Pompa 1</option>
                    <option value="Pompa 2">Pompa 2</option>
                    <option value="Pompa 3">Pompa 3</option>
                  </select>
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

@push('scripts')
<script>
  $(document).ready(function () {
    // Initialize DataTable with enhanced buttons
    $('#myTable').DataTable({
      dom: '<"row"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"l><"col-md-6"p>>',
      buttons: [
        {
          extend: 'copy',
          text: '<i class="fas fa-copy me-1"></i> Copy',
          className: 'btn btn-info btn-sm',
          exportOptions: {
            columns: ':not(:last-child)'
          }
        },
        {
          extend: 'csv',
          text: '<i class="fas fa-file-csv me-1"></i> CSV',
          className: 'btn btn-success btn-sm',
          exportOptions: {
            columns: ':not(:last-child)'
          }
        },
        {
          extend: 'excel',
          text: '<i class="fas fa-file-excel me-1"></i> Excel',
          className: 'btn btn-success btn-sm',
          exportOptions: {
            columns: ':not(:last-child)'
          }
        },
        {
          extend: 'pdf',
          text: '<i class="fas fa-file-pdf me-1"></i> PDF',
          className: 'btn btn-danger btn-sm',
          exportOptions: {
            columns: ':not(:last-child)'
          }
        },
        {
          extend: 'print',
          text: '<i class="fas fa-print me-1"></i> Print',
          className: 'btn btn-primary btn-sm',
          exportOptions: {
            columns: ':not(:last-child)'
          },
          customize: function (win) {
            $(win.document.body).find('table').addClass('display').css('font-size', '10px');
            $(win.document.body).find('tr:nth-child(odd) td').css('background-color','#f9f9f9');
            $(win.document.body).find('h1').css('text-align','center').css('font-size', '16px');
          }
        }
      ],
      responsive: true,
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
        { responsivePriority: 2, targets: -1 }
      ]
    });

    // Form submission with validation
    $("#formLaporan").submit(function (e) {
      e.preventDefault();
      const debitAir = parseFloat($("#Debit_air").val());

      if (debitAir > 421) {
        Swal.fire({
          icon: 'warning',
          title: 'Peringatan',
          text: 'Nilai Debit Air lebih dari rata-rata!',
        });
      } else {
        let formData = new FormData(this);
        $.ajax({
          url: "{{ route('Operator.store') }}",
          type: "POST",
          data: formData,
          processData: false,    
          contentType: false,    
          success: function (response) {
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: 'Data berhasil disimpan!',
            }).then(() => {
              $("#ModalOperator").modal("hide");
              location.reload();
            });
          },
          error: function (xhr) {
            Swal.fire({
              icon: 'error',
              title: 'Gagal',
              text: 'Terjadi kesalahan saat menyimpan data.',
            });
          }
        });
      }
    });

    // Edit Data
    $('body').on('click', '.edit-operator', function () {
      const id = $(this).data('id');
      
      $.get('/Operator/' + id + '/edit', function (data) {
        $('#edit-id').val(data.id);
        $('#edit-nama').val(data.nama);
        $('#edit-Debit_air').val(data.Debit_air);
        $('#edit-tinggi_reservoard').val(data.tinggi_reservoard);
        $('#edit-status_pompa').val(data.status_pompa);
        $('#edit-frekuensi_pompa').val(data.frekuensi_pompa);
        $('#edit-pompa').val(data.pompa);
        $('#edit-keluhan').val(data.keluhan);
        
        // Handle image display
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

        $('#formEditLaporan').attr('action', '/Operator/' + data.id);
        $('#ModalEditOperator').modal('show');
      }).fail(function () {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Gagal mengambil data.',
        });
      });
    });

    // Handle edit form submission
    $("#formEditLaporan").submit(function(e) {
      e.preventDefault();
      
      let formData = new FormData(this);
      
      $.ajax({
        url: $(this).attr('action'),
        type: "POST",
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
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Terjadi kesalahan saat mengupdate data.',
          });
        }
      });
    });
  });
</script>
@endpush