<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - Data Siswa</title>
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        @include('admin.components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.topbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                           Data Siswa
                        </h1>
                        <a href="{{ route('admin.siswa.create') }}" class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm"></i> Tambah Siswa
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card shadow">
                        <div class="card-header py-3 bg-primary">
                            <h6 class="m-0 font-weight-bold text-white">
                                <i class="fas fa-table"></i> Daftar Siswa
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 3%">No</th>
                                            <th style="width: 12%">NIS</th>
                                            <th style="width: 20%">Nama</th>
                                            <th style="width: 18%">Kelas</th>
                                            <th style="width: 20%">Keterangan</th>
                                            <th style="width: 17%">Tanggal Dibuat</th>
                                            <th style="width: 10%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($siswas as $key => $siswa)
                                            <tr>
                                                <td class="text-center font-weight-bold">{{ ($siswas->currentPage() - 1) * $siswas->perPage() + $key + 1 }}</td>
                                                <td>
                                                    <span class="badge badge-primary">{{ $siswa->nis }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $siswa->nama ?? '-' }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $siswa->kelas ?? '-' }}</span>
                                                </td>
                                                <td>
                                                    <small>{{ $siswa->keterangan ?? '-' }}</small>
                                                </td>
                                                <td>
                                                    <small>{{ $siswa->created_at->format('d/m/Y H:i') }}</small>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center" style="gap: 15px;">
                                                        <a href="{{ route('admin.siswa.edit', $siswa->nis) }}" class="btn btn-sm btn-warning" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;" title="Edit">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('admin.siswa.destroy', $siswa->nis) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    <i class="fas fa-inbox"></i> Belum ada data siswa
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if($siswas->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $siswas->links() }}
                                </div>
                            @endif
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

