@extends ('layouts/admin')

@section('kunjungan1')
menu-open
@endsection

@section('kunjungan2'.$year)
menu-open
@endsection

@section('kunjungan3'.$year.$month)
menu-open
@endsection

@section('kunjungan4'.$year.$month.$servicecenter->id)
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
            <h1 class="m-0 text-dark">Kunjungan Bulan {{$bulan[$month]}} Tahun {{$year}}<br>{{$servicecenter->tempatpelayanan}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('admin.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Rekapitulasi</li>
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
                      <th class="text-center" scope="col" rowspan="2">Tanggal<br>Kunjungan</th>
                      <th class="text-center" scope="col" rowspan="2">Nama</th>
                      <th class="text-center" scope="col" colspan="2">Umur</th>
                      @if ($servicecenter->id == 1)
                      <th class="text-center" scope="col" rowspan="2">Poli</th>
                      @else
                      @endif
                      <th class="text-center" scope="col" colspan="2">Pasien</th>
                      <th class="text-center" scope="col" colspan="2">Diagnosa</th>
                    </tr>
                    <tr>
                      <th class="text-center" scope="col">Lk</th>
                      <th class="text-center" scope="col">Pr</th>
                      <th class="text-center" scope="col">Baru</th>
                      <th class="text-center" scope="col">Lama</th>
                      <th class="text-center" scope="col">Kode</th>
                      <th class="text-center" scope="col">Diagnosa</th>
                      <th class="text-center" scope="col">Dokter</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($records as $index => $record)
                      <tr>
                        <td>{{ $index + $records->firstItem() }}</td>
                        <td>{{date('d-m-Y',strtotime($record->tanggalkunjungan)) ?? ''}}</td>
                        <td>{{$record->patient->nama ?? ''}}</td>
                        <td class="">{{$record->patient->jeniskelamin == 'Laki-laki' ? $record->umurtahun.' Tahun' : ''}}</td>
                        <td class="">{{$record->patient->jeniskelamin == 'Perempuan' ? $record->umurtahun.' Tahun' : ''}}</td>
                        @if ($servicecenter->id == 1)
                        <td>{{$record->servicesubunit->poli ?? ''}}</td>
                        @else
                        @endif
                        <td class="text-center">{!! $record->pasien == 'Baru' ? '&#10003' : '' !!}</td>
                        <td class="text-center">{!! $record->pasien == 'Lama' ? '&#10003' : '' !!}</td>
                        <td>{{$record->diag->kode ?? ''}}</td>
                        <td>{{$record->diag->diagnosa ?? ''}}</td>
                        <td>{{$record->employe->nama ?? ''}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <div class="row justify-content-beetwen">
                  <div class="col-lg-6">
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
@endsection