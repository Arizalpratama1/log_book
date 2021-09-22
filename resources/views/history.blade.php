@extends('templates.app')

@section('content')
    @include('templates.sidebar')

  <div class="content-wrapper">
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1>History Log Aktivitas</h1>
          </div>
          <div class="col-sm-9 mt-5">
            <form form action="/filter/{{$id_status}}" method="POST">
            <input type="hidden" name="id_dosen" value="{{ $id_dosen}}">
            {{ csrf_field() }}
              <div class="form-group row">
                <label for="date" class="col-form-label col-sm-2">tanggal awal</label>
                <div class="col-sm-3">
                  <div class="input-group date" id="fromDate" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="fromDate" data-target="#fromDate" data-toggle="datetimepicker" readonly/>
                      <div class="input-group-append" data-target="#fromDate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <label for="date" class="col-form-label col-sm-2">tanggal akhir</label>
                <div class="col-sm-3">
                  <div class="input-group date" id="toDate" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="toDate" data-target="#toDate" data-toggle="datetimepicker" readonly/>
                      <div class="input-group-append" data-target="#toDate" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <button type="submit" class="btn float-right side sides">
                    <span class="fas fa-search"></span> Filter Data
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    
    <section class="content">
      <div class="card">
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th >Kategori</th>
                <th >Sub kategori</th>
                <th >Catatan</th>
                <th >Tanggal</th>
                <th >Status</th>
              </tr>
            </thead>
            <tbody>
              @if(count($log) > 0 )
              @foreach ($log as $l)
              <tr>
                <td>{{ $l->kategori->nama_kategori }}</td>
                <td>{{ $l->sub_kategori->nama_sub_kategori }}</td>
                <td>{{ $l->judul }}</td>
                <td>{{ $l->tanggal }}</td>
                <td>{{ $l->status->status }}</td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="7" class="text-center"> Belum Ada Data</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

    <div class="col-sm-12">
      <a href="{{ url('/download') }}/{{ $id_dosen }}/{{ $id_status }}" >
      <button type="button" class="btn float-right mt-1 side sides">
        <span class="fa fa-download"></span> Download File Excel
      </button></a>
    </div>
  </section>
@endsection