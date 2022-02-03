@extends ('layouts/puskesmas')

@section('kunjungan1')
menu-open
@endsection

@section('kunjungan2'.$year)
menu-open
@endsection

@section('kunjungan3'.$year.$month)
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
            <h1 class="m-0 text-dark">Kunjungan {{Auth::user()->servicecenteruser->servicecenter->tempatpelayanan}}<br>Bulan {{$bulan[$month]}} Tahun {{$year}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('puskesmas.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Kunjungan</li>
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
              @if (session('status'))
              <div class="card-header">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="alert alert-info">
                        {{ session('status') }}
                      </div>
                    </div>
                  </div>
              </div>
              @endif
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover text-nowrap">
                  <thead >
                    <tr>
                      <th class="text-center" scope="col" rowspan="2">No</th>
                      <th class="text-center" scope="col" rowspan="2">Tanggal<br>Kunjungan</th>
                      <th class="text-center" scope="col" rowspan="2">Nama</th>
                      <th class="text-center" scope="col" colspan="2">Umur</th>
                      <th class="text-center" scope="col" rowspan="2">Poli</th>
                      <th class="text-center" scope="col" colspan="2">Pasien</th>
                      <th class="text-center" scope="col" colspan="2">Diagnosa</th>
                      <th class="text-center" scope="col" rowspan="2">Dokter</th>
                    </tr>
                    <tr>
                      <th class="text-center" scope="col" >Lk</th>
                      <th class="text-center" scope="col" >Pr</th>
                      <th class="text-center" scope="col" >Baru</th>
                      <th class="text-center" scope="col" >Lama</th>
                      <th class="text-center" scope="col" >Kode</th>
                      <th class="text-center" scope="col" >Diagnosa</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($records as $index => $record)
                      <tr>
                        <td>
                          <div class="btn-group dropright">
                              <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $index + $records->firstItem() }}</button>
                              <div class="dropdown-menu p-0">
                                  <a class="dropdown-item bg-warning" href={{route('puskesmas.record.edit', ['id'=> $record->id])}}>Edit</a>
                                  <a class="dropdown-item bg-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{$record->id}}">Hapus</a>
                              </div>
                          </div>
                        </td>
                        <td class="">{{date('d-m-Y',strtotime($record->tanggalkunjungan)) ?? ''}}</td>
                        <td class="">{{$record->patient->nama ?? ''}}</td>
                        <td class="">{{$record->patient->jeniskelamin == 'Laki-laki' ? $record->umurtahun.' Tahun' : ''}}</td>
                        <td class="">{{$record->patient->jeniskelamin == 'Perempuan' ? $record->umurtahun.' Tahun' : ''}}</td>
                        <td class="">{{$record->servicesubunit->poli ?? ''}}</td>
                        <td class="text-center">{!! $record->pasien == 'Baru' ? '&#10003' : '' !!}</td>
                        <td class="text-center">{!! $record->pasien == 'Lama' ? '&#10003' : '' !!}</td>
                        <td class="">{{$record->diag->kode ?? ''}}</td>
                        <td class="">{{$record->diag->diagnosa ?? ''}}</td>
                        <td class="">{{$record->employe->nama ?? ''}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              <div class="row justify-content-beetwen">
                  <div class="col-lg-6 mb-2">
                  Jumlah Kunjungan <span class="font-weight-bold">{{($total)}}</span>
                  </div>
                  <div class="col-lg-6 text-right">
                  {{$records->links()}}
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

<!-- -----START MODAL DELETE KUNJUNGAN----- -->
@foreach($records as $record)
<div class="modal fade" id="modal-delete-{{$record->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">HAPUS KUNJUNGAN</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action={{route('puskesmas.record.delete', ['id' => $record->id])}} class="dropdown-item" method="post">
                  @csrf
                  @method('delete')
                  <div class="row">
                    <div class="col-lg-12">
                      <table class="">
                        <tr class="">
                          <td class="">Tanggal kunjungan</td>
                          <td class="">:</td>
                          <td class="">{{date('d-m-Y', strtotime($record->tanggalkunjungan))}}</td>
                        </tr>
                        <tr class="">
                          <td class="">Nama</td>
                          <td class="">:</td>
                          <td class="">{{$record->patient->nama}}</td>
                        </tr>
                        <tr class="">
                          <td class="">Diagnosa</td>
                          <td class="">:</td>
                          <td class="">{{$record->diag->diagnosa}}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
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
<!-- -----END MODAL DELETE KUNJUNGAN----- -->
@endsection