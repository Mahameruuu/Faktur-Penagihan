<aside class="left-sidebar mt-5">
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="{{ route('admin.index') }}" class="text-nowrap logo-img"></a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <!-- Dashboard -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        
        <!-- Penjualan -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('penjualan.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-shopping-cart"></i>
            </span>
            <span class="hide-menu">Penjualan</span>
          </a>
        </li>
    </nav>
  </div>
</aside>
