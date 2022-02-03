@extends ('layouts/pustu')

@section('kunjungan1')
menu-open
@endsection

@section('kunjungan2'.(int)date('Y', strtotime($record->tanggalkunjungan)))
menu-open
@endsection

@section('kunjungan3'.(int)date('Y', strtotime($record->tanggalkunjungan)).(int)date('m', strtotime($record->tanggalkunjungan)))
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
            <h1 class="m-0 text-dark">Edit Kunjungan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('pustu.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Edit Kunjungan</li>
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
                          <a class="dropdown-item bg-success" href={{route('pustu.patient', ['id'=> $patient->id])}}>data penduduk</a>
                      </div>
                  </div>
              </div>
              <div class="card-header bg-light p-0 border-bottom border-dark">
                  <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nama
                                <span class="btn btn-outline-primary rounded">{{$patient->nama}}</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Umur
                                <span class="btn btn-outline-primary rounded">{{$record->umurtahun}} Tahun {{$record->umurbulan}} Bulan {{$record->umurhari}} Hari</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Jenis Kelamin
                                <span class="btn btn-outline-primary rounded">{{$patient->jeniskelamin}}</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Alamat
                                <span class="btn btn-outline-primary rounded">{{$patient->village->desa}}</span>
                              </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group">
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nomor NIK
                                <span class="btn btn-outline-primary rounded">{{$patient->nik ?? '-'}}</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nomor Rekam Medis
                                <span class="btn btn-outline-primary rounded">{{$patient->norm ?? '-'}}</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Pasien
                                <span class="btn btn-outline-primary rounded">{{$patient->kategoripasien ?? '-'}}</span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nomor BPJS/JKN
                                <span class="btn btn-outline-primary rounded">{{$patient->nojkn ?? '-'}}</span>
                              </li>
                            </ul>
                        </div>
                  </div>
              </div>
              <div class="card-body">
                <form action={{route('pustu.record.edit', ['id'=>$record->id])}} class="" method="post">
                @csrf
                @method('patch')
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="tanggalkunjungan">Tanggal Kunjungan</label>
                      <input type="date" class="form-control" id="tanggalkunjungan" name="tanggalkunjungan" placeholder="--tanggal kunjungan--" value="{{old('tanggalkunjungan') ?? $record->tanggalkunjungan}}">
                      @error('tanggalkunjungan')
                        <div class="text text-danger">tanggal kunjungan harus diisi</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label>Pasien</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pasien" id="Baru" {{ old('pasien') ?? $record->pasien  === "Baru" ? 'checked':'' }} value="Baru">
                            <label class="form-check-label" for="Baru">Baru</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pasien" id="Lama" {{ old('pasien') ?? $record->pasien  === "Lama" ? 'checked':'' }} value="Lama">
                            <label class="form-check-label" for="Lama">Lama</label>
                        </div>
                          @error('pasien')
                            <div class="text text-danger">lama/baru harus dipilih</div>
                          @enderror
                    </div>
                    <div class="form-group">
                      <label for="diag_id">Diagnosa</label>
                      <select class="form-control select2bs4" id="diag_id" name="diag_id">
                        <option value="">--diagnosa--</option>
                      @foreach ($diags as $diag)
                        <option {{ old('diag_id')  ?? $record->diag_id == $diag->id ? 'selected':'' }} value="{{$diag->id}}" class="">{{$diag->kode}} {{$diag->diagnosa}}</option>
                      @endforeach
                      </select>
                      @error('diag_id')
                        <div class="text text-danger">diagnosa harus dipilih</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" type="text" name="catatan" id="catatan" rows="5">{{ old('catatan') ?? $record->catatan}}</textarea>
                        @error('catatan')
                          <div class="text text-danger">catatan harus diisi</div>
                        @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer border-top border-warning p-0">
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
@endsection