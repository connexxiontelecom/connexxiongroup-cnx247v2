<div class="row">
    <div class="col-md-12">
        <div class="sub-title">Leave Request</div>
        <ul class="nav nav-tabs md-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#expenseReportTab" role="tab">Leave Request</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#businessProcessTab" role="tab">Leave Request</a>
                <div class="slide"></div>
            </li>
        </ul>

        <div class="tab-content card-block">
            <div class="tab-pane active" id="expenseReportTab" role="tabpanel">

                 <div class="card">
                    <div class="card-header">
                        @include('backend.workflow.common._run-business-process')
                        <h5>Leave Request</h5>
                            <span>Use this form to submit a leave request</span>
                            <div class="btn-group">
                                <label for="" class="label label-danger">Current Leave Balance:</label>
                                <label for="" class="label label-info">{{ number_format($balance) }}</label>
                            </div>
                        <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                        @if (session()->has('error'))
                            <div class="alert alert-danger border-danger background-danger mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                {!! session()->get('error') !!}
                            </div>
                        @endif

                    </div>
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
                            <div class="col-md-5 ">
                                <form wire:submit.prevent="submitLeaveRequest">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="">Reason</label>
                                            <input wire:model.lazy="reason" type="text" class="form-control form-control-normal" placeholder="Reason">
                                            @error('reason')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class=" form-group">
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
                                        <div class=" form-group ">
                                            <label class="">Due Date</label>
                                            <input wire:model.lazy="due_date" type="datetime-local" class="form-control form-control-normal" placeholder="Due Date">
                                            @error('due_date')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="form-group">
                                            <label class="">Leave Type</label>
                                            <select wire:model.lazy="absence_type" class="form-control form-control-normal">
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
                                    <div class=" row">
                                        <div wire:ignore class="form-group">
                                            <label class="">Attachment <br> <i>(Optional)</i></label>
                                            <input type="file" class="form-control-file">
                                        </div>
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
                                                <button class="btn btn-default btn-sm"><i class="ti-na text-danger mr-2"></i>Cancel</button>
                                                <button class="btn btn-primary btn-sm" wire:loading.class="bg-gray" {{ $balance  <= 0 ? 'disabled' : '' }} type="submit"><i class="ti-save mr-2"></i>Submit</button>
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

@push('upload-script')
    <script>
/*         $(document).ready(function(){
            $(document).on('click', '#attachFileBtn', function(e){
                e.preventDefault();
                $('#attachFile').click();
                $('#attachFile').change(function(event){
                    var extension = $('#attachFile').val().split('.').pop().toLowerCase();
                    if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx']) == -1) {

                        alert("Kindly upload file in this format: ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx']");
                    }else{
                        file_data = $('#attachFile').prop('files')[0];
                        console.log("File name: "+file_data);
                        @this.set('attachment', file_data);

                    }
                });
            });
        }); */
    </script>
@endpush
