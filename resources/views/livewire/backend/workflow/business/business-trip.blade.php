<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        @include('livewire.backend.workflow.common._workflow-slab')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Business Trip</h5>
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#expenseReportTab" role="tab">Business Trip</a>
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
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-mini btn-primary float-right mb-3" data-target="#requestModal" data-toggle="modal"><i class="ti-plus mr-2"></i>Add New Business Trip</button>
                                        @if(session()->has('success'))
                                            <div class="alert alert-success border-success" style="padding:5px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont icofont-close-line-circled"></i>
                                                </button>
                                                <strong>Success!</strong> {!! session('success') !!}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap" style="margin-top: 10px;">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $serial = 1;
                                                    @endphp
                                                    @foreach ($trips as $request)
                                                        <tr>
                                                            <td>{{$serial++}}</td>
                                                            <td>
                                                                <a href="{{route('view-workflow-task', $request->post_url)}}">{{$request->post_title ?? ''}}</a></td>
                                                            <td>{!! strlen($request->post_content) > 75 ? substr($request->post_content,0,75).'...' : $request->post_content !!}</td>
                                                            <td>
                                                                @switch($request->post_status)
                                                                    @case('in-progress')
                                                                        <label for="" class="label label-warning">in-progress</label>
                                                                        @break
                                                                    @case('declined')
                                                                        <label for="" class="label label-danger">Declined</label>
                                                                        @break
                                                                    @case('approved')
                                                                        <label for="" class="label label-success">Approved</label>
                                                                        @break
                                                                    @default

                                                                @endswitch
                                                            </td>
                                                            <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($request->created_at))}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
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

@push('business-trip-script')
<script>
    $(document).ready(function(){
        var file_data = null;
       $(document).on('change', '#uploadAttachment', function(e){
           e.preventDefault();
           var extension = $('#uploadAttachment').val().split('.').pop().toLowerCase();
           if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'jpeg', 'jpg', 'png']) == -1) {
               $.notify('Ooops! File format not supported.', 'error');
               $('#uploadAttachment').val('');
           }else{
               file_data = $('#uploadAttachment').prop('files')[0];

           }
       });
        $('#requestForm').parsley().on('field:validated', function() {
           //var ok = $('.parsley-error').length === 0;

       }).on('form:submit', function() {
           var config = {
                       onUploadProgress: function(progressEvent) {
                       var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                       }
               };
               var form_data = new FormData();
               form_data.append('description',$('#description').val());
               form_data.append('title',$('#title').val());
               form_data.append('purpose',$('#purpose').val());
               form_data.append('destination',$('#destination').val());
               form_data.append('amount',$('#expense').val());
               form_data.append('start_date',$('#start_date').val());
               form_data.append('end_date',$('#end_date').val());
               form_data.append('attachment',file_data);
               form_data.append('post_type','business-trip');
               $('#requestBtn').text('Processing...');
                axios.post('/business-trip',form_data, config)
               .then(response=>{
                   $.notify(response.data.message, 'success');
                   $('#requestBtn').text('Done');
                   setTimeout(function () {
                       $("#requestBtn").text("Save");
                       window.location.reload();
                   }, 2000);

               })
               .catch(error=>{
                   $.notify('Error! Something went wrong.', 'error');
                   //$('#op-failed').css('display', 'block');
                   $('#requestBtn').text('Ooops...Could not submit request.');
                   setTimeout(function () {
                       $("#requestBtn").text("Save");
                   }, 2000);
               });
               return false;
       });
       });
   </script>
@endpush
