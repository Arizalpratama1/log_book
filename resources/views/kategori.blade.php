@extends('templates.app ')

@section('content')
    @include('templates.sidebar')
    
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Data Kategori</h1>
              </div>
              <div class="col-sm-6">
                <button type="button" class="btn float-right side sides" data-toggle="modal" data-target="#tambahkategori">
                  <span class="fas fa-plus"></span> Tambah Kategori
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
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Kategori</th>
                    <th style="width:1%"><i class="yellow fas fa-edit" ></i></th>
                    <th style="width:1%"><i class="red fas fa-trash-alt"></i></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach( $kategori as $kat )
                  <tr>
                      <td>{{ $kat->nama_kategori }}</td>
                      <td class="text-left py-0 align-middle">
                          <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editKategori" onclick="$.modalEdit( {{ $kat->id }}, '{{ $kat->nama_kategori }}' );"><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center py-0 align-middle">
                          <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusKategori" onclick="$.modalHapus( {{ $kat->id }}, '{{ $kat->nama_kategori }}' );"><i class="fas fa-trash"></i></a>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <!-- /.Tambah -->
          <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="TambahModalLabel">Tambah Kategori</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/halaman/kategori/simpan" method="POST">  
                  {{ csrf_field() }}
                  <div class="modal-body">      
                    <div class="form-group">
                      <label>Kategori</label>
                      <input type="Text" class="form-control" name="nama_kategori" placeholder="Masukkan Nama Kategori">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn float-right side sides">Simpan Data</button>
                  </div>
                </form>
              </div>
            </div>        
          </div>

          <!-- /.Edit -->
          <div class="modal fade" id="editKategori" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="EditModalLabel">Edit Kategori</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/halaman/kategori/edit" method="POST">  
                  {{ csrf_field() }}
                  <div class="modal-body">      
                    <div class="form-group">
                      <label>Kategori</label>
                      <input type="hidden" name="id_kategori">
                      <input type="Text" class="form-control" name="nama_kategori" placeholder="Masukkan Nama Kategori">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn float-right side sides">Simpan Data</button>
                  </div>
                </form>
              </div>
            </div>        
          </div>

          <!-- /.Hapus -->
          <div class="modal fade" id="hapusKategori" tabindex="-1" aria-labelledby="HapusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="HapusModalLabel">Hapus Kategori</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/halaman/kategori/hapus" method="POST">  
                  {{ csrf_field() }}
                  <div class="modal-body">      
                      <input type="hidden" name="id_kategori">
                      Apakah anda yakin akan menghapus kategori <b id="hapus_nama_kategori"></b>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </div>
                </form>
              </div>
            </div>        
          </div>
    </section>

    <script>
        $(document).ready( function(){
            $.modalEdit = function( id, namaKategori ){
                $('#editKategori').find('input[name=id_kategori]').val( id );
                $('#editKategori').find('input[name=nama_kategori]').val( namaKategori );
            }

            $.modalHapus = function( id, namaKategori ){
                $('#hapusKategori').find('input[name=id_kategori]').val( id );
                $('#hapusKategori').find('#hapus_nama_kategori').html( namaKategori );
            }
        });
    </script>
@endsection