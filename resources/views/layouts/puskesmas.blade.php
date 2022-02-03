<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{ asset ('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href={{ asset ('AdminLTE/dist/css/adminlte.min.css') }}>
  <!-- Select2 -->
  <link rel="stylesheet" href={{ asset ('AdminLTE/plugins/select2/css/select2.min.css') }}>
  <link rel="stylesheet" href={{ asset ('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Scripts React UI-->
  <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {{Auth::user()->employe->nama}}
          <i class="fas fa-arrow-alt-circle-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href={{route('puskesmas.dashboard')}} class="dropdown-item">
              <i class="fas fa-tachometer-alt  mr-3"></i>Dashboard
          </a>
          <a href={{route('puskesmas.setting')}} class="dropdown-item">
              <i class="fas fa-user-cog  mr-3"></i>Pengaturan
          </a>
          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-logout">
              <i class="fas fa-sign-out-alt  mr-3"></i>Logout
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="#" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->servicecenteruser->servicecenter->tempatpelayanan}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href={{route('puskesmas.dashboard')}} class="nav-link @yield('dashboard' ?? '')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href={{route('puskesmas.patient.create')}} class="nav-link @yield('tambahpasien' ?? '')">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                +Penduduk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href={{route('puskesmas.patient.index')}} class="nav-link @yield('caripasien' ?? '')">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Cari Penduduk
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview @yield('pasien' ?? '')">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Data Penduduk
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach($villages as $village)
              <li class="nav-item pl-2">
                <a href={{route('puskesmas.patient.village', ['desa' => $village->id])}} class="nav-link @yield('pasiendesa'.$village->id ?? '')">
                  <i class="nav-icon fas fa-circle text-warning"></i>
                  <p>{{$village->desa}}</p>
                </a>
              </li>
              @endforeach
            </ul>
          </li>

          <li class="nav-item has-treeview @yield('kunjungan1' ?? '')">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Kunjungan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @for($t = date('Y'); $t >=  date('Y')-2 ; $t--  )
              <li class="nav-item pl-2 has-treeview @yield('kunjungan2'.$t ?? '')">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-circle text-warning"></i>
                  <p>
                    Tahun {{$t}}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @for($i = 1; $i <=  12 ; $i++  )
                  <li class="nav-item pl-2">
                    <a href={{route('puskesmas.record.yearmonth', ['tahun'=>$t, 'bulan'=>$i])}} class="nav-link @yield('kunjungan3'.$t.$i ?? '')">
                      <i class="nav-icon fas fa-circle text-success"></i>
                      <p>{{ $bulan[$i] }}</p>
                    </a>
                  </li>
                  @endfor
                </ul>
              </li>
              @endfor
            </ul>
          </li>
          <li class="nav-item">
            <a href={{route('puskesmas.diagnosa')}} class="nav-link @yield('diagnosa' ?? '')">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Diagnosa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href={{route('puskesmas.setting')}} class="nav-link @yield('setting')">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>Pengaturan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href={{route('logout')}} class="nav-link" data-toggle="modal" data-target="#modal-logout">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content' ?? '')


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>{{config('app.name')}}</b>
    </div>
    <strong>Copyright &copy; <a href="https://www.drgagus.com" class="text-decoration-none" target=_blank >drg.agus</a> <?= date('Y');?>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- -----START MODAL LOGOUT----- -->
<div class="modal fade" id="modal-logout">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">LOGOUT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action={{route('logout')}} class="dropdown-item" method="post">
                  @csrf
                  Yakin Ingin Keluar?
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-primary">Ya</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- -----END MODAL LOGOUT----- -->

<!-- jQuery -->
<script src={{ asset ('AdminLTE/plugins/jquery/jquery.min.js') }}></script>
<!-- Bootstrap 4 -->
<script src={{ asset ('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<!-- Select2 -->
<script src={{ asset ('AdminLTE/plugins/select2/js/select2.full.min.js') }}></script>
<!-- bs-custom-file-input -->
<script src={{ asset ('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset ('AdminLTE/dist/js/adminlte.js') }}></script>
<!-- AdminLTE for demo purposes -->
<script src={{ asset ('AdminLTE/dist/js/demo.js') }}></script>
<!-- jQuery UI -->
<script src={{ asset ('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}></script>




<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('#select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>

</body>
</html>
