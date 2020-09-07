<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        @include('livewire.backend.workflow.common._workflow-slab')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="sub-title">Leave Request</div>
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#expenseReportTab" role="tab">Add New Leave Request</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#businessProcessTab" role="tab">My Leave Requests</a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="expenseReportTab" role="tabpanel">
                         <div class="card">
                            <div class="card-block">
                                @if(session()->has('success'))
                                    <div class="alert alert-success border-success" style="padding:5px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled"></i>
                                        </button>
                                        <strong>Success!</strong> {!! session('success') !!}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <form wire:submit.prevent="submitLeaveRequest">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="">Reason</label>
                                                    <input wire:model.lazy="reason" type="text" class="form-control form-control-normal" placeholder="Reason">
                                                    @error('reason')
                                                        <span class="mt-3">
                                                            <i class="text-danger">{{ $message }}</i>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class=" form-group col-md-6">
                                                    <label class="">Start Date</label>
                                                    <input wire:model.lazy="start_date" type="datetime-local" class="form-control form-control-normal" placeholder="Start Date">
                                                    @error('start_date')
                                                        <span class="mt-3">
                                                            <i class="text-danger">{{ $message }}</i>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class=" form-group col-md-6">
                                                    <label class="">Due Date</label>
                                                    <input wire:model.lazy="due_date" type="datetime-local" class="form-control form-control-normal" placeholder="Due Date">
                                                    @error('due_date')
                                                        <span class="mt-3">
                                                            <i class="text-danger">{{ $message }}</i>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="">Leave Type</label>
                                                    <select name="absence_type" class="form-control form-control-normal">
                                                        <option selected disabled>Select leave type</option>
                                                        @foreach ($leaves as $leave)
                                                            <option value="{{ $leave->id }}">{{ $leave->leave_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('absence_type')
                                                        <span class="mt-3">
                                                            <i class="text-danger">{{ $message }}</i>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                                <div class="form-group col-md-6">
                                                    <label class="">Attachment <br> <i>(Optional)</i></label>
                                                    <input type="file" class="form-control-file" name="attachment">
                                                </div>
                                                <div class=" row m-t-30 d-flex justify-content-center">
                                                    <div class="preloader3 loader-block mb-3" wire:loading wire:target="submitExpenseReport">
                                                        <div class="circ1 loader-primary"></div>
                                                        <div class="circ2 loader-primary"></div>
                                                        <div class="circ3 loader-primary"></div>
                                                        <div class="circ4 loader-primary"></div>
                                                    </div>
                                                    <div class="col-sm-10 col-md-12">
                                                        <div class="btn-group d-flex justify-content-center">
                                                            <button class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</button>
                                                            <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check mr-2"></i>Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="tab-pane" id="businessProcessTab" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                @include('backend.workflow.common._run-business-process')
                                <strong>Business Process Name: </strong> Expense Report
                                <p><strong>Business Process Description:</strong> This process sends an expense report for an approval using the Company Structure's hierarchy. When the approval reaches a designated "Final Approver", it is completed. Notifications of the report's progress are sent out at various stages</p>
                            </div>
                            <div class="card-block">
                                <button class="btn btn-out-dashed btn-inverse btn-square btn-sm waves-effect" class="nav nav-tabs md-tabs" role="tablist" data-toggle="tab" href="#businessProcessConstants" role="tab" type="button">Set Request Constants</button>
                            </div>
                            <!-- set business constants-->
                            @livewire('backend.workflow.common.business-constant')
                            <!--/ set business constants-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('leave-request-script')

@endpush
