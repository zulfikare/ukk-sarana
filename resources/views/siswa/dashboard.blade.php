<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }} - Dashboard Siswa</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('siswa.components.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Siswa</h1>
                        <p class="text-sm text-gray-700">
                            Selamat datang, <strong>NIS: {{ $nis }}</strong>
                        </p>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Total Pengaduan Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-primary font-weight-bold text-uppercase mb-1">
                                        Total Pengaduan
                                    </div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalPengaduan }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Pengaduan Proses Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-warning font-weight-bold text-uppercase mb-1">
                                        Proses
                                    </div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pengaduanProses }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Pengaduan Selesai Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-success font-weight-bold text-uppercase mb-1">
                                        Selesai
                                    </div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pengaduanSelesai }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-info font-weight-bold text-uppercase mb-1">
                                        Aksi Cepat
                                    </div>
                                    <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus"></i> Input Aspirasi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                   
                </div>
            </div>
            @include('components.footer')
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
