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
            <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Kateqoriya</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="category">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title ">Kateqoriya</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="category">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category.create') }}" class="nav-link">Yeni Kateqoriya</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">web apps</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Chat</span>
                </a>
            </li>
    </div>
</nav>
