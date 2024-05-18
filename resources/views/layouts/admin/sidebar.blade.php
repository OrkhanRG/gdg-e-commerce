<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.index') }}" class="sidebar-brand">
            Panel<span>RG</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ Route::is('admin.index') ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Actions</li>
            <li class="nav-item {{ Route::is('admin.category.index') || Route::is('admin.category.create') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="category">
                    <i class="link-icon" data-feather="list"></i>
                    <span class="link-title ">Kateqoriya</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ Route::is('admin.category.index') || Route::is('admin.category.create') ? 'show' : '' }}" id="category">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }}">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category.create') }}" class="nav-link {{ Route::is('admin.category.create') ? 'active' : '' }}">Yeni Kateqoriya</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Route::is('admin.brand.index') || Route::is('admin.brand.create') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#brand" role="button" aria-expanded="false" aria-controls="brand">
                    <i class="link-icon" data-feather="bold"></i>
                    <span class="link-title ">Brendlər</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ Route::is('admin.brand.index') || Route::is('admin.brand.create') ? 'show' : '' }}" id="brand">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.brand.index') }}" class="nav-link {{ Route::is('admin.brand.index') ? 'active' : '' }}">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.brand.create') }}" class="nav-link {{ Route::is('admin.brand.create') ? 'active' : '' }}">Yeni Brend</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ Route::is('admin.product.index') || Route::is('admin.product.create') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#product" role="button" aria-expanded="false" aria-controls="product">
                    <i class="link-icon" data-feather="briefcase"></i>
                    <span class="link-title ">Məhsullar</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ Route::is('admin.product.index') || Route::is('admin.product.create') ? 'show' : '' }}" id="product">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link {{ Route::is('admin.product.index') ? 'active' : '' }}">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.create') }}" class="nav-link {{ Route::is('admin.product.create') ? 'active' : '' }}">Yeni Məhsul</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
