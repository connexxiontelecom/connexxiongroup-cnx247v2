<nav class="navbar navbar-light bg-faded m-b-30 p-10">
    <div class="row">
        <div class="d-inline-block">
            <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('task-board')}}"><i class="icofont icofont-tasks"></i>  Workflow Tasks</a>
            <a href="{{ route('task-gantt-chart') }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-spreadsheet"></i> My Requests</a>
            <a href="{{ route('task-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-calendar"></i>  Statistics</a>
        </div>
    </div>
    <div class="nav-item nav-grid">
        <div class="dropdown-primary dropdown open mt-2 float-right">
            <button class="btn btn-primary btn-mini waves-effect waves-light dropdown-toggle waves-effect waves-light" type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-time mr-2"></i>Run Business Process</button>
            <div class="dropdown-menu text-uppercase" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a class="dropdown-item waves-light waves-effect" href="http://127.0.0.1:8000/expense-report"><i class="ti-notepad mr-2 text-danger"></i> Expense Report </a>
                <a class="dropdown-item waves-light waves-effect" href="http://127.0.0.1:8000/purchase-request"><i class="ti-wallet mr-2 text-danger"></i> Purchase Request </a>
                <a class="dropdown-item waves-light waves-effect" href="http://127.0.0.1:8000/general-request"><i class="ti-clipboard mr-2 text-danger"></i> General Request </a>
                <a class="dropdown-item waves-light waves-effect" href="http://127.0.0.1:8000/business-trip"><i class="ti-notepad mr-2 text-danger"></i> Business Trip </a>
                <a class="dropdown-item waves-light waves-effect" href="http://127.0.0.1:8000/leave-request"><i class="ti-calendar mr-2 text-danger"></i> Leave Approval </a>
                <a class="dropdown-item waves-light waves-effect" href="http://127.0.0.1:8000/announcement"><i class="ti-pin-alt mr-2 text-danger"></i> Internal Memo </a>
                <a class="dropdown-item waves-light waves-effect" href="http://127.0.0.1:8000/announcement"><i class="ti-volume mr-2 text-danger"></i> Announcement </a>
            </div>
        </div>
    </div>
</nav>
