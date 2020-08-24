@extends('layouts.app')

@section('title')
    Bulk SMS
@endsection

@section('extra-styles')

<style>
/* The heart of the matter */

.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('livewire.backend.crm.common._slab-menu')
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h4 class="sub-title">Bulk SMS</h4>
                <div class="btn-group d-flex justify-content-end">
                    <button data-toggle="modal" data-target="#sendSMS" class="btn btn-mini btn-primary" type="button"><i class="ti-plus"></i> Compose Message</button>
                    <a href="{{route('bulk-sms')}}" class="btn btn-mini btn-danger"><i class="ti-email"></i> Messages</a>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-30px;">
    <div class="card-block email-card">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="e-inbox" role="tabpanel">
                        <div class="mail-body">
                            <div class="mail-body-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            @if (count($sms) > 0)
                                                <tr>
                                                    <td colspan="5">
                                                        <div class="check-star">
                                                            <div class="checkbox-fade fade-in-primary checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="selectAllMessages">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-verification-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @foreach ($sms as $message)
                                                    <tr class="unread">
                                                        <td>
                                                            <div class="check-star">
                                                                <div class="checkbox-fade fade-in-primary checkbox">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$message->id}}">
                                                                        <span class="cr"><i class="cr-icon icofont icofont-verification-check txt-primary"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><a href="email-read.htm" class="email-name">{{$message->mobile_no}}</a></td>
                                                        <td>{{ strlen($message->message) > 81 ? substr($message->message, 0,81).'...' : $message->message ?? ''}}</td>
                                                        <td class="email-attch">
                                                            @if ($message->status == 0)
                                                            <label for="" class="label label-warning text-white">In-progress</label>
                                                            @else
                                                                <label for="" class="label label-success">Sent</label>
                                                            @endif
                                                        </td>
                                                        <td class="email-time">{{date('d F, Y', strtotime($message->created_at))}} @ <small>{{date('h:i a', strtotime($message->created_at))}}</small></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <p class="text-center">No records found</p>
                                            @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <!-- Right-side section end -->
        </div>
    </div>
    <!-- Email-card end -->
</div>
@endsection

@section('dialog-section')
<div class="modal fade" id="sendSMS" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase">Compose Message</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Mobile Number</label>
                        <input type="text" placeholder="Mobile Number" id="mobileNumbers" class="form-control">
                        <small class="text-success" style="cursor: pointer;" data-toggle="modal" data-target="#importContacts">Import Contact(s)</small>
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea style="resize: none;" name="" rows="5" id="message" class="form-control" placeholder="Compose message here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="sendSMSBtn"> <i class="ti-email text-white mr-2"></i> Send SMS</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="importContacts" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase">Import Contacts</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>S/No.</th>
                                        <th style="width:42px;">
                                            <input type="checkbox" class="form-control" id="selectAll">
                                        </th>
                                        <th>Client</th>
                                        <th>Mobile No.</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td><input type="checkbox" class="form-control" value="{{$client->mobile_no ?? ''}}"></td>
                                                <td>{{$client->first_name ?? ''}} {{$client->surname ?? ''}}</td>
                                                <td>{{$client->mobile_no ?? ''}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="ti-close"></i> Close</button>
                <button type="button" class="btn btn-primary waves-effect btn-mini" id="selectedContactsBtn"><i class="ti-check"></i> Done</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script>
    $(document).ready(function(){
        var contacts = [];
        $("#selectAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        
        //Selected contacts
        $(document).on('click', '#selectedContactsBtn', function(e){
            $("input:checked").each(function () {
                contacts.push( $(this).val());
                $('#mobileNumbers').val(contacts);
            });
            $('input:checkbox').removeAttr('checked');
        });
        //Send message
        $(document).on('click', '#sendSMSBtn', function(e){
            e.preventDefault();
            var mobileNumbers = $('#mobileNumbers').val();
            var message = $('#message').val();
            $('#sendSMSBtn').text("Processing...");
            axios.post('/crm/bulk-sms/send', {mobileNumbers:mobileNumbers, message:message})
            .then(response=>{
                $('#sendSMSBtn').text("Sent!");
                $('#sendSMSBtn').removeClass("btn-danger");
                $('#sendSMSBtn').addClass("btn-success");
                $('#sendSMS').modal("hide");
            })
            .catch(error=>{
                $('#sendSMSBtn').text("Error");
                $('#sendSMSBtn').removeClass("btn-primary");
                $('#sendSMSBtn').addClass("btn-danger");
            });
        });
    })
</script>
@endsection
