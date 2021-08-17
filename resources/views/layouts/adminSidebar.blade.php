<div class="left side-menu">

    <div class="slimscroll-menu" id="remove-scroll">

        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img width="80" height="80" src="/images/{{Auth::guard('admin')->user()->logo }}"  alt="" title={{ Auth::guard('admin')->user()->name }} class="rounded-circle">
            </div>
            <h5><a href="#">{{ Auth::guard('admin')->user()->name }}</a> </h5>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{ route('adminDashboard') }}">
                        <i class="dripicons-view-thumb"></i><span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="far fa-building"></i> <span>  Company </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('company-list') }}">List Company</a></li>
                        <li><a href="{{ route('create_company') }}">Add Company</a></li>

                        
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class=" mdi mdi-buffer"></i> <span>Template Category</span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('templateCategoryList') }}">List Categories</a></li>
                        <li><a href="{{ route('templateCategoryCreate') }}">Add Categories</a></li>
                    </ul>
                </li>
             
                 <li>
                    <a href="javascript: void(0);"><i class=" mdi mdi-bulletin-board"></i> <span>Template </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('templateList') }}">List Form</a></li>
                        <li><a href="{{ route('templateCreate') }}">Add Form</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class=" mdi mdi-developer-board"></i> <span>Template Options </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('templateoptionsList') }}">List Form</a></li>
                        <li><a href="{{ route('templateoptionsCreate') }}">Add Form</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);"><i class="dripicons-graph-pie"></i> <span>Reports </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{ route('admin.reports') }}">Overall</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
