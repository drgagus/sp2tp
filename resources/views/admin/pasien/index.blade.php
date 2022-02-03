@extends ('layouts/admin')

@section('caripasien')
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
            <h1 class="m-0 text-dark">Cari Penduduk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('admin.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Cari Penduduk</li>
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
          <div class="col-lg-12">
            <div class="card card-dark border border-dark">
              <div class="card-header">
                    <h3 class="card-title">Cari Penduduk</h3>
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
                <form action={{route('admin.patient.search')}} class="" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="--nama lengkap--">
                    </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label for="nik">Nomor NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="--nomor NIK--">
                    </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label for="village_id">Alamat</label>
                        <select class="form-control" id="village_id" name="desa">
                            <option value="">--alamat--</option>
                        @foreach ($villages as $village)
                            <option value="{{$village->id}}" class="">{{$village->desa}}</option>
                        @endforeach
                        </select>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 text-right">
                    <button type="submit" class="btn btn-block btn-primary">CARI</button>
                </div>
              </div>
              <div class="card-footer border-top border-primary">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead >
                                <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">NIK</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Umur</th>
                                <th class="text-center" scope="col">Jenis<br>Kelamin</th>
                                <th class="text-center" scope="col">Alamat</th>
                                <th class="text-center" scope="col">Pasien</th>
                                <th class="text-center" scope="col">Nomor<br>Rekam Medis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $index => $patient)
                                <tr>
                                    <td>
                                    <div class="btn-group dropright">
                                        <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $index + $patients->firstItem() }}</button>
                                        <div class="dropdown-menu p-0">
                                            <a class="dropdown-item bg-warning" href={{route('admin.patient.edit', ['id'=> $patient->id])}}>Edit</a>
                                            <a class="dropdown-item bg-success" href={{route('admin.patient', ['id'=> $patient->id])}}>Detail</a>
                                            <a class="dropdown-item bg-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{$patient->id}}">Hapus</a>
                                        </div>
                                    </div>
                                    </td>
                                    <td>{{$patient->nik ?? ''}}</td>
                                    <td>{{$patient->nama ?? ''}}</td>
                                    <td>{{$patient->tanggallahir ?? ''}}</td>
                                    <td>{{$patient->jeniskelamin ?? ''}}</td>
                                    <td>{{$patient->village->desa ?? ''}}</td>
                                    <td>
                                    @if ($patient->kategoripasien == 1)
                                        Pasien BPJS/JKN
                                    @else
                                        Pasien Umum
                                    @endif
                                    </td>
                                    <td>{{$patient->norm ?? ''}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                                                
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-lg-6">
                        {{$patients->links()}}
                    </div>
                </div>
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
@foreach($patients as $patient)
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
@endforeach
<!-- -----END MODAL DELETE PASIEN----- -->
@endsection