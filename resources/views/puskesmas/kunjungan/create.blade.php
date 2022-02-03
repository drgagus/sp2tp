@extends ('layouts/puskesmas')

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
            <h1 class="m-0 text-dark">+Kunjungan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('puskesmas.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">+Kunjungan</li>
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
                          <a class="dropdown-item bg-success" href={{route('puskesmas.patient', ['id'=> $patient->id])}}>data penduduk</a>
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
                                <span class="btn btn-outline-primary rounded">{{$usia['tahun']." Tahun ".$usia['bulan']." Bulan ".$usia['hari']." Hari"}}</span>
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
                <div id="createRecord" endpoint={{route('puskesmas.record.create', ['id' => $patient->id])}}></div>
              </div>
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