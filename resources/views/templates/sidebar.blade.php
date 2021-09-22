<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 side">
    
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-1 pb-2 mb-1 d-flex">
      <div class="image">
        <img src="{{ asset('/adminlte/img/Logo-ITATS.png')}}">
      </div>
        <div class="info mt-2">
          <a href="#" class="d-block">{{ Session::get('user')->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if( Session::get('user')->role == 0 )
        
        @foreach( $kategori_sidebar as $kat_sidebar )
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              {{ $kat_sidebar->nama_kategori }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          @foreach( $subkategori_sidebar->where('id_kategori', '=', $kat_sidebar->id) as $subkat_sidebar )
            <li class="nav-item">
              <a href="/list-aktifitas/{{ $kat_sidebar->id }}/{{ $subkat_sidebar->id }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ $subkat_sidebar->nama_sub_kategori }}</p>
              </a>
            </li>
          @endforeach
          </ul>
        </li>
        @endforeach
      
        <li class="nav-header">Menu</li>
        <li class="nav-item">
          <a href="/halaman/subkategori" class="nav-link">
            <i class="far fa-plus-square nav-icon"></i>
            <p>Tambah Sub Kategori</p>
          </a>
        </li>

        @endif
<!--         
        <li class="nav-item">
          <a href="/halaman/dosen" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>Data Dosen</p>
          </a>
        </li> -->
        
        @if( Session::get('user')->role == 1 )
        <li class="nav-header">Menu</li>
        <li class="nav-item">
          <a href="{{ url('/halaman/kategori') }}" class="nav-link">
            <i class="far fa-plus-square nav-icon"></i>
            <p>Tambah Kategori</p>
          </a>
        </li>

        @endif

        @if ( Session::get('user')->role == 2)
        <li class="nav-header">Menu</li>
        <li class="nav-item">
          <a href="{{ url('/logdosen') }}" class="nav-link">
            <i class="fas fa-book nav-icon"></i>
            <p>Log Aktivitas Dosen</p>
          </a>
        </li>
        @endif


        <li class="nav-item">
          <a href="{{ url('/logout') }}" class="nav-link">
            <i class="fas fa-sign-in-alt"></i>
            <p>Log Out</p>
          </a>
        </li>
      </li>
      </ul>
    </nav>
  </div>
</aside>