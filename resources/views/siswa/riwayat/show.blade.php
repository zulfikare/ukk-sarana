<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - Detail Pengaduan</title>
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .width-33 { width: 33%; }
        .width-66 { width: 66%; }
        .width-100 { width: 100%; }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        @include('siswa.components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.topbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Pengaduan</h1>
                        <a href="{{ route('siswa.riwayat.index') }}" class="btn btn-sm btn-secondary">
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
                                            <strong>Kategori:</strong>
                                            <p>
                                                <span class="badge badge-info">{{ $pengaduan->kategori->ket_kategori }}</span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Status:</strong>
                                            <p>
                                                @if($pengaduan->status === 'Menunggu')
                                                    <span class="badge badge-warning">Menunggu</span>
                                                @elseif($pengaduan->status === 'Proses')
                                                    <span class="badge badge-info">Proses</span>
                                                @elseif($pengaduan->status === 'Selesai')
                                                    <span class="badge badge-success">Selesai</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $pengaduan->status }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    

                                    <hr>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>Tanggal Dibuat:</strong>
                                            <p>{{ $pengaduan->created_at->format('d/m/Y H:i:s') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                           @if($pengaduan->lokasi)
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <strong>Lokasi/Tempat:</strong>
                                                <p>{{ $pengaduan->lokasi }}</p>
                                            </div>
                                        </div>
                                    @endif
                                        </div>
                                    </div>

                                    <hr>

                                   

                                    @if($pengaduan->gambar)
                                        <div class="mb-3">
                                            <strong>Gambar/Bukti:</strong>
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/aspirasi/' . $pengaduan->gambar) }}" 
                                                     alt="Gambar Bukti" class="img-fluid rounded" style="max-width: 100%; max-height: 400px;">
                                            </div>
                                        </div>
                                    @endif

                                    @if($pengaduan->feedback)
                                        <div class="mb-3">
                                            <strong><i class="fas fa-comment-dots text-info"></i> Feedback dari Admin:</strong>
                                            <div class="alert alert-info mt-2" role="alert">
                                                <p class="mb-0">{{ $pengaduan->feedback }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($pengaduan->status !== 'Selesai')
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-info">
                                            <i class="fas fa-hourglass-half"></i> Status Pengaduan
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="progress mb-3" style="height: 25px;">
                                            <div class="progress-bar 
                                                @if($pengaduan->status === 'Menunggu') bg-warning
                                                @elseif($pengaduan->status === 'Proses') bg-primary
                                                @elseif($pengaduan->status === 'Selesai') bg-success
                                                @endif" 
                                                role="progressbar" 
                                                @php
                                                    $width = $pengaduan->status === 'Menunggu' ? '33%' : ($pengaduan->status === 'Proses' ? '66%' : '100%');
                                                    $value = $pengaduan->status === 'Menunggu' ? '33' : ($pengaduan->status === 'Proses' ? '66' : '100');
                                                @endphp
                                                style="width: {{ $width }}"
                                                aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100">
                                                <span class="text-white font-weight-bold">
                                                    @if($pengaduan->status === 'Menunggu') 33%
                                                    @elseif($pengaduan->status === 'Proses') 66%
                                                    @elseif($pengaduan->status === 'Selesai') 100%
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="@if($pengaduan->status === 'Menunggu' || $pengaduan->status === 'Proses' || $pengaduan->status === 'Selesai') text-success @else text-muted @endif">
                                                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                                                    <h6><strong>Diterima</strong></h6>
                                                    <p class="small">{{ $pengaduan->created_at->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="@if($pengaduan->status === 'Proses' || $pengaduan->status === 'Selesai') text-success @elseif($pengaduan->status === 'Menunggu') text-warning @else text-muted @endif">
                                                    <i class="fas fa-hourglass-half fa-2x mb-2"></i>
                                                    <h6><strong>Diproses</strong></h6>
                                                    <p class="small">{{ $pengaduan->status === 'Menunggu' ? '-' : $pengaduan->created_at->addDays(1)->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="@if($pengaduan->status === 'Selesai') text-success @else text-muted @endif">
                                                    <i class="fas fa-circle fa-2x mb-2"></i>
                                                    <h6><strong>Selesai</strong></h6>
                                                    <p class="small">{{ $pengaduan->status === 'Selesai' ? $pengaduan->updated_at->format('d/m/Y') : '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-success" role="alert">
                                    <i class="fas fa-check-circle"></i> <strong>Pengaduan ini telah selesai ditangani</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-actions"></i> Aksi
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('siswa.riwayat.index') }}" class="btn btn-secondary btn-block mb-2">
                                        <i class="fas fa-list"></i> Lihat Daftar
                                    </a>
                                    <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary btn-block">
                                        <i class="fas fa-plus"></i> Aspirasi Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.footer')
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
