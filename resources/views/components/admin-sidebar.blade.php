<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('public/images/logo_round.svg') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
        <span class="brand-text font-weight-light">Cocktail Supply.co</span>
    </a>

    @php
        $user = auth()->user();
        $role = roles();
    @endphp
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ $user->profile_image ? asset('/public/images/users/' . $user->profile_image) : asset('public/images/avatar.png') }}"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('users.edit', $user->id) }}" class="d-block">{{ $user->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> --}}

                

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->is('*dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if ($user->role_id == $role["Super Admin"] || $user->role_id == $role["Froztech Admin"])
                
                <li class="nav-item {{ request()->is('*page/edit*') || request()->is('*page/edit*') ? 'menu-open' : '' }}">
                    <a href="{{ route('page.edit', 'home') }}"
                       class="nav-link {{ request()->is('*page/edit*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('page.edit', 'home') }}"
                               class="nav-link {{ request()->is('*page/edit/home') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Homepage</p>
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a href="{{ route('page.edit', 'contact') }}"
                                class="nav-link {{ request()->is('*page/edit/contact*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact page</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('page.edit', 'privacy-policy') }}"
                                class="nav-link {{ request()->is('*page/edit/privacy-policy*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Privacy policy page</p>
                            </a>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ route('page.edit', 'terms-and-conditions') }}"
                                class="nav-link {{ request()->is('*page/edit/terms-and-conditions*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Terms and Conditions page</p>
                            </a>
                        </li>                        
                    </ul>
                </li>
                @endif

                {{-- Only super admin should manage bars --}}
                @if ($user->role_id <= $role['Bar Admin'])
                    <li class="nav-item {{ request()->is('*bars*') || request()->is('*items*') ? 'menu-open' : '' }}">
                        <a href="{{ route('bars.index') }}"
                           class="nav-link {{ request()->is('*bars*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-glass-cheers"></i>
                            <p>
                                Bars / Restaurants
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bars.index') }}"
                                   class="nav-link {{ request()->is('*bars') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Bars / Restaurants</p>
                                </a>
                            </li>
                            @if ($user->role_id < $role['Account Admin'])
                                <li class="nav-item">
                                    <a href="{{ route('bars.create') }}"
                                       class="nav-link {{ request()->is('*bars/create*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Bars / Restaurants</p>
                                    </a>
                                </li>
                            @endif
                            @if ($user->role_id > 5)
                                <li class="nav-item">
                                    <a href="{{ route('items.create') }}?bar={{ auth()->user()->assigned_id }}"
                                       class="nav-link {{ request()->is('*items/create*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        Add items
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{-- Visible to admin and super-admin only --}}
                @if ($user->role_id < $role['Account Admin'])
                    <li class="nav-item {{ request()->is('*admin/drink*') ? 'menu-open' : '' }}">
                        <a href="{{ route('drink.index') }}"
                        class="nav-link {{ request()->is('*admin/drink*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-glass-martini"></i>
                            <p>
                                Drinks
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('drink.index') }}"
                                class="nav-link {{ request()->is('*admin/drink') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All drink</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('drink.create') }}"
                                class="nav-link {{ request()->is('*admin/drink/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add drink</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item {{ request()->is('*admin/category*') ? 'menu-open' : '' }}">
                        <a href="{{ route('category.index') }}"
                           class="nav-link {{ request()->is('*admin/category*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}"
                                   class="nav-link {{ request()->is('*admin/category') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.create') }}"
                                   class="nav-link {{ request()->is('*admin/category/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add category</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{ request()->is('*admin/ingredients*') ? 'menu-open' : '' }}">
                        <a href="{{ route('ingredients.index') }}"
                           class="nav-link {{ request()->is('*admin/ingredients*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-tags"></i>
                            <p>
                                Ingredients
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('ingredients.index') }}"
                                   class="nav-link {{ request()->is('*admin/ingredients') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All ingredients</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('ingredients.create') }}"
                                   class="nav-link {{ request()->is('*admin/ingredients/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add ingredients</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->is('*admin/brands*') ? 'menu-open' : '' }}">
                        <a href="{{ route('brands.index') }}"
                           class="nav-link {{ request()->is('*admin/brands*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-link"></i>
                            <p>
                                Brands
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('brands.index') }}"
                                   class="nav-link {{ request()->is('*admin/brands') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All brands</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brands.create') }}"
                                   class="nav-link {{ request()->is('*admin/brands/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add brands</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->is('*admin/products*') ? 'menu-open' : '' }}">
                        <a href="{{ route('products.index') }}"
                           class="nav-link {{ request()->is('*admin/products*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-tasks"></i>
                            <p>
                                Products w/o brands
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}"
                                   class="nav-link {{ request()->is('*admin/products') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.create') }}"
                                   class="nav-link {{ request()->is('*admin/products/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if ($user->role_id < $role['Bar Admin'])
                    <li class="nav-item {{ request()->is('*users*') ? 'menu-open' : '' }}">
                        <a href="{{ route('users.index') }}"
                           class="nav-link {{ request()->is('*users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}"
                                   class="nav-link {{ request()->is('*users') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}"
                                   class="nav-link {{ request()->is('*users/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add user</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                
                @if ($user->role_id < $role['Account Admin'])
                    @if ($user->role_id == $role['Froztech Admin'])
                        <li class="nav-item {{ request()->is('*login-activity*') ? 'menu-open' : '' }}">
                            <a href="{{ route('login-activity.index') }}"
                            class="nav-link {{ request()->is('*login-activity*') ? 'active' : '' }}">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>
                                    Login activity
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('login-activity.index') }}"
                                    class="nav-link {{ request()->is('*login-activity') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Login activity</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ request()->is('*enquiry*') ? 'menu-open' : '' }}">
                            <a href="{{ route('enquiry.index') }}"
                               class="nav-link {{ request()->is('*enquiry*') ? 'active' : '' }}">
                                <i class="fa fa-envelope nav-icon"></i>
                                <p>
                                    Enquiry
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('enquiry.index') }}"
                                       class="nav-link {{ request()->is('*enquiry') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Enquiry</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item {{ request()->is('*request*') ? 'menu-open' : '' }}">
                        <a href="{{ route('request.index') }}"
                           class="nav-link {{ request()->is('*request*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-glass-martini-alt"></i>
                            <p>
                                Ingredient / Brand Request
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('request.index') }}"
                                   class="nav-link {{ request()->is('*request') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ingredient / Brand Request</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @if ($user->role_id <= $role['Super Admin'])
                        <li class="nav-item {{ request()->is('*region*') ? 'menu-open' : '' }}">
                            <a href="{{ route('region.index') }}"
                               class="nav-link {{ request()->is('*region*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-globe"></i>
                                <p>
                                    Region
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('region.index') }}"
                                       class="nav-link {{ request()->is('*region') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All regions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('region.create') }}"
                                       class="nav-link {{ request()->is('*region/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create region</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                @endif

                <li class="nav-item {{ request()->is('*promotion*') ? 'menu-open' : '' }}">
                    <a href="{{ route('promotion.index') }}"
                       class="nav-link {{ request()->is('*promotion*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-percentage"></i>
                        <p>
                            Promotions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('promotion.index') }}"
                               class="nav-link {{ request()->is('*promotion') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Promotions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('promotion.create') }}"
                               class="nav-link {{ request()->is('*promotion/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create promotions</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->is('*analytics*') ? 'menu-open' : '' }}">
                    <a href="{{ route('analytics.activity') }}"
                       class="nav-link {{ request()->is('*analytics*') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie nav-icon"></i>
                        <p>
                            Analytics
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ route('analytics') }}"
                                class="nav-link {{ request()->is('*analytics') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Analytics</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('analytics.activity') }}"
                               class="nav-link {{ request()->is('*analytics/activity') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Activity</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('analytics.items') }}"
                               class="nav-link {{ request()->is('*analytics/items') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Items</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('analytics.drinks') }}"
                               class="nav-link {{ request()->is('*analytics/drinks') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Drinks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('analytics.category') }}"
                               class="nav-link {{ request()->is('*analytics/category') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('analytics.ingredients') }}"
                               class="nav-link {{ request()->is('*analytics/ingredients') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ingredients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('analytics.brands') }}"
                               class="nav-link {{ request()->is('*analytics/brands') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Liquor Brands</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('analytics.cointreau_brands') }}"
                               class="nav-link {{ request()->routeIs('analytics.cointreau_brands') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Coitreau Brands</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if ($user->role_id < $role['Account Admin'])
                    <li class="nav-item {{ request()->is('bulk.upload') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('bulk.upload') ? 'active' : '' }}">
                            <i class="nav-icon far fa-arrow-alt-circle-right"></i>
                            <p>
                                Bulk upload
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bulk.image.upload') }}" class="nav-link @if (\Request::route()->getName() == 'bulk.image.upload') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Image upload</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('bulk.upload') }}"
                                   class="nav-link @if (\Request::route()->getName() == 'bulk.upload') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bulk upload</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
