        <div class="container-fluid page-body-wrapper">
          <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
            <li class="nav-item">
            <a class="nav-link" href="/dashboard">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
            </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Laporan</span>
            <i class="menu-arrow"></i>
          </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/Operator">Laporan Operator</a></li>
            <li class="nav-item"> <a class="nav-link" href="/lab">Laporan Lab</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Rekaputulasi Laporan</a></li> --}}
          </ul>
        </div>

        
          </li>
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Rekapan Laporan IPA</span>
              <i class="menu-arrow"></i>
            </a>

        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="/laporanharian">Laporan Harian</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('laporanbulanan') }}">Laporan Bulanan</a></li>
            <li class="nav-item"><a class="nav-link" href="/laporanharianlab">Laporan Harian Lab</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('laporanbulananlab') }}">Laporan Bulanan Lab</a></li>
          </ul>
        </div>
       

        </li>
          <li class="nav-item">
            {{-- <a class="nav-link" href="/lokasi">
              <i class="mdi mdi-map-marker menu-icon"></i>
                <span class="menu-title">Lokasi</span>
            </a> --}}
         </li>
        </ul>
        </nav>
        
        