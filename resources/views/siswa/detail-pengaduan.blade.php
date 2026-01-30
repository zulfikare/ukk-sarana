<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }} - Detail Pengaduan</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <x-sidebar-siswa />
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <x-topbar />
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Pengaduan</h1>
                        <a href="{{ route('siswa.riwayat') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-file-alt"></i> Informasi Pengaduan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold text-gray-700">Tanggal Pengaduan</h6>
                                            <p>{{ $pengaduan->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold text-gray-700">Kategori</h6>
                                            <p>
                                                <span class="badge badge-primary badge-lg px-3 py-2">
                                                    {{ $pengaduan->kategori->nama ?? 'N/A' }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold text-gray-700">Pelapor</h6>
                                            <p>{{ $pengaduan->pelapor }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold text-gray-700">Status</h6>
                                            <p>
                                                @if ($pengaduan->status == 'masuk')
                                                    <span class="badge badge-warning badge-lg px-3 py-2">Masuk</span>
                                                @elseif ($pengaduan->status == 'proses')
                                                    <span class="badge badge-info badge-lg px-3 py-2">Proses</span>
                                                @elseif ($pengaduan->status == 'selesai')
                                                    <span class="badge badge-success badge-lg px-3 py-2">Selesai</span>
                                                @else
                                                    <span class="badge badge-secondary badge-lg px-3 py-2">{{ ucfirst($pengaduan->status) }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold text-gray-700">Tanggal Selesai</h6>
                                            <p>
                                                @if ($pengaduan->tanggal_selesai)
                                                    {{ \Carbon\Carbon::parse($pengaduan->tanggal_selesai)->format('d/m/Y H:i') }}
                                                @else
                                                    <span class="text-muted">Belum selesai</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="font-weight-bold text-gray-700">Waktu Pemrosesan</h6>
                                            <p>
                                                @if ($pengaduan->tanggal_selesai)
                                                    {{ \Carbon\Carbon::parse($pengaduan->created_at)->diffInDays(\Carbon\Carbon::parse($pengaduan->tanggal_selesai)) }} hari
                                                @else
                                                    {{ \Carbon\Carbon::parse($pengaduan->created_at)->diffInDays(\Carbon\Carbon::now()) }} hari
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="mb-3">
                                        <h6 class="font-weight-bold text-gray-700">Isi Pengaduan</h6>
                                        <div class="bg-light p-3 rounded">
                                            <p class="mb-0">{{ nl2br(e($pengaduan->isi_pengaduan)) }}</p>
                                        </div>
                                    </div>

                                    @if ($pengaduan->deskripsi)
                                        <hr>
                                        <div class="mb-3">
                                            <h6 class="font-weight-bold text-gray-700">
                                                <i class="fas fa-comment-dots text-info"></i> Feedback/Catatan dari Admin
                                            </h6>
                                            <div class="alert alert-info" role="alert">
                                                <p class="mb-0">{{ nl2br(e($pengaduan->deskripsi)) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Status Timeline -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-clock"></i> Timeline Status
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="timeline">
                                        <!-- Item 1: Masuk -->
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-success">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="font-weight-bold">Pengaduan Masuk</h6>
                                                <p class="text-sm text-muted">{{ $pengaduan->created_at->format('d/m/Y H:i') }}</p>
                                            </div>
                                        </div>

                                        <!-- Item 2: Proses -->
                                        <div class="timeline-item">
                                            <div class="timeline-marker {{ $pengaduan->status != 'masuk' ? 'bg-info' : 'bg-secondary' }}">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="font-weight-bold">Dalam Proses</h6>
                                                <p class="text-sm text-muted">
                                                    @if ($pengaduan->status != 'masuk')
                                                        Pengaduan sedang diproses
                                                    @else
                                                        Menunggu diproses
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Item 3: Selesai -->
                                        <div class="timeline-item">
                                            <div class="timeline-marker {{ $pengaduan->status == 'selesai' ? 'bg-success' : 'bg-secondary' }}">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 class="font-weight-bold">Selesai</h6>
                                                <p class="text-sm text-muted">
                                                    @if ($pengaduan->status == 'selesai')
                                                        {{ \Carbon\Carbon::parse($pengaduan->tanggal_selesai)->format('d/m/Y H:i') }}
                                                    @else
                                                        Menunggu penyelesaian
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Card -->
                            <div class="card shadow bg-light">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-info-circle"></i> Keterangan
                                    </h6>
                                </div>
                                <div class="card-body text-sm">
                                    <p><strong>Status Masuk:</strong> Pengaduan telah diterima sistem</p>
                                    <p><strong>Status Proses:</strong> Pengaduan sedang ditindaklanjuti</p>
                                    <p><strong>Status Selesai:</strong> Pengaduan telah ditangani</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <x-footer />
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

    <style>
        .timeline {
            position: relative;
            padding: 20px 0;
        }

        .timeline-item {
            display: flex;
            margin-bottom: 30px;
            position: relative;
        }

        .timeline-item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 19px;
            top: 50px;
            height: 30px;
            width: 2px;
            background: #e3e6f0;
        }

        .timeline-marker {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .timeline-content h6 {
            margin-bottom: 5px;
        }
    </style>
</body>

</html>
