<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/bdo/view-assetpr')}}">
        <div class="sidebar-brand-text mx-3">Block Development Officer</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        <h6 style="color: white">Panchayati Raj Assets</h6> 
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/bdo/add-assetpr')}}" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <span>Add Assets</span>
        </a>
        <a class="nav-link collapsed" href="{{url('/bdo/view-assetpr')}}" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <span>Manage Assets</span>
        </a>

        <div class="sidebar-heading">
           <h6 style="color: white">Rural Development Department</h6> 
        </div>
        <a class="nav-link collapsed" href="{{url('/bdo/add-assetrd')}}" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <span>Add Assets</span>
        </a>
        <a class="nav-link collapsed" href="{{url('/bdo/view-assetrd')}}" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <span>Manage Assets</span>
         </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>