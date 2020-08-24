<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu" style="background: none;">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{route('dashboard')}}">
                            <span class="pcoded-mtext">Home</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('crm-dashboard')}}">
                            <span class="pcoded-mtext">CRM</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="dashboard-analytics.htm">
                            <span class="pcoded-mtext">Analytics</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{route('activity-stream')}}">
                    <span class="pcoded-micon"><i class="ti-layers-alt"></i></span>
                    <span class="pcoded-mtext">Activity Stream</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('workflow-tasks')}}">
                    <span class="pcoded-micon"><i class="ti-menu"></i></span>
                    <span class="pcoded-mtext">Workflows</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('chat-n-calls') }}">
                    <span class="pcoded-micon"><i class="ti-comment-alt"></i></span>
                    <span class="pcoded-mtext">Chat & Calls</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('cnx247-stream') }}">
                    <span class="pcoded-micon"><i class="ti-video-camera"></i></span>
                    <span class="pcoded-mtext">CNX247 Stream</span>
                </a>
            </li>

                <li class="">
                    <a href="{{ route('project-board')  }}">
                        <span class="pcoded-micon"><i class="ti-briefcase"></i></span>
                        <span class="pcoded-mtext">Projects</span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('task-board')  }}">
                        <span class="pcoded-micon"><i class="ti-check-box"></i></span>
                        <span class="pcoded-mtext">Tasks</span>
                    </a>
                </li>

            <li class="">
                <a href="{{route('workgroups')}}">
                    <span class="pcoded-micon"><i class="ti-infinite"></i></span>
                    <span class="pcoded-mtext">Workgroups</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('cnx247-drive') }}">
                    <span class="pcoded-micon"><i class="ti-harddrive"></i></span>
                    <span class="pcoded-mtext">CNX247.Drive</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-calendar"></i></span>
                    <span class="pcoded-mtext">Events</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{route('my-events')}}">
                            <span class="pcoded-mtext">My Events</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('company-calendar')}}">
                            <span class="pcoded-mtext">Company Calendar</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Human Resource</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                    <span class="pcoded-mtext">HR</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('hr-dashboard')}}">
                            <span class="pcoded-mtext">HR Dashboard</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('employees')}}">
                            <span class="pcoded-mtext">Employees</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('appreciation') }}">
                            <span class="pcoded-mtext">Appreciation</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('resignation') }}">
                            <span class="pcoded-mtext">Resignation</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="button.htm">
                            <span class="pcoded-mtext">Promotion</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('complaints')}}">
                            <span class="pcoded-mtext">Complaints</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="button.htm">
                            <span class="pcoded-mtext">Query</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('on-boarding')}}">
                            <span class="pcoded-mtext">onBoarding</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('hr-configurations')}}">
                            <span class="pcoded-mtext">HR Configurations</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-wallet"></i></span>
                    <span class="pcoded-mtext">Payroll</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('hr-dashboard')}}">
                            <span class="pcoded-mtext">Set Salary</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('employees')}}">
                            <span class="pcoded-mtext">Payslip</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-calendar"></i></span>
                    <span class="pcoded-mtext">Timesheet</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('timesheet')}}">
                            <span class="pcoded-mtext">Timesheet</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('attendance')}}">
                            <span class="pcoded-mtext">Attendance</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('leave-management') }}">
                            <span class="pcoded-mtext">Leave Management</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('leave-type') }}">
                            <span class="pcoded-mtext">Leave Types</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('leave-wallet') }}">
                            <span class="pcoded-mtext">Leave Wallet</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
                    <span class="pcoded-mtext">Performance</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('performance-indicator')}}">
                            <span class="pcoded-mtext">Indicator</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('employees')}}">
                            <span class="pcoded-mtext">Appraisal</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('employees')}}">
                            <span class="pcoded-mtext">Goal Tracking</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Marketing</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                    <span class="pcoded-mtext">CRM</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('crm-dashboard')}}">
                            <span class="pcoded-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('clients')}}">
                            <span class="pcoded-mtext">Clients</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('leads')}}">
                            <span class="pcoded-mtext">Leads</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('deals')}}">
                            <span class="pcoded-mtext">Deals</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('invoice-list')}}">
                            <span class="pcoded-mtext">Invoices</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('receipt-list')}}">
                            <span class="pcoded-mtext">Receipts</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('bulk-sms')}}">
                            <span class="pcoded-mtext">Bulk SMS</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('email-campaigns')}}">
                            <span class="pcoded-mtext">Email Campaigns</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="button.htm">
                            <span class="pcoded-mtext">Newsletter</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('admin-support')}}">
                            <span class="pcoded-mtext">Support Ticket</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('admin-support')}}">
                            <span class="pcoded-mtext">Feedback</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-users-social"></i></span>
                    <span class="pcoded-mtext">Social Media</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('facebook-timeline')}}">
                            <span class="pcoded-mtext">Facebook</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="breadcrumb.htm">
                            <span class="pcoded-mtext">Instagram</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="button.htm">
                            <span class="pcoded-mtext">Twitter</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="button.htm">
                            <span class="pcoded-mtext">LinkedIn</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="pcoded-navigatio-lavel">Accounting</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                    <span class="pcoded-mtext">Logistics</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="form-elements-component.htm">
                            <span class="pcoded-mtext">Drivers</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="form-elements-add-on.htm">
                            <span class="pcoded-mtext">Routes</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="form-elements-advance.htm">
                            <span class="pcoded-mtext">Report</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Procurement</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                    <span class="pcoded-mtext">Procurement</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="bs-basic-table.htm">
                            <span class="pcoded-mtext">Basic Table</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="bs-table-sizing.htm">
                            <span class="pcoded-mtext">Sizing Table</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="bs-table-border.htm">
                            <span class="pcoded-mtext">Border Table</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="bs-table-styling.htm">
                            <span class="pcoded-mtext">Styling Table</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">System Settings</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                    <span class="pcoded-mtext">General Settings</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('roles')}}">
                            <span class="pcoded-mtext">Roles</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('permissions')}}">
                            <span class="pcoded-mtext">Permissions</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('module-manager')}}">
                            <span class="pcoded-mtext">Module Manager</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('general-settings')}}">
                            <span class="pcoded-mtext">General Settings</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Administration</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-briefcase"></i></span>
                    <span class="pcoded-mtext">Administration</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('tenants')}}">
                            <span class="pcoded-mtext">Tenants</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('plans-n-features')}}">
                            <span class="pcoded-mtext">Plans & Features</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('constants')}}">
                            <span class="pcoded-mtext">Constants</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="bs-table-styling.htm">
                            <span class="pcoded-mtext">Terms & Conditions</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="bs-table-styling.htm">
                            <span class="pcoded-mtext">Privacy Policy</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="bs-table-styling.htm">
                            <span class="pcoded-mtext">Language</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
