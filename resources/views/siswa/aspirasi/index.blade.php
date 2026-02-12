<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - Input Aspirasi</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Input Aspirasi</h1>
                        <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Aspirasi
                        </a>
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
                            <i class="fas fa-info-circle"></i> Anda belum memiliki aspirasi dalam proses. 
                            <a href="{{ route('siswa.aspirasi.create') }}" class="alert-link">Buat aspirasi baru</a>
                        </div>
                    @else
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-list"></i> Daftar Aspirasi Dalam Proses
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th style="width: 20%">Kategori</th>
                                                <th style="width: 30%">Isi Aspirasi</th>
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
                                                        @if($pengaduan->status === 'Menunggu')
                                                            <span class="badge badge-warning">Menunggu</span>
                                                        @elseif($pengaduan->status === 'Proses')
                                                            <span class="badge badge-info">Proses</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ $pengaduan->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center" style="gap: 15px;">
                                                            <a href="{{ route('siswa.riwayat.show', $pengaduan->id_aspirasi) }}" 
                                                               class="btn btn-sm btn-info" title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('siswa.aspirasi.edit', $pengaduan->id_aspirasi) }}" 
                                                               class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('siswa.aspirasi.destroy', $pengaduan->id_aspirasi) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
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
