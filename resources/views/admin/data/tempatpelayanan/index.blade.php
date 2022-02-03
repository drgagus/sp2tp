@extends ('layouts/admin')

@section('data')
menu-open
@endsection

@section('tempatpelayanan')
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
            <h1 class="m-0 text-dark">Tempat Pelayanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('admin.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Tempat Pelayanan</li>
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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-dark border border-dark">
                <div class="card-header">
                    <h3 class="card-title">Tempat Pelayanan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action={{route('admin.servicecenter.create')}} class="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                            @if (session('status'))
                                <div class="alert alert-info">
                                {{ session('status') }}
                                </div>
                            @endif
                            @if (session('gagal'))
                                <div class="alert alert-danger">
                                {{ session('gagal') }}
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tempatpelayanan">Tempat Pelayanan</label>
                                <input type="text" name="tempatpelayanan" id="tempatpelayanan" class="form-control" value="{{ old('tempatpelayanan') ?? ''}}" placeholder="--nama tempat pelayanan--">
                                @error('tempatpelayanan')
                                <div class="text text-danger">tempat pelayanan harus diisi</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">TAMBAH</button>
                            </div>
                        </div>
                    </form>
                </div>
                    <!-- /.card-body -->
                <div class="card-footer border-top border-primary">
                        <div class="row">
                            @foreach ($servicecenters as $servicecenter)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="btn-group dropright">
                                            <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$servicecenter->tempatpelayanan}}</button>
                                            <div class="dropdown-menu p-0">
                                                <a class="dropdown-item bg-warning" href={{route('admin.servicecenter.edit', ['id' => $servicecenter->id])}}>Edit</a>
                                                <a class="dropdown-item bg-danger" href="#" data-toggle="modal" data-target="#modal-delete-servicecenter-{{$servicecenter->id}}">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <form action={{route('admin.servicecenter.adduser', ['tempatpelayanan' => $servicecenter->id])}} class="" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <select class="custom-select" name="user_id">
                                                        @foreach ($users as $user)
                                                        <option value="{{$user->id}}">{{$user->employe->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 text-right">
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-hover text-nowrap">
                                                    <tbody>
                                                        @foreach ($servicecenterusers[$servicecenter->id] as $servicecenteruser)
                                                        <tr>
                                                            <th><a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-user-{{$servicecenter->id}}-{{$servicecenteruser->user_id}}">hapus</a> {{$servicecenteruser->user->employe->nama}}</th>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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

<!-- -----START MODAL HAPUS TEMPAT PELAYANAN----- -->
@foreach ($servicecenters as $servicecenter)
<div class="modal fade" id="modal-delete-servicecenter-{{$servicecenter->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">HAPUS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action={{route('admin.servicecenter.delete', ['id' => $servicecenter->id])}} class="dropdown-item" method="post">
                  @csrf
                  @method('delete')
                  <p class="">Yakin Ingin Hapus <span class="font-weight-bold">{{$servicecenter->tempatpelayanan}}</span> ?</p>
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
@endforeach
<!-- -----END MODAL HAPUS TEMPAT PELAYANAN----- -->

<!-- -----START MODAL HAPUS USER----- -->
@foreach ($servicecenters as $servicecenter)
@foreach ($servicecenterusers[$servicecenter->id] as $servicecenteruser)
<div class="modal fade" id="modal-delete-user-{{$servicecenter->id}}-{{$servicecenteruser->user_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">HAPUS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action={{route('admin.servicecenter.deleteuser', ['tempatpelayanan' => $servicecenter->id, 'user' => $servicecenteruser->user_id])}} class="dropdown-item" method="post">
                  @csrf
                  @method('delete')
                  <p class="">Yakin Ingin Hapus <span class="font-weight-bold">{{$servicecenteruser->user->employe->nama}}</span> dari <span class="font-weight-bold">{{$servicecenter->tempatpelayanan}}</span> ?</p>

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
@endforeach
@endforeach
<!-- -----END MODAL HAPUS USER----- -->
@endsection