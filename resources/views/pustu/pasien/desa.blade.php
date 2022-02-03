@extends ('layouts/pustu')

@section('pasien')
menu-open
@endsection

@section('pasiendesa'.$village->id)
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
            <h1 class="m-0 text-dark">Penduduk {{$village->desa}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('pustu.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Penduduk</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover text-nowrap">
                  <thead >
                  <tr>
                      <th class="text-center" scope="col" rowspan="2">No</th>
                      <th class="text-center" scope="col" rowspan="2">NIK</th>
                      <th class="text-center" scope="col" rowspan="2">Nama</th>
                      <th class="text-center" scope="col" colspan="2">Tanggal Lahir</th>
                      <th class="text-center" scope="col" rowspan="2">Alamat</th>
                      <th class="text-center" scope="col" rowspan="2">Pasien</th>
                      <th class="text-center" scope="col" rowspan="2">Nomor<br>Rekam Medis</th>
                    </tr>
                    <tr>
                      <th class="text-center" scope="col">Lk</th>
                      <th class="text-center" scope="col">Pr</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($patients as $index => $patient)
                      <tr>
                        <td>
                          <div class="btn-group dropright">
                              <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $index + $patients->firstItem() }}</button>
                              <div class="dropdown-menu p-0">
                                  <a class="dropdown-item bg-primary" href={{route('pustu.record.create', ['id'=> $patient->id])}}>+kunjungan</a>
                                  <a class="dropdown-item bg-success" href={{route('pustu.patient', ['id'=> $patient->id])}}>Detail</a>
                              </div>
                          </div>
                        </td>
                        <td>{{$patient->nik ?? ''}}</td>
                        <td>{{$patient->nama ?? ''}}</td>
                        <td>{{ $patient->jeniskelamin == "Laki-laki" ? date('d-m-Y', strtotime($patient->tanggallahir)) : ''}}</td>
                        <td>{{ $patient->jeniskelamin == "Perempuan" ? date('d-m-Y', strtotime($patient->tanggallahir)) : ''}}</td>
                        <td>{{$patient->village->desa ?? ''}}</td>
                        <td>
                        @if ($patient->kategoripasien == 1)
                            Pasien BPJS/JKN
                        @elseif ($patient->kategoripasien == 2)
                            Pasien Umum
                        @else
                        @endif
                        </td>
                        <td>{{$patient->norm ?? ''}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-lg-6">
                  Jumlah Penduduk <span class="font-weight-bold">{{$count}}</span>
                  </div>
                  <div class="col-lg-6 text-right">
                  {{$patients->links()}}
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection