<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - Edit Siswa</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Siswa</h1>
                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
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
                                <i class="fas fa-user-edit"></i> Form Edit Siswa
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.siswa.update', $siswa->nis) }}" class="needs-validation">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label for="nis" class="form-label"><strong>NIS (Nomor Induk Siswa)</strong></label>
                                    <input type="text" class="form-control @error('nis') is-invalid @enderror" 
                                           id="nis" name="nis" placeholder="Contoh: 1200100001 (10 digit)" value="{{ old('nis', $siswa->nis) }}" required>
                                    <small class="form-text text-muted d-block mt-1">NIS harus 10 angka dan unik</small>
                                    <small class="form-text text-muted d-block mt-1">Nomor induk siswa harus unik</small>
                                    @error('nis')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label"><strong>Nama Siswa</strong></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                           id="nama" name="nama" placeholder="Contoh: Budi Santoso" value="{{ old('nama', $siswa->nama) }}">
                                    @error('nama')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kelas" class="form-label"><strong>Kelas</strong></label>
                                    <input type="text" class="form-control @error('kelas') is-invalid @enderror" 
                                           id="kelas" name="kelas" placeholder="Contoh: X A, XI B, XII C" maxlength="20" value="{{ old('kelas', $siswa->kelas) }}" required>
                                    @error('kelas')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="keterangan" class="form-label"><strong>Keterangan</strong></label>
                                    <select class="form-control @error('keterangan') is-invalid @enderror" 
                                            id="keterangan" name="keterangan" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Aktif" {{ old('keterangan', $siswa->keterangan) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Nonaktif" {{ old('keterangan', $siswa->keterangan) === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('keterangan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="username" class="form-label"><strong>Username</strong></label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                           id="username" name="username" placeholder="Username untuk login" value="{{ old('username', $siswa->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label"><strong>Password</strong></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary btn-toggle-password" type="button" title="Tampilkan/ Sembunyikan password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted d-block mt-1">Kosongkan jika tidak ingin mengganti password.</small>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
                            </form>
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
    <script>
        // Toggle password visibility for inputs inside input-group with button.btn-toggle-password
        $(function(){
            $(document).on('click', '.btn-toggle-password', function(e){
                e.preventDefault();
                var $btn = $(this);
                var $input = $btn.closest('.input-group').find('input');
                if ($input.attr('type') === 'password') {
                    $input.attr('type', 'text');
                    $btn.find('i').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    $input.attr('type', 'password');
                    $btn.find('i').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
</body>
</html>
