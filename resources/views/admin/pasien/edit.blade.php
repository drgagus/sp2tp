@extends ('layouts/admin')

@section('pasien')
menu-open
@endsection

@section('pasiendesa'.$patient->village_id)
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
                  <div class="btn-group dropright">
                      <button type="button" class="btn btn-outline-dark text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$patient->nama}}</button>
                      <div class="dropdown-menu p-0">
                          <a class="dropdown-item bg-success" href={{route('admin.patient', ['id'=> $patient->id])}}>Detail</a>
                          <a class="dropdown-item bg-warning" href={{route('admin.patient.edit', ['id'=> $patient->id])}}>Edit</a>
                          <a class="dropdown-item bg-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{$patient->id}}">Hapus</a>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                <form action={{route('admin.patient.edit', ['id'=>$patient->id])}} class="" method="post">
                @csrf
                @method('patch')
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="nik">Nomor NIK</label>
                      <input type="text" class="form-control" id="nik" name="nik" placeholder="--nomor NIK--" value="{{old('nik') ?? $patient->nik}}">
                      @error('nik')
                        <div class="text text-danger">nomor NIK harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="--nama lengkap--" value="{{old('nama') ?? $patient->nama}}">
                      @error('nama')
                        <div class="text text-danger">nama lengkap harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="Laki-laki" {{ old('jeniskelamin') ?? $patient->jeniskelamin  === "Laki-laki" ? 'checked':'' }} value="Laki-laki">
                            <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="Perempuan" {{ old('jeniskelamin') ?? $patient->jeniskelamin  === "Perempuan" ? 'checked':'' }} value="Perempuan">
                            <label class="form-check-label" for="Perempuan">Perempuan</label>
                        </div>
                          @error('jeniskelamin')
                            <div class="text text-danger">jenis kelamin harus dipilih</div>
                          @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggallahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggallahir" id="tanggallahir" placeholder="--tanggal lahir--" value="{{old('tanggallahir') ?? $patient->tanggallahir}}">
                      @error('tanggallahir')
                            <div class="text text-danger">tanggal lahir harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="village_id">Alamat</label>
                      <select class="form-control" id="village_id" name="village_id">
                        <option value="">--alamat--</option>
                      @foreach ($villages as $village)
                        <option {{ old('village_id') ?? $patient->village_id  === $village->id ? 'selected':'' }} value="{{$village->id}}" class="">{{$village->desa}}</option>
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
                      <input type="text" class="form-control" id="norm" name="norm" placeholder="--nomor rekam medis--" value="{{old('norm') ?? $patient->norm}}">
                      @error('norm')
                        <div class="text text-danger">nomor rekam medis harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="kategoripasien">Pasien</label>
                      <select class="form-control" id="kategoripasien" name="kategoripasien">
                        <option value="">--pasien--</option>
                        <option {{ old('kategoripasien') ?? $patient->kategoripasien  === "1" ? 'selected':'' }} value="1">BPJS/JKN</option>
                        <option {{ old('kategoripasien') ?? $patient->kategoripasien  === "2" ? 'selected':'' }} value="2">UMUM</option>
                      </select>
                      @error('kategoripasien')
                        <div class="text text-danger">harus dipilih</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nojkn">Nomor BPJS/JKN</label>
                      <input type="text" class="form-control" id="nojkn" name="nojkn" placeholder="--nomor BPJS/JKN--" value="{{old('nojkn') ?? $patient->nojkn}}">
                      @error('nojkn')
                        <div class="text text-danger">nomor JKN lengkap harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" type="text" name="catatan" id="catatan" rows="5">{{ old('catatan') ?? $patient->catatan}}</textarea>
                        @error('catatan')
                          <div class="text text-danger">catatan harus diisi</div>
                        @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer border-top border-primary p-0">
                <button type="submit" class="btn btn-block btn-warning">SIMPAN</button>
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

<!-- -----START MODAL DELETE PASIEN----- -->
<div class="modal fade" id="modal-delete-{{$patient->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">HAPUS DATA PENDUDUK</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action={{route('admin.patient.delete', ['id' => $patient->id])}} class="dropdown-item" method="post">
                  @csrf
                  @method('delete')
                  Yakin Ingin Hapus "<b>{{$patient->nama ?? ''}}</b>" ?
            </div>
            <div class="modal-footer text-right">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-primary">Ya</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- -----END MODAL DELETE PASIEN----- -->
@endsection