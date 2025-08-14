<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PDAM TIRTA KENCANA</title>   
    @include('pelaporan.style')
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <meta name="theme-color" content="#712cf9">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}
    
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-section, .print-section * {
                visibility: visible;
            }
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
        .dt-buttons .btn {
            margin-right: 5px;
        }
        /* Custom button colors */
        .dt-button.buttons-excel {
        background-color: #1d6f42 !important; /* Excel green */
        color: white !important;
        }

        .dt-button.buttons-pdf {
        background-color: #d9534f !important; /* Bootstrap danger red */
        color: white !important;
        }

        .dt-button.buttons-copy {
        background-color: #17a2b8 !important; /* Bootstrap info blue */
        color: white !important;
        }

        .dt-button.buttons-print {
        background-color: #007bff !important; /* Bootstrap primary blue */
        color: white !important;
        }
    </style>
</head>
<body>
    @include('pelaporan.atas')
    @include('pelaporan.sidebar')
    
    <div class="main-panel">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- jQuery (only one version) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- DataTables and extensions -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    
    <!-- Export libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    
    <!-- Your custom scripts -->
    @stack('scripts')
</body>
</html>