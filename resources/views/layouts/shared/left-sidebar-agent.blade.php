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
                    <a href="{{ url('agent/calendar') }}">
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
                                <a href="{{ url('agent/email/inbox') }}">Inbox</a>
                            </li>
                            <li>
                                <a href="{{ url('agent/email/templates') }}">Email Templates</a>
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
                                <a href="{{ url('agent/chats/admin') }}">Admin</a>
                            </li> 
                            <li>
                                <a href="{{ url('agent/chats/agents') }}">Agents</a>
                            </li>
                            <li>
                                <a href="{{ url('agent/chats/members') }}">Members</a>
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
                             <a href="{{ url('agent/new-leads') }}">New Leads</a>
                            </li>
                            <li>
                                <a href="{{ url('agent/leads') }}">All Leads</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{ url('agent/documents') }}">
                        <i data-feather="folder-plus"></i>
                        <span> Documents </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
