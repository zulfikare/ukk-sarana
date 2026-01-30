<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - Edit Aspirasi</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Aspirasi/Keluhan</h1>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi Kesalahan!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-pen-alt"></i> Form Edit Aspirasi
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('siswa.aspirasi.update', $pengaduan->id_aspirasi) }}" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label for="id_kategori" class="form-label"><strong>Kategori Aspek</strong></label>
                                    <select class="form-control @error('id_kategori') is-invalid @enderror" id="id_kategori" name="id_kategori" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id_kategori }}" @selected(old('id_kategori', $pengaduan->id_kategori) == $kategori->id_kategori)>
                                                {{ $kategori->ket_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="lokasi" class="form-label"><strong>Lokasi/Tempat</strong></label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" name="lokasi" placeholder="Tempat kejadian aspirasi/keluhan..." value="{{ old('lokasi', $pengaduan->lokasi) }}">
                                    <small class="form-text text-muted d-block mt-1">Lokasi terkait aspirasi/keluhan (opsional)</small>
                                    @error('lokasi')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="ket" class="form-label"><strong>Isi Aspirasi/Keluhan</strong></label>
                                    <textarea class="form-control @error('ket') is-invalid @enderror" 
                                              id="ket" name="ket" rows="6" 
                                              placeholder="Jelaskan aspirasi atau keluhan Anda secara detail..." required>{{ old('ket', $pengaduan->ket) }}</textarea>
                                    <small class="form-text text-muted d-block mt-1">Maksimal 50 karakter</small>
                                    @error('ket')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="gambar" class="form-label"><strong>Gambar/Bukti</strong></label>
                                    @if($pengaduan->gambar)
                                        <div class="mb-2">
                                            <small class="text-muted">Gambar saat ini:</small>
                                            <div class="mt-1">
                                                <img src="{{ asset('storage/aspirasi/' . $pengaduan->gambar) }}" alt="Gambar" class="img-fluid" style="max-width: 200px;">
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                           id="gambar" name="gambar" accept="image/jpeg,image/png,image/gif,image/webp">
                                    <small class="form-text text-muted d-block mt-1">Format: JPG, PNG, GIF, WebP (Maks 5MB) - Opsional. Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                    @error('gambar')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('siswa.riwayat.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
                            </form>
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
