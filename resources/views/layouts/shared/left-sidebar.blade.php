<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div class="user-box text-center">
            <img src="../assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="{{ url('dashboard')}}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/calendar') }}">
                        <i data-feather="calendar"></i>
                        <span> Calendar </span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarEmail" data-toggle="collapse">
                        <i data-feather="mail"></i>
                        <span> Email </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('admin/email/inbox') }}">Inbox</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/email/templates') }}">Email Templates</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarChat" data-toggle="collapse">
                        <i data-feather="message-square"></i>
                        <span> Chat </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarChat">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('admin/chats/admin') }}">Admin</a>
                            </li> 
                            <li>
                                <a href="{{ url('admin/chats/agents') }}">Agents</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/chats/members') }}">Members</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#Leads" data-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Leads</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="Leads">
                        <ul class="nav-second-level">
                            <li>
                             <a href="{{ url('admin/new-leads') }}">New Leads</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/leads') }}">All Leads</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#EMPLOYEES" data-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Employees</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="EMPLOYEES">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ url('admin/admins') }}">Admins</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/agents') }}">
                                    <span> Agents </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ url('admin/lenders') }}">
                        <i data-feather="dollar-sign"></i>
                        <span>Lenders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/documents') }}">
                        <i data-feather="folder-plus"></i>
                        <span> Documents </span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarCrm" data-toggle="collapse">
                        <i data-feather="activity"></i>
                        <span> CRM </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            @if(auth()->user()->hasPermissionTo('role-list'))
                            <li>
                                <a href="{{ url('admin/roles') }}">
                                    <span>Roles</span>
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->hasRole('admin'))
                            <li>
                                <a href="{{ url('admin/permissions') }}">
                                    <span>Permissions</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ url('admin/status') }}">
                        <i data-feather="folder-plus"></i>
                        <span> Status </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
