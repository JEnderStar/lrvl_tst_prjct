<!-- need to remove -->
<!-- <li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li> -->

@role(['hr', 'admin'])
@role('admin')
<label style="color:white"> HR </label>
@endrole
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
@endrole

@role(['employee', 'admin'])
@role('admin')
<label style="color:white"> Employee </label>
@endrole
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
@endrole

@role(['division_chief', 'admin'])
@role('admin')
<label style="color:white"> Division Chief </label>
@endrole
<li class="nav-item">
    <a href="/approvedc" class="nav-link {{ Request::is('approvedc') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>IPCR Approvals</p>
    </a>
</li>

<li class="nav-item">
    <a href="/gradedc" class="nav-link {{ Request::is('gradedc') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Grade IPCR</p>
    </a>
</li>
@endrole