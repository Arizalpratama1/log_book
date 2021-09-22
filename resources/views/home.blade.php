@extends('templates.app')

@section('content')
  @include('templates.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    
      <div class="container-fluid px-3">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="ml-3 mt-3">Log Aktifitas</h1>
          </div>
        </div>
   

      <!-- Default box -->
      <div class="card">
        <div class="card-header">

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" id="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-primary" onclick="window.location.replace('{{ url('/halaman/home') }}?search=' + document.getElementById('table_search').value)"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                @if( isset( $_GET['search']) )
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('id_kategori','kategori', ['search' => $_GET['search']])</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('id_sub_kategori','Sub kategori', ['search' => $_GET['search']])</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('judul','Judul Kegiatan', ['search' => $_GET['search']])</th>
                <th scope="col" class="sortable-link-text text-primary">@sortablelink('deskripsi','Deskripsi Kegiatan', ['search' => $_GET['search']])</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('file','File', ['search' => $_GET['search']])</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('tanggal','Tanggal', ['search' => $_GET['search']])</th>
                <th scope="col" class="sortable-link-text text-primary">@sortablelink ('status','Status', ['search' => $_GET['search']])</th>
                @else
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('id_kategori','kategori')</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('id_sub_kategori','Sub kategori')</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('judul','Judul Kegiatan')</th>
                <th scope="col" class="sortable-link-text text-primary">@sortablelink('deskripsi','Deskripsi Kegiatan')</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('file','File')</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('tanggal','Tanggal')</th>
                <th scope="col" class="sortable-link-text text-primary">@sortablelink ('status','Status')</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @if(count($log)>0)
              @foreach ($log as $l) 
              <tr>
                <td>{{ $l->nama_kategori }}</td>
                <td>{{ $l->nama_sub_kategori }}</td>
                <td>{{ $l->judul }}</td>
                <td>{{ $l->deskripsi }}</td>
                <td>{{ $l->file }}</td>
                <td>{{ $l->tanggal }}</td>
                <td>{{ $l->status }}</td>
              </tr>   
              @endforeach
              @else
              <tr>
                <td colspan="7" class="text-center">Belum Ada Data</td>
              </tr>
              @endif           
            </tbody>
          </table>
          <div class="float-right mr-4 mt-3">
          {!! $log->appends(\Request::except('page'))->render() !!}
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div><!-- /.container-fluid -->
    </section>
@endsection