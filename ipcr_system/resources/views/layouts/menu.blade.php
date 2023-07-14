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

@if($isWithinRange)
{{-- Current date is within the range, check AppServiceProvider.php --}}
<li class="nav-item">
    <a href="/employee/create" class="nav-link {{ Request::is('employee/create') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Create IPCR Form</p>
    </a>
</li>
@else
{{-- Current date is outside the range, check AppServiceProvider.php --}}
<li class="nav-item" style="cursor: not-allowed">
    <a class="nav-link {{ Request::is('employee/create') ? 'active' : '' }}" onclick="notAllowed()">
        <i class="nav-icon fas fa-home"></i>
        <p>Create IPCR Form</p>
    </a>
</li>
@endif
@endrole

@role(['division_chief', 'admin'])
@role('admin')
<label style="color:white"> Division Chief </label>
@endrole
@if($isAccomplishedRatedWithinRange)
{{-- Current date is within the range, check AppServiceProvider.php --}}
<li class="nav-item">
    <a href="/approvedc" class="nav-link {{ Request::is('approvedc') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>IPCR Approvals</p>
    </a>
</li>
@else
{{-- Current date is outside the range, check AppServiceProvider.php --}}
<li class="nav-item" style="cursor: not-allowed">
    <a class="nav-link {{ Request::is('approvedc') ? 'active' : '' }}" onclick="notAllowed()">
        <i class="nav-icon fas fa-home"></i>
        <p>IPCR Approvals</p>
    </a>
</li>
@endif

@if($isAccomplishedRatedWithinRange)
<li class="nav-item">
    <a href="/gradedc" class="nav-link {{ Request::is('gradedc') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Grade IPCR</p>
    </a>
</li>
@else
<li class="nav-item" style="cursor: not-allowed">
    <a class="nav-link {{ Request::is('gradedc') ? 'active' : '' }}" onclick="notAllowed()">
        <i class="nav-icon fas fa-home"></i>
        <p>Grade IPCR</p>
    </a>
</li>
@endif
@endrole

@role(['director', 'admin'])
@role('admin')
<label style="color:white"> Director </label>
@endrole
@if($isAccomplishedRatedWithinRange)
<li class="nav-item">
    <a href="/approvedir" class="nav-link {{ Request::is('approvedir') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Graded IPCR Approvals</p>
    </a>
</li>
@else
<li class="nav-item" style="cursor: not-allowed">
    <a class="nav-link {{ Request::is('approvedir') ? 'active' : '' }}" onclick="notAllowed()">
        <i class="nav-icon fas fa-home"></i>
        <p>Graded IPCR Approvals</p>
    </a>
</li>
@endif
@endrole

<script>
    function notAllowed() {
        Swal.fire({
            title: 'No schedule for creating IPCR',
            text: "HR hasn't created a schedule yet. Wait for an email of HR.",
            icon: 'info',
            confirmButtonText: 'Okay'
        })
    }
</script>