@extends('templates.app')

@section('content')
    @include('templates.sidebar')

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Log Aktivitas Dosen</h1>
              </div>
            </div>
          </div>

          <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th style="width:1%">N.I.P</th>
                    <th>Nama Dosen</th>
                    <th style="width:1%">Pending</th>
                    <th style="width:1%">Proses</th>
                    <th style="width:1%">Selesai</th>
                    <th style="width:1%">Detail</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dosen as $dos)
                  <tr>
                    <td>{{ $dos->nip }}</td>
                    <td>{{ $dos->nama_user }}</td>
                    <td class="text-center py-0 align-middle">
                        <a href="/pending/{{ $dos->id }}" class="btn btn-sm btn-danger"><i class="fas fa-info-circle"></i></a>
                    </td>
                    <td class="text-center py-0 align-middle">
                        <a href="/proses/{{ $dos->id }}" class="btn btn-sm btn-warning"><i class="fas fa-info-circle"></i></a>
                    </td>
                    <td class="text-center py-0 align-middle">
                        <a href="/selesai/{{ $dos->id }}" class="btn btn-sm btn-success"><i class="fas fa-info-circle"></i></a>
                    </td>
                    <td class="text-center py-0 align-middle">
                        <a href="/semua/{{ $dos->id }}" class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->        
        </div>
    </section>
    
@endsection