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
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-group">
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Nama
                            <span class="btn btn-outline-primary rounded">{{$patient->nama}}</span>
                          </li>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tanggal Lahir
                            <span class="btn btn-outline-primary rounded">{{date('d-m-Y', strtotime($patient->tanggallahir))}}</span>
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
                <div class="row">
                    <div class="col-lg-12">
                        <label for="catatan">Catatan</label>
                      <div class="col-lg-12 p-3 border">
                        {{$patient->catatan ?? '-'}}
                      </div>
                    </div>
                </div>
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