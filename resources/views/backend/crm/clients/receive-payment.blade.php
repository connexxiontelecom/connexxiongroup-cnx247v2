@extends('layouts.app')

@section('title')
Receive Payment
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
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

<div class="container">
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.crm.common._slab-menu')
                </div>
            </div>
        </div>
   </div>
   <form action="{{route('post-payment')}}" method="post">
       @csrf
    <div class="card">
        <div class="row invoice-contact">
            <div class="col-md-8">
                <div class="invoice-box row">
                    <div class="col-sm-12">
                        <table class="table table-responsive invoice-table table-borderless">
                            <tbody>
                                <tr>
                                    <td><img src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" class="m-b-10" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="52" width="82"></td>
                                </tr>
                                <tr>
                                    <td>{{ Auth::user()->tenant->company_name ?? 'Company Name here'}}</td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->street_1 ?? 'Street here'}} {{ Auth::user()->tenant->city ?? ''}} {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}</td>
                                </tr>
                                <tr>
                                    <td><a href="mailto:{{Auth::user()->tenant->email ?? ''}}" target="_top"><span class="__cf_email__" data-cfemail="">[ {{Auth::user()->tenant->email ?? 'Email here'}} ]</span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->phone ?? 'Phone Number here'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="card-block">
            <div class="row invoive-info">
                <div class="col-md-4 col-xs-12 invoice-client-info">
                    <h6>Client Information :</h6>
                    <h6 class="m-0">{{$invoice->client->title ?? ''}} {{$invoice->client->first_name ?? ''}} {{$invoice->client->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$invoice->client->street_1 ?? ''}}. {{$invoice->client->city ?? ''}}, {{$invoice->client->postal_code ?? ''}}</p>
                    <p class="m-0">{{$invoice->client->mobile_no ?? ''}}</p>
                    <p><a href="mailto:{{$invoice->client->email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[ {{$invoice->client->email ?? ''}} ]</a></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Balance: <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($pending_invoices->sum('total') - $pending_invoices->sum('cash'),2)}}</span></h6>
                    <h6 class="text-uppercase text-primary">Amount Received :
                        <span class="balance">{{Auth::user()->tenant->currency->symbol ?? 'N'}} <span class="amount-received"></span> </span>
                    </h6>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Payment Date</label>
                                <input type="date" name="payment_date" placeholder="Date" class="form-control">
                                @error('payment_date')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select name="payment_method" class="form-control">
                                    <option value="cash">Cash</option>
                                    <option value="check">Check</option>
                                    <option value="check">Check</option>
                                </select>
                                @error('payment_method')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Reference No.</label>
                                <input type="text" placeholder="Reference No." class="form-control" name="reference_no">
                                @error('reference_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <div class="form-group">
                                <label for="">Deposit to</label>
                                <select name="deposit_to" class="form-control js-example-basic-single">
                                    @foreach ($charts as $chart)
                                        <option value="{{$chart->glcode}}">{{$chart->account_name ?? ''}} - ({{$chart->glcode}})</option>
                                    @endforeach
                                </select>
                                @error('deposit_to')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th style="width:20px;">
                                    </th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>Original Amount</th>
                                    <th>Opening Balance</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody id="products">
                                @foreach($pending_invoices as $item)
                                    <tr class="item">
                                        <td>
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="" data-amount="{{number_format($item->total ?? 0 - $item->cash ?? 0, 0, ',', '')}}" class="select-invoice">
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <p><a target="_blank" href="{{route('print-invoice', $item->slug)}}">Invoice #{{$item->invoice_no}} ({{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->created_at))}})</a></p>
                                                <input type="hidden" value="{{$item->id}}" name="invoices[]">
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->due_date))}}</p>
                                        </td>
                                        <td>
                                            <p>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($item->total,2)}}</p>
                                        </td>
                                        <td>
                                            <p>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($item->total ?? 0 - $item->cash ?? 0,2)}}</p>
                                        </td>
                                        <td><input type="number" step="0.01" class="form-control receive-amount" name="payment[]" style="width: 120px;"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
                            <tr>
                                <th>Amount Received :</th>
                                <td class="amount-receive">{{Auth::user()->tenant->currency->symbol ?? 'N'}} <span class="amount-received"></span> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h6>Terms And Condition :</h6>
                <p>{!! Auth::user()->tenant->invoice_terms !!}</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <input type="hidden" name="clientId" value="{{$invoice->client->id}}">
                    <input type="hidden" name="totalAmount" value="{{$pending_invoices->sum('total') - $pending_invoices->sum('cash')}}" id="totalAmount"/>
                    <button type="submit" id="issueReceiptBtn" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-check"></i> Submit</button>
                    <a href="{{url()->previous()}}" class="btn btn-danger btn-mini waves-effect m-b-10 btn-sm waves-light">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script>
    $(document).ready(function(){
        //$('#issueReceiptBtn').attr('disabled', 'disabled');
        var grand_total = 0;
        var invoice_total = 0;
        $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());
        $(".select-invoice").on('change', function() {
            var amount = $(this).data('amount');
            if ($(".select-invoice").is(':checked')){
                $(this).closest('tr').find('.receive-amount').val(amount);
                invoice_total += amount;
                $('.amount-received').text(parseFloat(invoice_total).toLocaleString());
            }else{
                var sub_amount = $(this).closest('tr').find('.receive-amount').val();
                console.log("Checkbox is unchecked."+sub_amount);
                cur = invoice_total - sub_amount;
                invoice_total = cur;
                $('.amount-received').text(parseFloat(invoice_total).toLocaleString());
                var sub_amount = $(this).closest('tr').find('.receive-amount').val('');
            }
        });

        //calculate totals
        function calculateTotals(){
            const subTotals = $('.item').map((idx, val)=> calculateSubTotal(val)).get();
            const total = subTotals.reduce((a, v)=> a + Number(v), 0);
            grand_total = total;
            $('.sub-total').text(formatAsCurrency(grand_total));
            $('#subTotal').val(grand_total);
            $('#totalAmount').val(grand_total);
            $('.total').text(formatAsCurrency(total));
            $('.balance').text(formatAsCurrency(total));
        }

        //calculate subtotals
        function calculateSubTotal(row){
            const $row = $(row);
            const inputs = $row.find('input');
            const subtotal = inputs[0].value * inputs[1].value;
           // $row.find('td:nth-last-child(3)').text(formatAsCurrency(subtotal));
            $row.find('td:nth-last-child(2) input[type=text]').val(subtotal);
            return subtotal;
        }
        //format as currency
        function formatAsCurrency(amount){
            return "₦"+Number(amount).toFixed(2);
        }

        $(document).on('blur', '#cash_amount', function(e){
            var cash = $(this).val();
            var total = $('#totalAmount').val() - cash;
            $('.balance').text(formatAsCurrency(total));
        });
    });
</script>
@endsection
