@extends('pelaporan.master')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Selamat Datang Admin</h3>
            <h6 class="font-weight-normal mb-0">Sistem Informasi Pelaporan Produksi IPA Prumdam Tirta Kencana Kota Samarinda <span class="text-primary">Sedang Tahap Pembuatan</span></h6>
          </div>
          <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
              <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuDate2">
                  <li><a class="dropdown-item" href="#">January - March</a></li>
                  <li><a class="dropdown-item" href="#">March - June</a></li>
                  <li><a class="dropdown-item" href="#">June - August</a></li>
                  <li><a class="dropdown-item" href="#">August - November</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Full-width image -->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card-people">
          <img src="assets/images/dashboard/pdam.jpg" 
               class="img-fluid w-100" 
               style="height: 300px; object-fit: cover;">
          <div class="weather-info">
            <div class="d-flex">
              <div>
                <h2 class="mb-0 font-weight-normal"><i class="icon-sun me-2"></i>34<sup>C</sup></h2>
              </div>
              <div class="ms-2">
                <h4 class="location font-weight-normal">Perumdam Tirta Kencana</h4>
                <h6 class="font-weight-normal">Samarinda</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Cards row below the image -->
    <div class="row mt-4">
      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card card-tale h-100">
          <div class="card-body text-center">
            <h4 class="mb-2">Debit Air Terakhir</h4>
            @if(isset($dataOperatorTerakhir))
              <p class="fs-30 mb-0">{{ $dataOperatorTerakhir->Debit_air }} L/d</p>
            @else
              <p class="fs-30 mb-0">Data tidak tersedia</p>
            @endif
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card card-dark-blue h-100">
          <div class="card-body text-center">
            <h4 class="mb-2">Tinggi Reservoard Terakhir</h4>
            @if(isset($dataOperatorTerakhir))
              <p class="fs-30 mb-0">{{ $dataOperatorTerakhir->tinggi_reservoard }} L/d</p>
            @else
              <p class="fs-30 mb-0">Data tidak tersedia</p>
            @endif
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card card-light-blue h-100">
          <div class="card-body text-center">
            <h4 class="mb-2">Keluhan Terakhir</h4>
            @if(isset($dataOperatorTerakhir))
              <p class="fs-30 mb-0">{{ $dataOperatorTerakhir->keluhan }}</p>
            @else
              <p class="fs-30 mb-0">Data tidak tersedia</p>
            @endif
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 mb-4">
        <div class="card card-light-danger h-100">
          <div class="card-body text-center">
            <h4 class="mb-2">Pelapor Terakhir</h4>
            @if(isset($dataOperatorTerakhir))
              <p class="fs-30 mb-0">{{ $dataOperatorTerakhir->user->name }}</p>
            @else
              <p class="fs-30 mb-0">Data tidak tersedia</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection