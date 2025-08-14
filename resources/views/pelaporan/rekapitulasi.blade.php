@extends('pelaporan.master')
@section('content')
<div class="container mt-5">
  <h3 class="text-center">Rekapitulasi Laporan</h3>
  <div class="container mt-5">
    <table id="myTable" class="table table-striped table-bordered mt-3"> 
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Nama Laporan</th>
          <th>Total Data</th>
          <th>Aksi</th>
        </tr>
      </thead> 
      <tbody>
        @foreach ($laporan as $index => $lap)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $lap->nama_laporan }}</td>
            <td>{{ $lap->total_data }}</td>
            <td>
                <a href="{{ route('laporan.detail', $lap->id) }}" class="btn btn-info btn-sm">Detail</a>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection