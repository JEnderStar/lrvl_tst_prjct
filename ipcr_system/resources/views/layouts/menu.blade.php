<!-- need to remove -->
<!-- <li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li> -->

<p style="color:white;"> Employee </p>
<li class="nav-item">
    <a href="/employee" class="nav-link {{ Request::is('employee') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>IPCR List</p>
    </a>
</li>

<li class="nav-item">
    <a href="/employee/create" class="nav-link {{ Request::is('employee/create') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Create IPCR Form</p>
    </a>
</li>

<p style="color:white;"> HR </p>
<li class="nav-item">
    <a href="/hr/create" class="nav-link {{ Request::is('hr/create') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Set Schedule for IPCR</p>
    </a>
</li>

<li class="nav-item">
    <a href="/hr" class="nav-link {{ Request::is('hr') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Verify IPCR List</p>
    </a>
</li>