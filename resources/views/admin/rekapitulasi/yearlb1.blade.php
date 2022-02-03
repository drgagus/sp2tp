@extends ('layouts/admin')

@section('rekapitulasitahun1')
menu-open
@endsection

@section('rekapitulasitahun2'.$year)
menu-open
@endsection

@section('rekapitulasitahun3lb1'.$year)
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
            <h1 class="m-0 text-dark">Rekapitulasi Tahun {{$year}}</h1>
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
                      <th class="text-center" scope="col" rowspan="4">No</th>
                      <th class="text-center" scope="col" rowspan="2" colspan="2">Diagnosa</th>
                      <th class="text-center" scope="col" colspan="32">Umur</th>
                      <th class="text-center" scope="col" rowspan="2" colspan="4">Jumlah</th>
                    </tr>
                    <tr>      
                      <th class="text-center" scope="col" colspan="4">5-9 Tahun</th>
                      <th class="text-center" scope="col" colspan="4">10-14 Tahun</th>   
                      <th class="text-center" scope="col" colspan="4">15-19 Tahun</th>
                      <th class="text-center" scope="col" colspan="4">20-44 Tahun</th>
                      <th class="text-center" scope="col" colspan="4">45-54 Tahun</th>
                      <th class="text-center" scope="col" colspan="4">55-59 Tahun</th>
                      <th class="text-center" scope="col" colspan="4">60-69 Tahun</th>
                      <th class="text-center" scope="col" colspan="4">>70 Tahun</th>
                    </tr>
                    <tr>      
                      <th class="text-center" scope="col" rowspan="2" >Kode</th>
                      <th class="text-center" scope="col" rowspan="2" >Diagnosa</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Baru</th>
                      <th class="text-center" scope="col" colspan="2" >Lama</th>
                    </tr>
                    <tr>      
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                      <th class="text-center" scope="col" >LK</th>
                      <th class="text-center" scope="col" >PR</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($diags as $diag)
                    <tr class="">
                      <td class="">{{$diag->id}}</td>
                      <td class="">{{$diag->kode ?? ''}}</td>
                      <td class="">{{$diag->diagnosa ?? ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['5-9']['lama']['lk'] != 0 ? $countdiag[$diag->id]['5-9']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['5-9']['lama']['pr'] != 0 ? $countdiag[$diag->id]['5-9']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['5-9']['baru']['lk'] != 0 ? $countdiag[$diag->id]['5-9']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['5-9']['baru']['pr'] != 0 ? $countdiag[$diag->id]['5-9']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['10-14']['lama']['lk'] != 0 ? $countdiag[$diag->id]['10-14']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['10-14']['lama']['pr'] != 0 ? $countdiag[$diag->id]['10-14']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['10-14']['baru']['lk'] != 0 ? $countdiag[$diag->id]['10-14']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['10-14']['baru']['pr'] != 0 ? $countdiag[$diag->id]['10-14']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['15-19']['lama']['lk'] != 0 ? $countdiag[$diag->id]['15-19']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['15-19']['lama']['pr'] != 0 ? $countdiag[$diag->id]['15-19']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['15-19']['baru']['lk'] != 0 ? $countdiag[$diag->id]['15-19']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['15-19']['baru']['pr'] != 0 ? $countdiag[$diag->id]['15-19']['baru'] : ''}}</td>
                      <td class="">{{$countdiag[$diag->id]['20-44']['lama']['lk'] != 0 ? $countdiag[$diag->id]['20-44']['lama']['lk'] : ''}}</td>
                      <td class="">{{$countdiag[$diag->id]['20-44']['lama']['pr'] != 0 ? $countdiag[$diag->id]['20-44']['lama']['pr'] : ''}}</td>
                      <td class="">{{$countdiag[$diag->id]['20-44']['baru']['lk'] != 0 ? $countdiag[$diag->id]['20-44']['baru']['lk'] : ''}}</td>
                      <td class="">{{$countdiag[$diag->id]['20-44']['baru']['pr'] != 0 ? $countdiag[$diag->id]['20-44']['baru']['pr'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['45-54']['lama']['lk'] != 0 ? $countdiag[$diag->id]['45-54']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['45-54']['lama']['pr'] != 0 ? $countdiag[$diag->id]['45-54']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['45-54']['baru']['lk'] != 0 ? $countdiag[$diag->id]['45-54']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['45-54']['baru']['pr'] != 0 ? $countdiag[$diag->id]['45-54']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['55-59']['lama']['lk'] != 0 ? $countdiag[$diag->id]['55-59']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['55-59']['lama']['pr'] != 0 ? $countdiag[$diag->id]['55-59']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['55-59']['baru']['lk'] != 0 ? $countdiag[$diag->id]['55-59']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['55-59']['baru']['pr'] != 0 ? $countdiag[$diag->id]['55-59']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['60-69']['lama']['lk'] != 0 ? $countdiag[$diag->id]['60-69']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['60-69']['lama']['pr'] != 0 ? $countdiag[$diag->id]['60-69']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['60-69']['baru']['lk'] != 0 ? $countdiag[$diag->id]['60-69']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['60-69']['baru']['pr'] != 0 ? $countdiag[$diag->id]['60-69']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['>70']['lama']['lk'] != 0 ? $countdiag[$diag->id]['>70']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['>70']['lama']['pr'] != 0 ? $countdiag[$diag->id]['>70']['lama'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['>70']['baru']['lk'] != 0 ? $countdiag[$diag->id]['>70']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['>70']['baru']['pr'] != 0 ? $countdiag[$diag->id]['>70']['baru'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['lama']['lk'] != 0 ? $countdiag[$diag->id]['lama']['lk'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['lama']['pr'] != 0 ? $countdiag[$diag->id]['lama']['pr'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['baru']['lk'] != 0 ? $countdiag[$diag->id]['baru']['lk'] : ''}}</td>
                      <td class="" scope="col" >{{$countdiag[$diag->id]['baru']['pr'] != 0 ? $countdiag[$diag->id]['baru']['pr'] : ''}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <div class="row justify-content-beetwen">
                  <div class="col-lg-6">
                  Jumlah Kunjungan <span class="font-weight-bold">{{$count}}</span>
                  </div>
                  <div class="col-lg-6 text-right">
                  {{$diags->links()}}
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