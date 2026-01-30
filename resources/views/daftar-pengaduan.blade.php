<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }} - Daftar Pengaduan</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <x-sidebar />
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
                        <h1 class="h3 mb-0 text-gray-800">Daftar Pengaduan</h1>
                        <a href="{{ route('pengaduan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Pengaduan</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-primary">
                                    <h6 class="m-0 font-weight-bold text-white">
                                        <i class="fas fa-filter"></i> Filter Pengaduan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="{{ route('daftar-pengaduan') }}" class="form-inline">
                                        <div class="row w-100">
                                            <div class="col-md-3 mb-3">
                                                <label for="id_kategori" class="mr-2">Kategori:</label>
                                                <select class="form-control form-control-sm" id="id_kategori" name="id_kategori">
                                                    <option value="">-- Semua --</option>
                                                    @foreach($kategoris as $kategori)
                                                        <option value="{{ $kategori->id_kategori }}" {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                                            {{ $kategori->ket_kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="status" class="mr-2">Status:</label>
                                                <select class="form-control form-control-sm" id="status" name="status">
                                                    <option value="">-- Semua --</option>
                                                    <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-search"></i> Filter
                                                </button>
                                                <a href="{{ route('daftar-pengaduan') }}" class="btn btn-sm btn-secondary ml-2">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-primary">
                                    <h6 class="m-0 font-weight-bold text-white">
                                        <i class="fas fa-list"></i> Daftar Pengaduan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 5%;">No</th>
                                                    <th style="width: 12%;">ID</th>
                                                    <th style="width: 20%;">Kategori</th>
                                                    <th style="width: 15%;">Status</th>
                                                    <th style="width: 18%;">Tanggal</th>
                                                    <th style="width: 30%;" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($pengaduans as $key => $pengaduan)
                                                <tr>
                                                    <td class="text-center font-weight-bold">{{ ($pengaduans->currentPage() - 1) * $pengaduans->perPage() + $key + 1 }}</td>
                                                    <td><span class="badge badge-secondary">{{ $pengaduan->id_aspirasi }}</span></td>
                                                    <td>{{ $pengaduan->kategori->ket_kategori }}</td>
                                                    <td class="text-center">
                                                        @if($pengaduan->status == 'Selesai')
                                                            <span class="badge badge-success">{{ $pengaduan->status }}</span>
                                                        @elseif($pengaduan->status == 'Proses')
                                                            <span class="badge badge-info">{{ $pengaduan->status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $pengaduan->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $pengaduan->created_at->format('d/m/Y H:i') }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pengaduan.show', $pengaduan->id_aspirasi) }}" class="btn btn-sm btn-info" title="Lihat">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('pengaduan.edit', $pengaduan->id_aspirasi) }}" class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if($pengaduan->status != 'Selesai')
                                                            <form action="{{ route('pengaduan.update', $pengaduan->id_aspirasi) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="Selesai">
                                                                <button type="submit" class="btn btn-sm btn-success" title="Selesai" onclick="return confirm('Tandai sebagai selesai?')">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted py-4">
                                                        <i class="fas fa-inbox"></i> Belum ada data pengaduan
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    @if($pengaduans->hasPages())
                                        <div class="d-flex justify-content-center mt-4">
                                            {{ $pengaduans->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('sbadmin2/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sbadmin2/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('sbadmin2/js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>