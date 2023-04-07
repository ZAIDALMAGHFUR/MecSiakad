@extends('layouts.pmb')

@section('content')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="../../css2.css?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
<link href="../../css2-1.css?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
<link href="../../css2-2.css?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flag-icon.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owlcarousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>Dashboard</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item">General</li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
          <div class="col-sm-6">
            <!-- Bookmark Start-->
            <div class="bookmark">
              <ul>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                  <form class="form-inline search-form">
                    <div class="form-group form-control-search">
                      <input type="text" placeholder="Search..">
                    </div>
                  </form>
                </li>
              </ul>
            </div>
            <!-- Bookmark Ends-->
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->

    <div class="row">
        <form action="/save-registration" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
            <div class="col-xl-12">
                <div class="custom-accordion">
                    <div class="card">
                        <a href="#personal-data" class="text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data Pribadi</h5>
                                        <p class="text-muted text-truncate mb-0">NISN, NIK, Nama, Jenis Kelamin, Pas
                                            Photo, TTL, dsb</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="personal-data" class="collapse show">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">NISN</label>
                                            <input type="text" class="form-control" id="personal-data-nisn"
                                                name="nisn" placeholder="Masukkan NISN" value="{{ old('nisn') }}" required>
                                            @error('nisn')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">NIK</label>
                                            <input type="text" class="form-control" id="personal-data-nik" name="nik"
                                                placeholder="Masukkan NIK" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-name">Nama</label>
    
                                            @if ( auth()->user()->username  != null)
                                                <input type="text" class="form-control" id="basicpill" name="username"
                                                    placeholder="Masukkan Nama Lengkap" value="{{ auth()->user()->username }}" required>
                                            @else
                                                <input type="text" class="form-control" id="personal-data-name"
                                                    name="nama" placeholder="Masukkan Nama Lengkap"
                                                    value="{{ old('nama') }}" required>
                                            @endif
                                            @error('nama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Jenis
                                                Kelamin</label>
                                            @if (auth()->user()->jenis_kelamin != null)
                                                @if (auth()->user()->jenis_kelamin == 'Perempuan')
                                                    <select class="form-control wide" name="jk"
                                                        value="{{ old('jk') }}">
                                                        <option value="{{ auth()->user()->jenis_kelamin }}" selected>
                                                            {{ auth()->user()->jenis_kelamin }}</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                    </select>
                                                @else
                                                    <select class="form-control wide" name="jk"
                                                        value="{{ old('jk') }}">
                                                        <option value="{{ auth()->user()->jenis_kelamin }}" selected>
                                                            {{ auth()->user()->jenis_kelamin }}</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                @endif
                                            @else
                                                <select class="form-control wide" name="jk"
                                                    value="{{ old('jk') }}">
                                                    <option value="{{ old('jk') }}" disabled selected>Pilih
                                                        Jenis Kelamin </option>
                                                    <option value="Laki-laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            @endif
    
                                            @error('jk')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data">Agama</label>
                                            <select class="form-control wide" name="agama"
                                                value="{{ old('agama') }}">
                                                <option value="{{ old('agama') }}" disabled selected>Pilih agama
                                                </option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Kong Hu Chu ">Kong Hu Chu</option>
                                                <option value="Lainnya">Etc</option>
                                            </select>
                                            @error('agama')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label">Tempat lahir</label>
                                            @if (auth()->user()->tempat_lahir != null)
                                                <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ auth()->user()->tempat_lahir }}" required>
                                            @else
                                                <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ old('tempatlahir') }}" required>
                                            @endif
                                            @error('tempatlahir')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-4 mb-lg-0">
                                            <label class="form-label" for="billing-city">Tanggal lahir</label>
                                            @if (auth()->user()->tanggal_lahir != null)
                                                <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ auth()->user()->tanggal_lahir }}" required>
                                            @else
                                                <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ old('tanggallahir') }}" required>
                                            @endif
                                            @error('tanggallahir')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <!--<input name="tanggallahir" class="datepicker-default form-control" id="datepicker" >-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-0">
                                            <label class="form-label" for="zip-code">Pas Photo</label>
                                            <div class="input-group">
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="foto" value="{{ old('foto') }}" accept="image/png, image/jpg, image/jpeg" required>
                                                </div>
                                            </div>
                                            @error('foto')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="billing-address">Alamat</label>
    
                                    @if (auth()->user()->alamat != null)
                                        <textarea class="form-control" id="billing-address" rows="3" name="alamat" required
                                            placeholder="Masukkan alamat lengkap">{{ auth()->user()->alamat }}</textarea>
                                    @else
                                        <textarea class="form-control" id="billing-address" rows="3" name="alamat" required
                                            placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                    @endif
                                    @error('alamat')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">Email</label>
                                            <input type="email" class="form-control" id="personal-data-nisn"
                                                name="email" placeholder="Masukkan email"
                                                value="{{ auth()->user()->email }}" required readonly>
                                            @error('email')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">No
                                                Hp/WhatsApp</label>
                                            @if (auth()->user()->no_hp != null)
                                                <input type="number" class="form-control" id="basicpill" name="nohp"
                                                    placeholder="Masukkan Tanggal Lahir" value="{{ auth()->user()->no_hp }}" required>
                                            @else
                                                <input type="number" class="form-control" id="basicpill" name="nohp"
                                                    placeholder="Masukkan nomor telepon" value="{{ old('nohp') }}" required>
                                            @endif
                                            @error('nohp')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#registration-data" class="collapsed text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-truck text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data Pendaftaran</h5>
                                        <p class="text-muted text-truncate mb-0">Pilihan program studi </p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="registration-data" class="collapse">
                            <div class="p-4 border-top">
                                <div class="mb-4">
                                    <label class="form-label" for="billing-address">Gelombang</label>
                                    <select class="form-control wide" name="jadwal_pmbs_id" required>
                                        @foreach ($viewDataJadwal as $x)
                                            <option value="{{ $x->id }}" selected>{{ $x->nama_kegiatan }}</option>
                                        @endforeach
                                    </select>
                                    @error('gelombang')
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Peringatan!</strong>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">Pilihan
                                                1</label>
                                            <input class="form-control" list="datalistOptionsProdi" id="exampleDataList"
                                                placeholder="Pilih program studi" name="pil1"
                                                value="{{ old('pil1') }}" required>
                                            <datalist id="datalistOptionsProdi">
                                                @foreach ($viewProdi as $z)
                                                    <option value="{{ $z->id }}">{{ $z->name }}</option>
                                                @endforeach
                                            </datalist>
                                            @error('pil1')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">Pilihan 2</label>
                                            <input class="form-control" list="datalistOptionsProdi" id="exampleDataList"
                                                placeholder="Pilih program studi" name="pil2"
                                                value="{{ old('pil2') }}" required>
                                            <datalist id="datalistOptionsProdi">
                                                @foreach ($viewProdi as $z)
                                                    <option value="{{ $z->name }}">{{ $z->name }}</option>
                                                @endforeach
                                            </datalist>
                                            @error('pil2')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#parental-data" class="collapsed text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-bill text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data Orang Tua</h5>
                                        <p class="text-muted text-truncate mb-0">Data orang tua, keuangan dan data.
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="parental-data" class="collapse">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-name">Nama
                                                Ayah</label>
                                            <input type="text" class="form-control" id="personal-data-name"
                                                name="ayah" placeholder="Masukkan Nama Ayah"
                                                value="{{ old('ayah') }}" required>
                                            @error('ayah')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Pekerjaan
                                                Ayah</label>
                                            <input class="form-control" list="datalistOptionsOccupation"
                                                id="exampleDataList" placeholder="Masukkan Jenis Pekerjaan..."
                                                name="pekerjaanayah" value="{{ old('pekerjaanayah') }}" required>
                                            <datalist id="datalistOptionsOccupation">
                                                <option value="Karyawan Swasta"></option>
                                                <option value="Karyawan BUMN"></option>
                                                <option value="Karyawan BUMD"></option>
                                                <option value="Karyawan Honorer"></option>
                                                <option value="PNS"></option>
                                                <option value="Wirausaha"></option>
                                                <option value="PNS"></option>
                                                <option value="Buruh"></option>
                                                <option value="Asisten Rumah Tangga"></option>
                                                <option value="Seniman"></option>
                                                <option value="Dokter"></option>
                                                <option value="Perawat"></option>
                                                <option value="Bidan"></option>
                                                <option value="Apoteker"></option>
                                                <option value="Pengajar"></option>
                                                <option value="Notaris"></option>
                                            </datalist>
                                            @error('pekerjaanayah')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">No HP
                                                Ayah</label>
                                            <input type="number" class="form-control" id="personal-data-no"
                                                name="noayah" placeholder="Masukkan Telepon Ayah" required
                                                value="{{ old('noayah') }}">
                                            @error('pekerjaanayah')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-name">Nama Ibu</label>
                                            <input type="text" class="form-control" id="personal-data-name" required
                                                name="ibu" placeholder="Masukkan Nama Ibu"
                                                value="{{ old('ibu') }}">
                                            @error('ibu')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-gender">Pekerjaan
                                                Ibu</label>
                                            <input class="form-control" list="datalistOptionsOccupation"
                                                id="exampleDataList" placeholder="Cari Pekerjaan Ibu.." 
                                                name="pekerjaanibu" value="{{ old('pekerjaanibu') }}" required>
                                            <datalist id="datalistOptionsOccupation">
                                                <option value="Karyawan Swasta"></option>
                                                <option value="Karyawan BUMN"></option>
                                                <option value="Karyawan BUMD"></option>
                                                <option value="Karyawan Honorer"></option>
                                                <option value="PNS"></option>
                                                <option value="Wirausaha"></option>
                                                <option value="PNS"></option>
                                                <option value="Buruh"></option>
                                                <option value="Asisten Rumah Tangga"></option>
                                                <option value="Seniman"></option>
                                                <option value="Dokter"></option>
                                                <option value="Perawat"></option>
                                                <option value="Bidan"></option>
                                                <option value="Apoteker"></option>
                                                <option value="Pengajar"></option>
                                                <option value="Notaris"></option>
                                            </datalist>
                                            @error('pekerjaanibu')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nik">No Telepon
                                                Ibu</label>
                                            <input type="number" class="form-control" id="personal-data-no"
                                                name="noibu" placeholder="Masukkan Telepon Ibu"
                                                value="{{ old('noibu') }}" required>
                                            @error('noibu')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">Penghasilan Ayah</label>
                                            <select class="form-control wide" title="Recipient" name="penghasilan_ayah" required>
                                                <option value="{{ old('penghasilan_ayah') }}" disabled selected>Pilih gaji
                                                </option>
                                                <option value="< 1.0000.000">
                                                    < 1.000.000</option>
                                                <option value="1.000.000 - 2.500.000">1.000.000 -
                                                    2.500.000
                                                </option>
                                                <option value="2.500.000 - 5.000.000">2.500.000 - 5.000.000</option>
                                                <option value="5.000.000 - 7.500.000">5.000.000 - 7.500.000</option>
                                                <option value="7.500.000 - 10.000.000">7.500.000 - 10.000.000
                                                </option>
                                                <option value="> 10.0000.000"> > 10.000.000</option>
                                            </select>
                                            @error('penghasilan_ayah')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">Penghasilan Ibu</label>
                                            <select class="form-control wide" title="Recipient" name="penghasilan_ibu" required>
                                                <option value="{{ old('penghasilan_ibu') }}" disabled selected>Pilih gaji
                                                </option>
                                                <option value="< 1.0000.000">
                                                    < 1.000.000</option>
                                                <option value="1.000.000 - 2.500.000">1.000.000 -
                                                    2.500.000
                                                </option>
                                                <option value="2.500.000 - 5.000.000">2.500.000 - 5.000.000</option>
                                                <option value="5.000.000 - 7.500.000">5.000.000 - 7.500.000</option>
                                                <option value="7.500.000 - 10.000.000">7.500.000 - 10.000.000
                                                </option>
                                                <option value="> 10.0000.000"> > 10.000.000</option>
                                            </select>
                                            @error('penghasilan_ibu')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="personal-data-nisn">Berkas Orang Tua <small>kk,slip gaji</small>
                                            </label>
                                            <div class="input-group">
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="ftberkas_ortu" value="{{ old('ftberkas_ortu') }}" accept="application/pdf" required>
                                                </div>
                                            </div>
                                            @error('ftberkas_ortu')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#school-data" class="collapsed text-dark" data-bs-toggle="collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3"> <i class="uil uil-truck text-primary h2"></i>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Data sekolah asal dan nilai</h5>
                                        <p class="text-muted text-truncate mb-0">Sekolah asal, jurusan, nilai
                                            raport dan ijazah</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i
                                            class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="school-data" class="collapse">
                            <div class="p-4 border-top">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="billing-address">Nama
                                                Sekolah</label>
                                                <input type="text" class="form-control" name="asal_sekolah"
                                                    placeholder="Masukkan Asal Sekolah" value="{{ old('asal_sekolah') }}" required>
                                            @error('sekolah')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label">Semester 1</label>
                                            <input type="number" class="form-control" name="smt1"
                                                placeholder="Masukkan Rata Nilai Semester" value="{{ old('smt1') }}" required>
                                            @error('smt1')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label">Semester 2</label>
                                            <input type="number" class="form-control" name="smt2"
                                                placeholder="Masukkan Rata Nilai Semester" value="{{ old('smt2') }}" required>
                                            @error('smt2')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label">Semester 3</label>
                                            <input type="number" class="form-control" name="smt3"
                                                placeholder="Masukkan Rata Nilai Semester" value="{{ old('smt3') }}" required>
                                            @error('smt3')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label">Semester 4</label>
                                            <input type="number" class="form-control" name="smt4"
                                                placeholder="Masukkan Rata Nilai Semester" value="{{ old('smt4') }}" required>
                                            @error('smt4')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label">Semester 5</label>
                                            <input type="number" class="form-control" name="smt5"
                                                placeholder="Masukkan Rata Nilai Semester" value="{{ old('smt5') }}" required>
                                            @error('smt5')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label">Semester 6 <small><i>*jika ada</i></small></label>
                                            <input type="number" class="form-control" name="smt6" placeholder="Masukkan Rata Nilai Semester" value="{{ old('smt6') }}">
                                            @error('smt5')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="billing-address">Berkas Siswa</label>
                                            <div class="input-group">
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="ftberkas_siswa" value="{{ old('ftberkas_siswa') }}" accept="application/pdf" required>
                                                </div>
                                            </div>
                                            @error('ftberkas_siswa')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 mb-4">
                                            <label class="form-label" for="billing-address">Prestasi <small>(jika
                                                    ada)</small></label>
                                            <div class="input-group">
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="ftprestasi" value="{{ old('ftprestasi') }}" accept="application/pdf" >
                                                </div>
                                            </div>
                                            @error('ftprestasi')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <div class="text-end mt-2 mt-sm-0">
                                <button type="submit" name="add" class="btn btn-primary">Buat Pendaftaran</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
  

  <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/owlcarousel/owl.carousel.js') }}"></script>
  <script src="{{ asset('assets/js/owlcarousel/owl-custom.js') }}"></script>
  <script src="{{ asset('assets/js/landing_sticky.js') }}"></script>
  <script src="{{ asset('assets/js/landing.js') }}"></script>
  <script src="{{ asset('assets/js/jarallax_libs/libs.min.js') }}"></script>
  <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
  <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
  <script src="{{ asset('assets/js/timeline/timeline-v-1/main.js') }}"></script>
  <script src="{{ asset('assets/js/modernizr.js') }}"></script>
@endsection