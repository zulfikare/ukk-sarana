<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - Riwayat Pengaduan</title>
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        @include('siswa.components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.topbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Riwayat Pengaduan Selesai</h1>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($pengaduans->isEmpty())
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle"></i> Anda belum memiliki pengaduan yang selesai. 
                            <a href="{{ route('siswa.aspirasi.create') }}" class="alert-link">Lihat aspirasi dalam proses</a>
                        </div>
                    @else
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-list"></i> Daftar Pengaduan Selesai
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th style="width: 20%">Kategori</th>
                                                <th style="width: 30%">Isi Pengaduan</th>
                                                <th style="width: 15%">Tanggal</th>
                                                <th style="width: 15%">Status</th>
                                                <th style="width: 15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pengaduans as $key => $pengaduan)
                                                <tr>
                                                    <td class="text-center">{{ ($pengaduans->currentPage() - 1) * $pengaduans->perPage() + $key + 1 }}</td>
                                                    <td>
                                                        <span class="badge badge-info">{{ $pengaduan->kategori->ket_kategori }}</span>
                                                    </td>
                                                    <td>
                                                        {{ Str::limit($pengaduan->ket, 50) }}
                                                    </td>
                                                    <td>{{ $pengaduan->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <span class="badge badge-success">Selesai</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('siswa.riwayat.show', $pengaduan->id_aspirasi) }}" 
                                                           class="btn btn-sm btn-info" title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    {{ $pengaduans->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
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
