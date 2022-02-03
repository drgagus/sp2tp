@extends ('layouts/admin')

@section('tambahpasien')
active
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Penduduk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('admin.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Data Penduduk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-dark border border-dark">
              <div class="card-header">
                    <h3 class="card-title">Data Penduduk</h3>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="alert alert-info">
                        {{ session('status') }}
                      </div>
                    </div>
                  </div>
                @endif
                <form action={{route('admin.patient.create')}} class="" method="post">
                @csrf
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="nik">Nomor NIK</label>
                      <input type="text" class="form-control" id="nik" name="nik" placeholder="--nomor NIK--">
                      @error('nik')
                        <div class="text text-danger">nomor NIK harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="--nama lengkap--">
                      @error('nama')
                        <div class="text text-danger">nama lengkap harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="Laki-laki" {{ old('jeniskelamin')  === "Laki-laki" ? 'checked':'' }} value="Laki-laki">
                            <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="Perempuan" {{ old('jeniskelamin')  === "Perempuan" ? 'checked':'' }} value="Perempuan">
                            <label class="form-check-label" for="Perempuan">Perempuan</label>
                        </div>
                          @error('jeniskelamin')
                            <div class="text text-danger">jenis kelamin harus dipilih</div>
                          @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggallahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggallahir" id="tanggallahir" placeholder="--tanggal lahir--" value="{{old('tanggallahir') ?? ''}}">
                      @error('tanggallahir')
                            <div class="text text-danger">tanggal lahir harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="village_id">Alamat</label>
                      <select class="form-control" id="village_id" name="village_id">
                        <option value="">--alamat--</option>
                      @foreach ($villages as $village)
                        <option value="{{$village->id}}" class="">{{$village->desa}}</option>
                      @endforeach
                      </select>
                      @error('village_id')
                        <div class="text text-danger">alamat harus dipilih</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="norm">Nomor Rekam Medis</label>
                      <input type="text" class="form-control" id="norm" name="norm" placeholder="--nomor rekam medis--">
                      @error('norm')
                        <div class="text text-danger">nomor rekam medis harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="kategoripasien">Pasien</label>
                      <select class="form-control" id="kategoripasien" name="kategoripasien">
                        <option value="">--pasien--</option>
                        <option value="1">BPJS/JKN</option>
                        <option value="2">UMUM</option>
                      </select>
                      @error('kategoripasien')
                        <div class="text text-danger">harus dipilih</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nojkn">Nomor BPJS/JKN</label>
                      <input type="text" class="form-control" id="nojkn" name="nojkn" placeholder="--nomor BPJS/JKN--">
                      @error('nojkn')
                        <div class="text text-danger">nomor JKN lengkap harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" type="text" name="catatan" id="catatan" rows="5">{{ old('catatan') ?? ''}}</textarea>
                        @error('catatan')
                          <div class="text text-danger">catatan harus diisi</div>
                        @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer border-top border-primary p-0">
                <button type="submit" class="btn btn-block btn-primary">SIMPAN</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection