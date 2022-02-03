@extends ('layouts/puskesmas')

@section('setting')
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
            <h1 class="m-0 text-dark">Pengaturan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('puskesmas.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Pengaturan</li>
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
          <div class="col-lg-4">
              <div class="card card-dark">
                  <div class="card-header">
                      <h3 class="card-title">Ganti Password</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" method="post" action={{route('puskesmas.password')}} >
                  @csrf
                  @method('patch')
                  <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12">
                          @if (session('password'))
                            <div class="alert alert-info">
                              {{ session('password') }}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="input-group mt-3">
                                <input type="password" name="old_password" class="form-control" placeholder="--password lama--">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                              </div>
                              @error('old_password')
                                <div class="text text-danger">{{$message}}</div>
                              @enderror
                              <div class="input-group mt-3">
                                <input type="password" name="new_password" class="form-control" placeholder="--password baru--">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                              </div>
                              @error('new_password')
                                <div class="text text-danger">{{$message}}</div>
                              @enderror
                              <div class="input-group mt-3">
                                <input type="password" name="new_password_confirmation" class="form-control" placeholder="--retype password baru--">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                              </div>
                              @error('password_confirmation')
                                <div class="text text-danger">{{$message}}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">Ubah</button>
                  </div>
                  </form>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card card-secondary">
                  <div class="card-header">
                      <h3 class="card-title">Ganti Username</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" method="post" action={{route('puskesmas.username')}} >
                  @csrf
                  @method('patch')
                  <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12">
                          @if (session('username'))
                            <div class="alert alert-info">
                              {{ session('username') }}
                            </div>
                          @endif
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="input-group mt-3">
                                <input type="text" name="username" class="form-control" value="{{old('username')}}" placeholder="--username baru--">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                    </div>
                                </div>
                              </div>
                              @error('username')
                                <div class="text text-danger">{{$message}}</div>
                              @enderror
                              <div class="input-group mt-3">
                                <input type="password" name="password" class="form-control" placeholder="--password--">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                              </div>
                              @error('password')
                                <div class="text text-danger">{{$message}}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">Ubah</button>
                  </div>
                  </form>
              </div>
          </div>
          
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection