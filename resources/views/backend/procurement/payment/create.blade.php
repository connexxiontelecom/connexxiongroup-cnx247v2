@extends('layouts.app')

@section('title')
    New Payment
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/component.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.procurement.supplier.common._procurement-slab')
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
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
                    @if(session()->has('error'))
                        <div class="alert alert-warning border-warning" style="padding:5px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                            </button>
                            {!! session('error') !!}
                        </div>
                    @endif
                    <a href="{{route('vendor-bills')}}" class="btn mb-4 btn-primary btn-mini"><i class="ti-layout mr-2"></i>New Payment</a>
                    <form action="{{route('new-payment')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="sub-title">New Payment</h5>
                                <div class="form-group">
                                    <label for="">Bank</label>
                                    <select name="bank" id="bank" class="text-white  js-example-basic-single form-control">
                                        <option disabled selected>Select bank</option>
                                        @foreach($banks as $bank)
                                            @if($bank->bank == 1)
                                                <option value="{{$bank->glcode}}">{{$bank->account_name ?? ''}} - {{$bank->glcode ?? ''}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('bank')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Payment Amount</label>
                                    <input type="number" step="0.01" name="payment_amount" id="payment_amount" placeholder="Payment Amount" value="{{ $pending_bills->sum('bill_amount') }}" readonly class="form-control">
                                    @error('payment_amount')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="date" placeholder="Date" class="form-control" name="issue_date">
                                            @error('issue_date')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Reference #</label>
                                            <input type="text"  name="reference_no" placeholder="Reference #" class="form-control">
                                            @error('reference_no')
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
                                            <th>Bill Date</th>
                                            <th>Original Amount</th>
                                            <th>Amount Due</th>
                                            <th>Payment</th>
                                        </tr>
                                        </thead>
                                        <tbody id="products">
                                        @foreach($pending_bills as $item)
                                            <tr class="item">
                                                <td>
                                                    <div class="checkbox-fade fade-in-primary">
                                                        <label>
                                                            <input type="checkbox" value="" data-amount="{{number_format($item->bill_amount ?? 0 - $item->paid_amount ?? 0, 0, ',', '')}}" class="select-invoice">
                                                            <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <p><a target="_blank" href="javascript:void(0);">Bill #{{$item->bill_no}} ({{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->created_at))}})</a></p>
                                                        <input type="hidden" value="{{$item->id}}" name="bills[]">
                                                        <input type="hidden" name="description[]" value="Bill #{{$item->bill_no}} ({{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->created_at))}})">
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>{{date( Auth::user()->tenant->dateFormat->format ?? 'd/M/Y', strtotime($item->bill_date))}}</p>
                                                </td>
                                                <td>
                                                    <p>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($item->bill_amount,2)}}</p>
                                                </td>
                                                <td>
                                                    <p>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($item->bill_amount ?? 0 - $item->paid_amount ?? 0,2)}}</p>
                                                </td>
                                                <td><input type="number" step="0.01" class="form-control payment" name="payment[]" style="width: 120px;"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Memo</label>
                                    <textarea name="memo" id="memo" placeholder="Memo" style="resize: none;" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table invoice-total">
                                    <tbody>
                                    <tr class="text-info">
                                        <td>
                                            <hr>
                                            <h5 class="text-primary">Total :</h5>
                                        </td>
                                        <td>
                                            <hr>
                                            <h5 class="text-primary total"><span class="totalSpan">0.00</span></h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" id="grandTotal" name="grandTotal">
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"> Submit</i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
            $(".select-invoice").on('change', function() {
                var amount = $(this).data('amount');
                if ($(this).is(':checked')){
                    $(this).closest('tr').find('.payment').val(amount);
                    $('.totalSpan').text(parseFloat(invoice_total).toLocaleString());
                    setTotal();
                }else{
                    var sub_amount = $(this).closest('tr').find('.payment').val();
                    cur = invoice_total - sub_amount;
                    invoice_total = cur;
                    $('.totalSpan').text(parseFloat(invoice_total).toLocaleString());
                    var sub_amount = $(this).closest('tr').find('.payment').val('');
                    setTotal();
                }
            });
            $(document).on("change", ".payment", function() {
                setTotal();
            });
            //format as currency
            function formatAsCurrency(amount){
                return "₦"+Number(amount).toFixed(2);
            }
        });

        function setTotal(){
            var sum = 0;
            $(".payment").each(function(){
                sum += +$(this).val();
            });
            $(".totalSpan").text(sum.toLocaleString());
        }

    </script>
@endsection
