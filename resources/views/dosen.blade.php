@extends('templates.app ')

@section('content')
    @include('templates.sidebar')
    
  <div class="content-wrapper">
  
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Dosen</h1>
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahdosen">
              <span class="fas fa-plus"></span> Tambah Data Dosen
            </button>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
          </div>
        </div>
      </div>

      <div class="card">
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>N.I.P</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Password</th>
                <th style="width:1%;">Edit</th>
                <th style="width:1%;">Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dosen as $dos)
              <tr>
                <td>{{ $dos->nip}}</td>
                <td>{{ $dos->nama_dosen}}</td>
                <td>{{ $dos->email}}</td>
                <td>{{ $dos->password}}</td>
                <td class="text-left py-0 align-middle">
                <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editDosen" onclick="$.modalEdit( {{ $dos->id }},'{{ $dos->nip}}','{{ $dos->nama_dosen }}','{{ $dos->email}}','{{ $dos->password}}' );"><i class="fas fa-edit"></i></a>
              </td>
              <td class="text-center py-0 align-middle">
                  <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#hapusDosen" onclick="$.modalHapus( {{ $dos->id }},'{{ $dos->nama_dosen }}' );"><i class="fas fa-trash"></i></a>
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

      <!-- /.container-fluid -->
      <div class="modal fade" id="tambahdosen" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="TambahModalLabel">Tambah Data Dosen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/halaman/dosen/simpan" method="POST">
              {{ csrf_field() }}
              <div class="modal-body">        
                <div class="form-group">
                  <label>N.I.P</label>
                  <input type="text" class="form-control" name="nip" placeholder="Masukkan N.I.P">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama_dosen" placeholder="Masukkan Nama">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Masukkan Alamat Email">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
              </div>
            </form>
          </div>
        </div>        
      </div>

      <!-- /.Edit -->
      <div class="modal fade" id="editDosen" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="EditModalLabel">Edit Data Dosen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/halaman/dosen/edit" method="POST">  
              {{ csrf_field() }}
              <div class="modal-body">      
                <div class="form-group">
                  <label>N.I.P</label>
                  <input type="hidden" name="id_dosen">
                  <input type="text" class="form-control" name="nip" placeholder="Masukkan N.I.P">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama_dosen" placeholder="Masukkan Nama">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Masukkan Alamat Email">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Masukkan N.I.P">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
              </div>
            </form>
          </div>
        </div>        
      </div>

      <!-- /.Hapus -->
      <div class="modal fade" id="hapusDosen" tabindex="-1" aria-labelledby="HapusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="HapusModalLabel">Hapus Data Dosen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/halaman/dosen/hapus" method="POST">  
              {{ csrf_field() }}
              <div class="modal-body">      
                  <input type="hidden" name="id_dosen">
                  Apakah anda yakin akan menghapus Data <b id="hapus_data_dosen"></b>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Hapus</button>
              </div>
            </form>
          </div>
        </div>        
      </div>
    </section>

  <script>
    $(document).ready( function(){
      $.modalEdit = function( id, nip, namaDosen, email, password )
      {
        $('#editDosen').find('input[name=id_dosen]').val( id );
        $('#editDosen').find('input[name=nip]').val( nip );
        $('#editDosen').find('input[name=nama_dosen]').val( namaDosen );
        $('#editDosen').find('input[name=email]').val( email );
        $('#editDosen').find('input[name=password]').val( password );
      }

      $.modalHapus = function( id, namaDosen )
      {
        $('#hapusDosen').find('input[name=id_dosen]').val( id );
        $('#hapusDosen').find('#hapus_data_dosen').html( namaDosen );
      }
    });
  </script>
@endsection