<!-- Brand Logo -->
<a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('images/logo.png') }}" alt="Bite n Bliezz Logo" class="brand-image rounded-circle elevation-3">
    <span class="brand-text font-weight-light">Bite n Bliezz</span>
</a>

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
      <!-- Dashboard Link -->
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>Dashboard</p>
        </a>
      </li>
  
      <!-- Produk Section -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link" data-toggle="collapse" data-target="#produk-menu" aria-expanded="false" aria-controls="produk-menu">
          <i class="nav-icon fas fa-box"></i>
          <p>Produk <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview collapse" id="produk-menu">
          <li class="nav-item">
            <a href="{{ route('produk.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Produk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Kategori</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('vouchers.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Promo</p>
            </a>
          </li>
        </ul>
      </li>
  
      <!-- Transaksi Section -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link" data-toggle="collapse" data-target="#transaksi-menu" aria-expanded="false" aria-controls="transaksi-menu">
          <i class="nav-icon fas fa-shopping-cart"></i>
          <p>Transaksi <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview collapse" id="transaksi-menu">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Data Transaksi</p>
            </a>
          </li>
        </ul>
      </li>
  
      <!-- Data Section -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link" data-toggle="collapse" data-target="#data-menu" aria-expanded="false" aria-controls="data-menu">
          <i class="nav-icon fas fa-folder"></i>
          <p>Data <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview collapse" id="data-menu">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Data Customer</p>
            </a>
          </li>
        </ul>
      </li>

      <!-- Setting Section -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link" data-toggle="collapse" data-target="#setting-menu" aria-expanded="false" aria-controls="setting-menu">
          <i class="nav-icon fas fa-cog"></i>
          <p>Setting <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview collapse" id="setting-menu">
          <li class="nav-item">
            <a href="store-settings" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Pengaturan Toko</p>
            </a>
          </li>
        </ul>
      </li>

      <!-- Laporan Section -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link" data-toggle="collapse" data-target="#laporan-menu" aria-expanded="false" aria-controls="laporan-menu">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>Laporan <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview collapse" id="laporan-menu">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan Penjualan</p>
            </a>
          </li>
        </ul>
      </li>

      <!-- Profil Link -->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user"></i>
          <p>Profil</p>
        </a>
      </li>

      <!-- Sign Out Link -->
      <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Sign Out</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    </ul>
</nav>
  
  <!-- Scripts (Bootstrap & jQuery) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  