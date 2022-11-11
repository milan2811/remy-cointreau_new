<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo e(route('dashboard')); ?>" class="brand-link">
    <img src="<?php echo e(asset('public/images/logo_rounded.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-white"
         style="opacity: .8">
    <span class="brand-text font-weight-light">RÉMY COINTREAU</span>
  </a>

  <?php
    $user = auth()->user();
  ?>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo e($user->profile_image ? asset('/public/images/users/' . $user->profile_image) : asset('public/images/avatar.png')); ?>"
             class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="d-block"><?php echo e($user->name); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        



        <li class="nav-item">
          <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->is('*dashboard') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Tablero de mandos</p>
          </a>
        </li>

        
        <?php if($user->role_id <= 3): ?>
          <li class="nav-item <?php echo e(request()->is('*bars*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('bars.index')); ?>" class="nav-link <?php echo e(request()->is('*bars*') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-glass-cheers"></i>
              <p>
                Bares / Restaurantes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('bars.index')); ?>" class="nav-link <?php echo e(request()->is('*bars') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Todos los bares</p>
                </a>
              </li>
              <?php if($user->role_id <= 2): ?>
                <li class="nav-item">
                  <a href="<?php echo e(route('bars.create')); ?>" class="nav-link <?php echo e(request()->is('*bars/create*') ? 'active' : ''); ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Agregar barra</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>
        
        
        <?php if($user->role_id <= 2): ?>

          <li class="nav-item <?php echo e(request()->is('*category*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('category.index')); ?>" class="nav-link <?php echo e(request()->is('*category*') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categorías
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('category.index')); ?>" class="nav-link <?php echo e(request()->is('*category') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Todas las categorías</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('category.create')); ?>" class="nav-link <?php echo e(request()->is('*category/create*') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar categoría</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php echo e(request()->is('*ingredients*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('ingredients.index')); ?>" class="nav-link <?php echo e(request()->is('*ingredients*') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Ingredientes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('ingredients.index')); ?>" class="nav-link <?php echo e(request()->is('*ingredients') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Todos los ingredientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('ingredients.create')); ?>" class="nav-link <?php echo e(request()->is('*ingredients/create*') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar ingredientes</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php echo e(request()->is('*brands*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('brands.index')); ?>" class="nav-link <?php echo e(request()->is('*brands*') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Marcas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('brands.index')); ?>" class="nav-link <?php echo e(request()->is('*brands') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Todas las marcas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('brands.create')); ?>" class="nav-link <?php echo e(request()->is('*brands/create*') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar marca</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php echo e(request()->is('*users*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(request()->is('*users*') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                UsuariOs
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(request()->is('*users') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Todos los usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('users.create')); ?>" class="nav-link <?php echo e(request()->is('*users/create*') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar usuario</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php echo e(request()->is('*login-activity*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('login-activity.index')); ?>" class="nav-link <?php echo e(request()->is('*login-activity*') ? 'active' : ''); ?>">
              <i class="fas fa-circle nav-icon"></i>
              <p>
                Actividad de inicio de sesión
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('login-activity.index')); ?>" class="nav-link <?php echo e(request()->is('*login-activity') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Actividad de inicio de sesión</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if($user->role_id == 1): ?>
          <li class="nav-item <?php echo e(request()->is('*enquiry*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('enquiry.index')); ?>" class="nav-link <?php echo e(request()->is('*enquiry*') ? 'active' : ''); ?>">
              <i class="fa fa-envelope nav-icon"></i>
              <p>
                Consulta
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('enquiry.index')); ?>" class="nav-link <?php echo e(request()->is('*enquiry') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultas</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>

          <li class="nav-item <?php echo e(request()->is('*request*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('request.index')); ?>" class="nav-link <?php echo e(request()->is('*request*') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-glass-martini-alt"></i>
              <p>
                Solicitud de ingredientes / marca
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('request.index')); ?>" class="nav-link <?php echo e(request()->is('*request') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Solicitud de ingredientes / marca</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php echo e(request()->is('*promotion*') ? 'menu-open' : ''); ?>">
            <a href="<?php echo e(route('promotion.index')); ?>" class="nav-link <?php echo e(request()->is('*promotion*') ? 'active' : ''); ?>">
              <i class="nav-icon fas fa-glass-martini-alt"></i>
              <p>
                Promociones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('promotion.index')); ?>" class="nav-link <?php echo e(request()->is('*promotion') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promociones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('promotion.create')); ?>" class="nav-link <?php echo e(request()->is('*promotion/create') ? 'active' : ''); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear promoción</p>
                </a>
              </li>              
            </ul>
          </li>

        <?php endif; ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<?php /**PATH /home/admin/web/64.4.160.99/public_html/remy-cointreau/resources/views/components/admin-sidebar.blade.php ENDPATH**/ ?>