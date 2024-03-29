<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{URL::to('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

   

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{URL::to('dashboard/import')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Import Data</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Perbaikan Data</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data:</h6>
                <a class="collapse-item" href="{{URL::to('dashboard/location')}}">Lokasi</a>
                <a class="collapse-item" href="{{URL::to('dashboard/alience')}}">Aliansi</a>
                <a class="collapse-item" href="{{URL::to('dashboard/pic')}}">PIC Aliansi</a>
                <a class="collapse-item" href="{{URL::to('dashboard/demonstration')}}">Unjuk Rasa</a>
                <a class="collapse-item" href="{{URL::to('dashboard/province')}}">Provinsi & Kota</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{URL::to('dashboard/users')}}">
            <i class="fas fa-user-friends"></i>
            <span>Manajemen User</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>