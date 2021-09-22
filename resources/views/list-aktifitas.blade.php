@extends('templates.app')

@section('content')
  @include('templates.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    
      <div class="container-fluid px-3">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="ml-3 mt-3">{{ $namaKategori }} / {{ $namaSubKategori }}</h3>
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn float-right mt-3 side sides" data-toggle="modal" data-target="#tambahData">
              <span class="fas fa-plus"></span> Tambah Catatan
            </button>
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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" id="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
               <button type="submit" class="btn btn-primary" onclick="window.location.replace('{{ url('/list-aktifitas') }}/{{ $idKategori }}/{{ $idSubKategori }}?search=' + document.getElementById('table_search').value)"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover  text-nowrap">
            <thead>
              <tr>
                @if( isset( $_GET['search']) )
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('judul','Judul Kegiatan', ['search' => $_GET['search']])</th>
                <th scope="col" class="sortable-link-text text-primary">@sortablelink('deskripsi','Deskripsi Kegiatan', ['search' => $_GET['search']])</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('file','File', ['search' => $_GET['search']])</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('tanggal','Tanggal', ['search' => $_GET['search']])</th>
                <th scope="col" class="sortable-link-text text-primary">@sortablelink ('status','Status', ['search' => $_GET['search']])</th>
                @else
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('judul','Judul Kegiatan')</th>
                <th scope="col" class="sortable-link-text text-primary">@sortablelink('deskripsi','Deskripsi Kegiatan')</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('file','File')</th>
                <th scpoe="col" class="sortable-link-text text-primary">@sortablelink('tanggal','Tanggal')</th>
                <th scope="col" class="sortable-link-text text-primary">@sortablelink ('status','Status')</th>
                @endif
                <th style="width:1%"><i class="yellow fas fa-edit" ></i></th>
                <th style="width:1%"><i class="red fas fa-trash-alt"></i></th>
              </tr>
            </thead>
            <tbody>
              @if(count($log)>0)
              @foreach ($log as $l) 
              <tr>
                <td>{{ $l->judul }}</td>
                <td>{{ $l->deskripsi }}</td>
                <td>{{ $l->file }}</td>
                <td>{{ $l->tanggal }}</td>
                <td>{{ $l->status->status }}</td>
                <td class="text-left py-0 align-middle">
                  <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editData" onclick="$.modalEdit( {{ $l->id }}, '{{ $l->judul }}', '{{ $l->deskripsi }}', {{ $l->status->id }}  );" {{ ($l->status->id == 3 ? 'disabled' : '') }}><i class="far fa-edit"></i></button>
                </td>
                <td class="text-center py-0 align-middle">
                  <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusData" onclick="$.modalHapus( {{ $l->id }}, '{{$l->judul}}' );" {{ ($l->status->id == 3 ? 'disabled' : '') }}><i class="fas fa-trash"></i></button>
                </td>
              </tr>   
              @endforeach
              @else
              <tr>
                <td colspan="7" class="text-center"> Belum Ada Data</td>
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

     <!-- Modal Tambah Data-->
      <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="TambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="TambahModalLabel">Tambah Catatan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/list-aktifitas/simpan" method="POST">
              {{ csrf_field() }}
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="id_kategori" value="{{ $idKategori }}">
                  <input type="hidden" name="id_sub_kategori" value="{{ $idSubKategori }}">
                  <label>Judul Kegiatan</label>
                  <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul ">
                  <div class="form-group">
                    <label>Deskripsi Kegiatan</label>
                    <textarea class="form-control" rows="3" name="deskripsi" placeholder="Deskripsi...."></textarea>
                  </div>  
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

      <!-- Modal edit Data-->
      <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="EditModalLabel">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/list-aktifitas/edit" method="POST" id="editLog">
              {{ csrf_field() }}
              <div class="modal-body">
                <div class="form-group">
                  <label>Judul Kegiatan</label>
                  <input type="hidden" name="id_log">
                  <input type="Text" class="form-control" name="judul" placeholder="Masukkan Judul ">
                </div>
                <div class="form-group">
                  <label>Deskripsi Kegiatan</label>
                  <textarea class="form-control" rows="3" name="deskripsi" placeholder="Deskripsi...."></textarea>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" style="width: 100%;" name="id_status">
                    @foreach ($status as $sts)
                      <option value="{{$sts->id}}">{{$sts->status}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group d-none" id="api_kategori">
                  <label>Pilih Kategori Dokumen</label>
                  <select class="select2" style="width: 100%;" name="id_kategori_dokumen"></select>
                </div>
                <div class="form-group d-none" id="form_upload">
                  <label>File Bukti Kegiatan</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file max. 2 MB</label>
                    </div>
                  </div>  
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

      <!-- Modal Hapus Data-->
      <div class="modal fade" id="hapusData" tabindex="-1" aria-labelledby="HapusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="HapusModalLabel">Hapus Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/list-aktifitas/hapus" method="POST">  
              {{ csrf_field() }}
              <div class="modal-body">    
                  <input type="hidden" name="id_kategori" value="{{ $idKategori }}">
                  <input type="hidden" name="id_sub_kategori" value="{{ $idSubKategori }}">  
                  <input type="hidden" name="id_log">
                  Apakah anda yakin akan menghapus Data <b id="hapus_judul"></b>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
              </div>
            </form>
          </div>
        </div>        
      </div>
    </div><!-- /.container-fluid -->
    </section>

    <script>
      $(document).ready( function(){
          $.modalEdit = function( id, judulKegiatan, desk, sts ){
              $('#editData').find('input[name=id_log]').val( id );
              $('#editData').find('input[name=judul]').val( judulKegiatan );
              $('#editData').find('textArea[name=deskripsi]').text( desk );
              $('#editData').find('select[name=id_status]').val ( sts ).change();
          }

          $.modalHapus = function( id, judul ){
              $('#hapusData').find('input[name=id_log]').val( id );
              $('#hapusData').find('#hapus_judul').html( judul );
          }

          $('select[name=id_status]').on('change', function(){
            if( $(this).val() == 3 ){
              $('#form_upload, #api_kategori').removeClass('d-none');
              $.getKategoriDokumen();
            }else{
              $('#form_upload, #api_kategori').addClass('d-none');
            }
          });

          $('#editLog').on('submit', function(e){
            if($('select[name=id_status]').val() == 3){
              e.preventDefault();
              let editForm = $(this);
              var form_data = new FormData();
              form_data.append('idKategori', editForm.find('select[name=id_kategori_dokumen]').val());
              form_data.append('namaDokumen', editForm.find('input[name=judul]').val());
              form_data.append('deskripsiDokumen', ( editForm.find('textArea[name=deskripsi]').val() != '' ? editForm.find('textArea[name=deskripsi]').val() : 'Tidak ada deskripsi') );
              form_data.append('fileDokumen', $('input[name=file]')[0].files[0]);
              form_data.append('userId', {!! Session::get('user')->id !!});
              $.ajax({
                  type: 'POST',
                  dataType: 'json',
                  data: form_data,
                  processData: false,
                  contentType: false,
                  url: 'http://localhost/api-itats/api/simpanDokumen',
                  success: function(data) {
                    if( data.status == 'sukses' ){
                      $.ajax({
                        type    : 'POST',
                        data    : {
                          '_token'    : '{{ csrf_token() }}',
                          'judul'     : editForm.find('input[name=judul]').val(),
                          'id_log'    : editForm.find('input[name=id_log]').val(),
                          'id_status' : editForm.find('select[name=id_status]').val(),
                          'deskripsi' : ( editForm.find('textArea[name=deskripsi]').val() != '' ? editForm.find('textArea[name=deskripsi]').val() : 'Tidak ada deskripsi'),
                          'file'      : data.file,
                        },
                        url     : '{{ url("/list-aktifitas/edit") }}',
                        success : function(result) {
                          if(result.status == 'sukses')
                            location.reload();
                        }
                      });
                    }
                  }
              });
            }
          });

          $.getKategoriDokumen = function(){
            $.ajax({
              type    : 'GET',
              url     : 'http://localhost/api-itats/api/kategori',
              success : function(dataOption) {
                let result = JSON.parse(dataOption);
                $('.select2').select2({
                  data  : result.data,
                  theme : 'bootstrap4',
                });
              }
            });
          }
      });
  </script>
@endsection