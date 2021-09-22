@extends('templates.app')

@section('content')

  @include('templates.sidebar')

    <div class="content-wrapper">
    
       <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Data Sub Kategori</h1>
              </div>
              <div class="col-sm-6">
                <button type="button" class="btn float-right side sides" data-toggle="modal" data-target="#tambahSubkategori">
                  <span class="fas fa-plus"></span> Tambah Sub Kategori
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
                          <a href="#" class="btn btn-sm btn-warning disabled" ><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center py-0 align-middle">
                          <a href="#" class="btn btn-sm btn-danger disabled" ><i class="fas fa-trash"></i></a>
                      </td>
                  </tr>
                    @foreach( $subkategori->where('id_kategori', $kat->id) as $subkat )
                    <tr>
                        <td> &emsp; - {{ $subkat->nama_sub_kategori }}</td>
                        <td class="text-left py-0 align-middle">
                            <a href="#" class="btn btn-sm btn-warning " data-toggle="modal" data-target="#editSubkategori" onclick="$.modalEdit( {{ $kat->id }},{{$subkat->id}}, '{{ $subkat->nama_sub_kategori }}');" ><i class="fas fa-edit"></i></a>
                        </td>
                        <td class="text-center py-0 align-middle">
                            <a href="#" class="btn btn-sm btn-danger " data-toggle="modal" data-target="#hapusSubkategori" onclick="$.modalHapus( {{$subkat->id}}, '{{ $subkat->nama_sub_kategori }}');"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

          <!-- /.Tambah -->
          <div class="modal fade" id="tambahSubkategori" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="TambahModalLabel">Tambah Sub Kategori</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/halaman/subkategori/simpan" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Kategori</label>
                      <select class="form-control select2" style="width: 100%;" name="id_kategori">
                        @foreach ($kategori as $kat)
                          <option value="{{$kat->id}}">{{$kat->nama_kategori}}</option>
                        @endforeach 
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Sub Kategori</label>
                      <input type="text" class="form-control" name="nama_sub_kategori" placeholder="Masukkan Sub Kategori">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn side sides">Simpan Data</button>
                  </div>
                </form>
              </div>
            </div>          
          </div>

          <!-- /.Edit -->
          <div class="modal fade" id="editSubkategori" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="TambahModalLabel">Edit Kategori</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/halaman/subkategori/edit" method="POST">
                  {{ csrf_field() }}
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Kategori</label>
                      <select class="form-control select2 " style="width: 100%;" name="id_kategori">
                      </select>
                      <label>Sub Kategori</label>
                      <input type="hidden" name="id_subkategori">
                      <input type="text" class="form-control" name="nama_sub_kategori" placeholder="Masukkan Sub Kategori">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn side sides">Simpan Data</button>
                  </div>
                </form>
              </div>
            </div>          
          </div>

          <!-- /.Hapus -->
          <div class="modal fade" id="hapusSubkategori" tabindex="-1" aria-labelledby="HapusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="HapusModalLabel">Hapus Sub Kategori</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/halaman/subkategori/hapus" method="POST">  
                  {{ csrf_field() }}
                  <div class="modal-body">      
                      <input type="hidden" name="id_subkategori">
                      Apakah anda yakin akan menghapus Sub Kategori <b id="hapus_sub_kategori"></b>
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
      $.modalEdit = function( idParent,id, namaSubkategori ){
        var kategori = '<?= json_encode( $kategori ) ?>';
        kategori = JSON.parse( kategori );
        var kategoriOption = '';

        $.each( kategori, function(key){
          kategoriOption += '<option value="' + kategori[key].id + '" ' + ( kategori[key].id === idParent ? 'selected' : '' ) + '>' + kategori[key].nama_kategori + '</option>';
        });

        $('select[name=id_kategori]').html( kategoriOption );
        $('#editSubkategori').find('input[name=id_subkategori]').val( id );
        $('#editSubkategori').find('input[name=nama_sub_kategori]').val( namaSubkategori );
      }

      $.modalHapus = function( id, namaSubkategori){
        $('#hapusSubkategori').find('input[name=id_subkategori]').val(id);
        $('#hapusSubkategori').find('#hapus_sub_kategori').html(namaSubkategori);
      }
    });
  </script>
@endsection