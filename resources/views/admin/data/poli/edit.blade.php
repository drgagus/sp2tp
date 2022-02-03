@extends ('layouts/admin')

@section('data')
menu-open
@endsection

@section('poli')
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
            <h1 class="m-0 text-dark">Poli/Sub Unit Pelayanan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href={{route('admin.dashboard')}}>Home</a></li>
              <li class="breadcrumb-item active">Poli/Sub Unit Pelayanan</li>
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
                    <h3 class="card-title">Poli/Sub Unit Pelayanan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action={{route('admin.servicesubunit.edit', ['id'=> $poli->id])}} class="" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-lg-12">
                            @if (session('status'))
                                <div class="alert alert-info">
                                {{ session('status') }}
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="form-group">
                                <label for="poli">Poli/Sub Unit Palayanan</label>
                                <input type="text" name="poli" id="poli" class="form-control" value="{{ old('poli') ?? $poli->poli}}" placeholder="--nama poli/sub unit pelayanan--">
                                @error('poli')
                                <div class="text text-danger">poli/sub unit pelayanan harus diisi</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-block btn-warning">SIMPAN</button>
                            </div>
                        </div>
                    </form>
                </div>
                    <!-- /.card-body -->
                <div class="card-footer border-top border-primary">
                        <div class="row">
                            @foreach ($servicesubunits as $servicesubunit)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="btn-group dropright">
                                            <button type="button" class="btn btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$servicesubunit->poli}}</button>
                                            <div class="dropdown-menu p-0">
                                                <a class="dropdown-item bg-warning" href={{route('admin.servicesubunit.edit', ['id' => $servicesubunit->id])}}>Edit</a>
                                                <a class="dropdown-item bg-danger" href="#" data-toggle="modal" data-target="#modal-delete-servicesubunit-{{$servicesubunit->id}}">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <form action={{route('admin.servicesubunit.adduser', ['poli' => $servicesubunit->id])}} class="" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <select class="custom-select" name="user_id">
                                                        @foreach ($users as $user)
                                                        <option value="{{$user->id}}">{{$user->nama}}</option>
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
                                                        @foreach ($servicesubunitusers[$servicesubunit->id] as $servicesubunituser)
                                                        <tr>
                                                            <th><a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-user-{{$servicesubunituser->id}}">hapus</a> {{$servicesubunituser->employe->nama}}</th>
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

<!-- -----START MODAL HAPUS POLI----- -->
@foreach ($servicesubunits as $servicesubunit)
<div class="modal fade" id="modal-delete-servicesubunit-{{$servicesubunit->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">HAPUS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action={{route('admin.servicesubunit.delete', ['id' => $servicesubunit->id])}} class="dropdown-item" method="post">
                  @csrf
                  @method('delete')
                  <p class="">Yakin Ingin Hapus <span class="font-weight-bold">{{$servicesubunit->poli}}</span> ?</p>
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
<!-- -----END MODAL HAPUS POLI----- -->

<!-- -----START MODAL HAPUS USER----- -->
@foreach ($servicesubunits as $servicesubunit)
@foreach ($servicesubunitusers[$servicesubunit->id] as $servicesubunituser)
<div class="modal fade" id="modal-delete-user-{{$servicesubunituser->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">HAPUS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action={{route('admin.servicesubunit.deleteuser', ['poli' => $servicesubunit->id, 'user' => $servicesubunituser->employe_id])}} class="dropdown-item" method="post">
                  @csrf
                  @method('delete')
                  <p class="">Yakin Ingin Hapus <span class="font-weight-bold">{{$servicesubunituser->employe->nama}}</span> dari <span class="font-weight-bold">{{$servicesubunit->poli}}</span> ?</p>

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