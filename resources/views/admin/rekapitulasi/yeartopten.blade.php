@extends ('layouts/admin')

@section('rekapitulasitahun1')
menu-open
@endsection

@section('rekapitulasitahun2'.$year)
menu-open
@endsection

@section('rekapitulasitahun3topten'.$year)
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
            <h1 class="m-0 text-dark">10 Penyakit Terbesar Tahun {{$year}}</h1>
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
                      <th class="text-center" scope="col" colspan="2">Diagnosa</th>
                      <th class="text-center" scope="col" rowspan="2">Jumlah</th>
                    </tr>
                    <tr>
                      <th class="text-center" scope="col">Kode</th>
                      <th class="text-center" scope="col">Diagnosa</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($toptens as $index => $topten)
                    <tr>
                      <th class="text-center" scope="col">{{$index+1}}</th>
                      <th class="text-center" scope="col">{{App\Models\Diag::where('id', $topten->diag_id)->first()->kode}}</th>
                      <th class="text-center" scope="col">{{App\Models\Diag::where('id', $topten->diag_id)->first()->diagnosa}}</th>
                      <th class="text-center" scope="col">{{$topten->total}}</th>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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