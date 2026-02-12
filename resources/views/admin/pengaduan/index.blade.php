<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - Data Pengaduan</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Data Pengaduan</h1>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-filter"></i> Filter
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.pengaduan.index') }}" class="row g-3 align-items-end mb-4">
                                <div class="col-md-3">
                                    <label for="nis" class="form-label small"><strong>Siswa</strong></label>
                                    <select name="nis" id="nis" class="form-control form-control-sm">
                                        <option value="">Semua Siswa</option>
                                        @foreach($siswas as $siswa)
                                            <option value="{{ $siswa->nis }}" @selected(request('nis') == $siswa->nis)>
                                                {{ $siswa->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="id_kategori" class="form-label small"><strong>Kategori</strong></label>
                                    <select name="id_kategori" id="id_kategori" class="form-control form-control-sm">
                                        <option value="">Semua Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id_kategori }}" @selected(request('id_kategori') == $kategori->id_kategori)>
                                                {{ $kategori->ket_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="tanggal" class="form-label small"><strong>Tanggal</strong></label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="bulan" class="form-label small"><strong>Bulan</strong></label>
                                    @php
                                        \Carbon\Carbon::setLocale('id');
                                        $start = \Carbon\Carbon::now()->startOfYear();
                                    @endphp
                                    <select name="bulan" id="bulan" class="form-control form-control-sm">
                                        <option value="">-- Pilih Bulan --</option>
                                        @for ($i = 0; $i < 12; $i++)
                                            @php $m = $start->copy()->addMonths($i); @endphp
                                            <option value="{{ $m->format('Y-m') }}" @selected(request('bulan') == $m->format('Y-m'))>
                                                {{ ucfirst($m->monthName) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="status" class="form-label small"><strong>Status</strong></label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="">Semua Status</option>
                                        <option value="Menunggu" @selected(request('status') == 'Menunggu')>Menunggu</option>
                                        <option value="Proses" @selected(request('status') == 'Proses')>Proses</option>
                                        <option value="Selesai" @selected(request('status') == 'Selesai')>Selesai</option>
                                    </select>
                                </div>

                                <div class="col-md-12 d-flex gap-2 mt-3">
                                    <button type="submit" class="btn btn-primary btn-sm mx-3">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-redo"></i> Reset
                                    </a>
                                </div>
                            </form>

                            <div class="alert alert-info" role="alert">
                                <small>Menampilkan <strong>{{ $pengaduans->count() }}</strong> pengaduan</small>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-table"></i> Daftar Pengaduan
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 3%">No</th>
                                            <th style="width: 15%">Pelapor</th>
                                            <th style="width: 25%">Deskripsi</th>
                                            <th style="width: 14%">Kategori</th>
                                            <th style="width: 12%">Tanggal</th>
                                            <th style="width: 10%">Status</th>
                                            <th style="width: 15%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pengaduans as $key => $pengaduan)
                                            <tr>
                                                <td class="text-center">{{ ($pengaduans->currentPage() - 1) * $pengaduans->perPage() + $key + 1 }}</td>
                                                <td><strong>{{ $pengaduan->siswa->nama ?? 'N/A' }}</strong></td>
                                                <td>{{ mb_strimwidth($pengaduan->ket ?? '', 0, 50, '...') }}</td>
                                                <td><span class="badge badge-info">{{ $pengaduan->kategori->ket_kategori }}</span></td>
                                                <td>{{ $pengaduan->created_at->format('d/m/Y') }}</td>
                                                <td class="text-center">
                                                    @if($pengaduan->status === 'Menunggu')
                                                        <span class="badge badge-warning">Menunggu</span>
                                                    @elseif($pengaduan->status === 'Proses')
                                                        <span class="badge badge-info">Proses</span>
                                                    @else
                                                        <span class="badge badge-success">Selesai</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.pengaduan.show', $pengaduan->id_aspirasi) }}" class="btn btn-sm btn-info" title="Lihat">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
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
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $pengaduans->links() }}
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
