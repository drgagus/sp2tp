@extends ('layouts/admin')

@section('data')
menu-open
@endsection

@section('diagnosa')
active
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-dark border border-dark">
                    <div class="card-header">
                        <h3 class="card-title">Diagnosa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div id="daftarDiagnosa"></div>
                    </div>
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