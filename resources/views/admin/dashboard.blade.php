@extends ('layouts/admin')

@section('dashboard')
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
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('admin.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
        @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
       @endif
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>+</h3>
                <p>Penduduk</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href={{route('admin.patient.create')}} class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$countpatient}}</h3>
                <p>Cari Penduduk</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href={{route('admin.patient.search')}} class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($villages as $village)
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$village->patients->count()}}</h3>
                <p>Data Penduduk<br>{{$village->desa}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href={{route('admin.patient.village', ['desa'=> $village->id])}} class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endforeach
        </div>
        <div class="row">
          @foreach ($servicecenters as $servicecenter)
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3></h3>
                <p>Kunjungan<br>{{$servicecenter->tempatpelayanan}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href={{route('admin.record.servicecenter', ['tahun' => (int)date('Y'), 'bulan' => (int)date('m'), 'tempatpelayanan'=>$servicecenter->id])}} class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endforeach 
        </div>
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$bulan[(int)date('m')]}}</h3>
                <p>Rekapitulasi Bulanan</p>
              </div>
              <div class="icon">
                <i class="ion pie-graph"></i>
              </div>
              <a href={{route('admin.month.lb1', ['year' => (int)date('Y'), 'month' => (int)date('m')])}} class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{date('Y')}}</h3>
                <p>Rekapitulasi Tahunan</p>
              </div>
              <div class="icon">
                <i class="ion pie-garph"></i>
              </div>
              <a href={{route('admin.year.lb1', ['year' => (int)date('Y')])}} class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{$bulan[(int)date('m')]}}</h3>
                <p>10 Penyakit Terbesar</p>
              </div>
              <div class="icon">
                <i class="ion pie-graph"></i>
              </div>
              <a href={{route('admin.month.topten', ['year' => (int)date('Y'), 'month' => (int)date('m')])}} class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{date('Y')}}</h3>
                <p>10 Penyakit Terbesar</p>
              </div>
              <div class="icon">
                <i class="ion pie-garph"></i>
              </div>
              <a href={{route('admin.year.topten', ['year' => (int)date('Y')])}} class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
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