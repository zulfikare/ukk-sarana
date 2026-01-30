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
</head>
<body id="page-top">
    <div id="wrapper">
        @include('admin.components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.topbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Pengaduan</h1>
                        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
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
                                        <div class="col-md-12">
                                            <strong>Kategori:</strong>
                                            <p><span class="badge badge-info">{{ $pengaduan->kategori->ket_kategori }}</span></p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>Tanggal Dibuat:</strong>
                                            <p>{{ $pengaduan->created_at->format('d/m/Y H:i:s') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Status Saat Ini:</strong>
                                            <p>
                                                @if($pengaduan->status === 'Menunggu')
                                                    <span class="badge badge-warning">Menunggu</span>
                                                @elseif($pengaduan->status === 'Proses')
                                                    <span class="badge badge-info">Proses</span>
                                                @else
                                                    <span class="badge badge-success">Selesai</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <strong>Pelapor:</strong>
                                            <p><strong>{{ $pengaduan->siswa->nama ?? 'N/A' }}</strong> (NIS: {{ $pengaduan->nis }})</p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Lokasi:</strong>
                                            <p>{{ $pengaduan->lokasi ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="mb-3">
                                        <strong>Isi Pengaduan:</strong>
                                        <div class="bg-light p-3 rounded mt-2">
                                            <p>{{ nl2br(e($pengaduan->ket)) }}</p>
                                        </div>
                                    </div>

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
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <strong>Feedback/Catatan:</strong>
                                                <div class="bg-light p-3 rounded mt-2">
                                                    <p>{{ nl2br(e($pengaduan->feedback)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-tasks"></i> Update Status
                                    </h6>
                                </div>
                                <div class="card-body">
                                    @if($pengaduan->status !== 'Selesai')
                                        <form method="POST" action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id_aspirasi) }}" class="mb-4">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group mb-3">
                                                <label for="status" class="form-label"><strong>Ubah Status</strong></label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="{{ $pengaduan->status }}" selected>{{ $pengaduan->status }}</option>
                                                    @if($pengaduan->status !== 'Menunggu')
                                                        <option value="Menunggu">Menunggu</option>
                                                    @endif
                                                    @if($pengaduan->status !== 'Proses')
                                                        <option value="Proses">Proses</option>
                                                    @endif
                                                    @if($pengaduan->status !== 'Selesai')
                                                        <option value="Selesai">Selesai</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-check"></i> Perbarui Status
                                            </button>
                                        </form>
                                    @else
                                        <div class="alert alert-success" role="alert">
                                            <i class="fas fa-check-circle"></i> <strong>Pengaduan ini telah selesai ditangani</strong>
                                        </div>
                                    @endif

                                    <hr class="my-3">

                                    <h6 class="font-weight-bold text-primary mb-3">
                                        <i class="fas fa-comment-dots"></i> Feedback/Catatan
                                    </h6>
                                    <form method="POST" action="{{ route('admin.pengaduan.update', $pengaduan->id_aspirasi) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id_kategori" value="{{ $pengaduan->id_kategori }}">
                                        <input type="hidden" name="status" value="{{ $pengaduan->status }}">
                                        <div class="form-group">
                                            <textarea class="form-control @error('feedback') is-invalid @enderror" 
                                                      id="feedback" name="feedback" rows="4" 
                                                      placeholder="Berikan feedback atau catatan untuk pengaduan ini...">{{ old('feedback', $pengaduan->feedback) }}</textarea>
                                            <small class="form-text text-muted d-block mt-2">Feedback akan ditampilkan kepada pelapor</small>
                                            @error('feedback')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-save"></i> Simpan Feedback
                                        </button>
                                    </form>
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
