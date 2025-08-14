@extends('pelaporan.master')
@section('content')
<div class="container mt-5">
  <h3 class="text-center mb-4">Laporan Laboratorium</h3>
  <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ModalLab">
    <i class="fas fa-plus-circle me-2"></i> TAMBAH DATA
  </button>

  <div class="card shadow">
    <div class="card-body">
      <table id="myTable" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead class="table-primary">
          <tr class="text-center">
            <th width="5%">No</th>
            <th>NTU AIR BERSIH</th>
            <th>NTU AIR BAKU</th>
            <th>SISA CHLOR</th>
            <th>PH</th>
            <th>Status</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($lab as $la)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
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

            <td class="text-center">
              <button type="button" class="btn btn-sm btn-warning edit-lab" data-id="{{ $la->id }}" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
              <form action="{{ route('lab.destroy', $la->id) }}" method="POST" style="display:inline;">
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

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="ModalLab" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="ModalLabel">Tambah Data Laporan Lab</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formLaporan">
            @csrf
            <div class="mb-3">
              <label for="ntu_air_bersih" class="form-label">NTU Nilai Bersih</label>
              <input type="number" step="0.1" class="form-control" id="ntu_air_bersih" name="ntu_air_bersih" required>
            </div>
            <div class="mb-3">
              <label for="ntu_air_baku" class="form-label">NTU Air Baku</label>
              <input type="number" step="0.1" class="form-control" id="ntu_air_baku" name="ntu_air_baku" required>
            </div>
            <div class="mb-3">
              <label for="sisa_chlor" class="form-label">Sisa Chlor</label>
              <input type="number" step="0.1" class="form-control" id="sisa_chlor" name="sisa_chlor" required>
            </div>
            <div class="mb-3">
              <label for="ph" class="form-label">pH Air</label>
              <input type="number" step="0.1" class="form-control" id="ph" name="ph" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" id="simpanData">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Data -->
  <div class="modal fade" id="ModalEditLab" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="EditModalLabel">Edit Data Laporan Lab</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formEditLaporan" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id" name="id">
            <div class="mb-3">
              <label for="edit-ntu_air_bersih" class="form-label">NTU Nilai Bersih</label>
              <input type="number" step="0.1" class="form-control" id="edit-ntu_air_bersih" name="ntu_air_bersih" required>
            </div>
            <div class="mb-3">
              <label for="edit-ntu_air_baku" class="form-label">NTU Air Baku</label>
              <input type="number" step="0.1" class="form-control" id="edit-ntu_air_baku" name="ntu_air_baku" required>
            </div>
            <div class="mb-3">
              <label for="edit-sisa_chlor" class="form-label">Sisa Chlor</label>
              <input type="number" step="0.1" class="form-control" id="edit-sisa_chlor" name="sisa_chlor" required>
            </div>
            <div class="mb-3">
              <label for="edit-ph" class="form-label">pH Air</label>
              <input type="number" step="0.1" class="form-control" id="edit-ph" name="ph" required>
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
</div>

@push('scripts')
<script>
  $(document).ready(function () {
    // Initialize DataTable with colored buttons
    $('#myTable').DataTable({
      dom: '<"row"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"l><"col-md-6"p>>',
      buttons: [
        {
          extend: 'copy',
          text: '<i class="fas fa-copy me-1"></i> Copy',
          className: 'btn btn-info btn-sm'
        },
        {
          extend: 'csv',
          text: '<i class="fas fa-file-csv me-1"></i> CSV',
          className: 'btn btn-success btn-sm'
        },
        {
          extend: 'excel',
          text: '<i class="fas fa-file-excel me-1"></i> Excel',
          className: 'btn btn-success btn-sm'
        },
        {
          extend: 'pdf',
          text: '<i class="fas fa-file-pdf me-1"></i> PDF',
          className: 'btn btn-danger btn-sm'
        },
        {
          extend: 'print',
          text: '<i class="fas fa-print me-1"></i> Print',
          className: 'btn btn-primary btn-sm'
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
      }
    });

    // Your existing AJAX functions remain exactly the same
    $('#formLaporan').submit(function (e) {
      e.preventDefault();

      const ntu_bersih = parseFloat($('#ntu_air_bersih').val());

      if (ntu_bersih > 5) {
        alert("NTU melebihi batas normal!");
      } else {
        alert("NTU dalam batas normal.");
      }

      const ntu_air_baku = parseFloat($('#ntu_air_baku').val());

      if (ntu_air_baku > 25) {
        alert("NTU melebihi batas normal!");
      } else {
        alert("NTU dalam batas normal.");
      }

      const sisa_chlor = parseFloat($('#ntu_air_bersih').val());

      if (sisa_chlor > 8) {
        alert("Sisa Chlor melebihi batas normal!");
      } else {
        alert("Sisa Chlor dalam batas normal.");
      }

      const ph = parseFloat($('#ph').val());

      if (ph > 9 || ph < 6) {
        alert("PH melebihi batas normal!");
      } else {
        alert("PH dalam batas normal.");
      }

      let formData = $(this).serialize();

      $.ajax({
        url: "{{ route('lab.store') }}",
        type: "POST",
        data: formData,
        success: function (response) {
          alert("Data berhasil disimpan!");
          $('#ModalLab').modal('hide');
          location.reload();
        },
        error: function (e) {
          alert(e.responseJSON.message);
        }
      });
    });

  $('body').on('click', '.edit-lab', function() {
    const id = $(this).data('id');
    
    $.ajax({
        url: '/Lab/' + id + '/edit',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#edit_id').val(data.id);
            $('#edit-ntu_air_bersih').val(data.ntu_air_bersih);
            $('#edit-ntu_air_baku').val(data.ntu_air_baku);
            $('#edit-sisa_chlor').val(data.sisa_chlor);
            $('#edit-ph').val(data.ph);
            
            $('#formEditLaporan').attr('action', '/Lab/' + data.id);
            $('#ModalEditLab').modal('show');
        },
        error: function(xhr, status, error) {
            console.error("Error:", status, error);
            alert('Gagal mengambil data lab');
        }
    });
});

$('#formEditLaporan').submit(function(e) {
    e.preventDefault();
    const id = $('#edit_id').val();
    const formData = $(this).serialize();
    
    $.ajax({
        url: '/Lab/' + id,
        type: 'POST',
        data: formData + '&_method=PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'Data berhasil diperbarui!',
            }).then(() => {
                $('#ModalEditLab').modal('hide');
                location.reload();
            });
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMsg = '';
            
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
@endsection