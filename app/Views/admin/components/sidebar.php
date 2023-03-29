<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="#" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <?php
                $urls = [
                  '/admin/dashboard',
                ];
                $admin_buttons_addon = '';
                foreach($urls as $url){
                  if(strpos(current_url(), $url) !== false){
                    $admin_buttons_addon = 'active';
                  }
                }
              ?>
            <li class="nav-item">
              <?php
                $admin_buttons_addon = '';
                if(strpos(current_url(), '/admin/dashboard/user'))
                  $admin_buttons_addon = 'bg-dark active'
              ?>
              <a href="/admin/dashboard/user" class="nav-link <?= esc($admin_buttons_addon) ?>">
                <i class="nav-icon fa fa-users"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
            <?php
                $urls = [
                  '/admin/dashboard/item',
                ];
                $admin_buttons_addon = '';
                foreach($urls as $url){
                  if(strpos(current_url(), $url) !== false){
                    $admin_buttons_addon = 'active';
                  }
                }
              ?>
            <li class="nav-item">
              <?php
                $admin_buttons_addon = '';
                if(strpos(current_url(), '/admin/dashboard/item'))
                  $admin_buttons_addon = 'bg-dark active'
              ?>
              <a href="/admin/dashboard/item" class="nav-link <?= esc($admin_buttons_addon) ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Items
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/logout" class="nav-link">
                <i class="nav-icon fa fa-sign-out"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>