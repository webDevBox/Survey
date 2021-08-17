<div class="left side-menu">

    <div class="slimscroll-menu" id="remove-scroll">

        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img width="80" height="80" @if(getCompany()->logo != null) src="{{ asset('images/'.getCompany()->logo) }}" @else src="{{ asset('theme/assets/images/no-image.jpg') }}" @endif alt="" title="{{ getCompany()->name }}" class="rounded-circle"> 
            </div>
            <h5><a href="#">{{ getCompany()->name }} </a> </h5>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <!--<li class="menu-title">Navigation</li>-->

                <li>
                    <a href="{{ route('companyDashboard', getCompanyId()) }}">
                        <i class="dripicons-view-thumb"></i><span> Dashboard </span>
                    </a>
                </li>
                @php
                    $moduleList = array(
                        array(
                                            'name'  => "Outlets",
                                            'removeDisable' => false,
                                            'icon' => 'dripicons-location',
                                            'links' => array(
                                                array(
                                                    'name' => 'All',
                                                    'route' => 'LocationList'
                                                ),
                                                array(
                                                    'name' => 'Add Outlet',
                                                    'route' => 'locationCreate'
                                                )
                                            )
                                        ),
                                        array(
                                            'name' => "Devices",
                                            'removeDisable' => false,
                                            'icon' => 'dripicons-device-tablet',
                                            'links' => array(
                                                array(
                                                    'name' => 'All',
                                                    'route' => 'deviceList'
                                                ),
                                                array(
                                                    'name' => 'Add Device',
                                                    'route' => 'deviceCreate'
                                                )
                                            )
                                        ),
                                      
                                        array(
                                            'name'  => "Survey",
                                            'removeDisable' => false,
                                            'icon' => 'dripicons-archive',
                                            'links' => array(
                                                array(
                                                    'name' => 'All',
                                                    'route' => 'surveyList'
                                                ),
                                                array(
                                                    'name' => 'Add Survey',
                                                    'route' => 'companySurvey'
                                                )
                                            )
                                        ),
                                        array(
                                            'name'  => "Reports",
                                            'removeDisable' => true,
                                            'icon' => 'dripicons-graph-pie',
                                            'links' => array(
                                                array(
                                                    'name' => 'Overall',
                                                    'route' => 'company.reports'
                                                ),
                                                array(
                                                    'name' => 'By Outlet',
                                                    'route' => 'company.reports.by_location'
                                                )
                                            )
                                        ),
                                        array(
                                            'name'  => "Settings",
                                            'removeDisable' => false,
                                            'icon' => 'dripicons-gear',
                                            'links' => array(
                                                array(
                                                    'name' => 'Company Settings',
                                                    'route' => 'edit-companySettings',
                                                )
                                            )
                                        )
                                    );
                @endphp

                {{-- dd($moduleList) --}}

                @foreach($moduleList as $module)
                    <li>
                        <a href="javascript: void(0);">
                            <i class="{{ $module['icon'] }}"></i>
                            <span>{{ $module['name'] }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            @foreach($module['links'] as $link)
                                @if(resolve('active'))
                                    <li><a href="{{ route($link['route'], $link['id']??'') }}">{{ $link['name'] }}</a></li>
                                @else
                                    @if(!$module['removeDisable'])
                                        <li><a href="#">{{ $link['name'] }}</a></li> 
                                    @else
                                        <li><a href="{{ route($link['route'], $link['id']??'') }}">{{ $link['name'] }}</a></li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

        </div>
        <!-- Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
