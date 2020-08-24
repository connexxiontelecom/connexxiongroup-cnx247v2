<div class="row">
    <div class="col-md-12">
        <div class="sub-title">Purchase Request</div>
        <ul class="nav nav-tabs md-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#expenseReportTab" role="tab">Purchase Request</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#businessProcessTab" role="tab">Business Process</a>
                <div class="slide"></div>
            </li>
        </ul>      

        <div class="tab-content card-block">
            <div class="tab-pane active" id="expenseReportTab" role="tabpanel">
                
                 <div class="card">
                    <div class="card-header">
                        @include('backend.workflow.common._run-business-process')
                        <h5>Purchase Request</h5>
                            <span>Use this form to submit a purchase request</span>
                        <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
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

                    <form wire:submit.prevent="submitPurchaseRequest">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input wire:model.lazy="title" type="text" class="form-control form-control-normal" placeholder="Title">
                                @error('title')
                                    <span class="mt-3">
                                        <i class="text-danger">{{ $message }}</i>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                           <div class="col-sm-10">
                                <textarea wire:model.lazy="description" class="form-control form-control-normal" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10 col-md-4">
                                <input wire:model.lazy="amount" type="number" class="form-control form-control-normal" placeholder="Amount">
                                @error('amount')
                                    <span class="mt-3">
                                        <i class="text-danger">{{ $message }}</i>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Currency</label>
                            <div class="col-sm-10 col-md-4">
                                <select wire:model="currency" name="" id=""  class="form-control form-control-normal">
                                    <option value="1">Naira</option>
                                    <option value="1">Dollar</option>
                                    <option value="1">Euro</option>
                                </select>
                                @error('currency')
                                    <span class="mt-3">
                                        <i class="text-danger">{{ $message }}</i>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Attachment <br> <i>(Optional)</i></label>
                            <div wire:ignore class="col-sm-10 col-md-2">
                                <button class="btn btn-primary btn-sm" type="button" id="attachFileBtn">
                                    <i class="ti-cloud-up mr-2"></i>Upload attachment</button>
                                <input type="file" hidden id="attachFile">
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
                                    <button class="btn btn-primary btn-sm" wire:loading.class="bg-gray" type="submit"><i class="ti-save mr-2"></i>Submit</button>
                                </div>
                                <div class="preloader3 loader-block" wire:loading wire.target="submitPurchaseRequest">
                                    <div class="circ1 loader-primary"></div>
                                    <div class="circ2 loader-primary"></div>
                                    <div class="circ3 loader-primary"></div>
                                    <div class="circ4 loader-primary"></div>
                                </div>
                            </div>
                        </div>
                    </form>
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