@extends('layouts.app')

@section('title')
Convert to Deal
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
   <form action="{{route('raise-receipt')}}" method="post">
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
                    <h6 class="m-0">{{$client->first_name ?? ''}} {{$client->surname ?? ''}}</h6>
                    <p class="m-0 m-t-10">{{$client->street_1 ?? ''}}. {{$client->city ?? ''}}, {{$client->postal_code ?? ''}}</p>
                    <p class="m-0">{{$client->mobile_no ?? ''}}</p>
                    <p><a href="mailto:{{$client->email ?? ''}}" class="__cf_email__" data-cfemail="eb8f8e8684ab939291c5888486">[ {{$client->email ?? ''}} ]</a></p>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6>Order Information :</h6>
                    <table class="table table-responsive invoice-table invoice-order table-borderless">
                        <tbody>
                            <tr>
                                <th>Issue Date :</th>
                                <td>
                                    <input type="date" name="issue_date" placeholder="Date" class="form-control">
                                    @error('issue_date')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Due Date :</th>
                                <td>
                                    <input type="date" name="due_date" class="form-control" placeholder="Due Date">
                                    @error('due_date')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Receipt Number <span>#{{$receipt_no}}</span></h6>
                    <h6 class="text-uppercase text-primary">Total Due :
                        <span class="total">0.00</span>
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                    <th class="text-danger">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="item">
                                    <td>
                                        <input type="text" name="description[]" placeholder="Description" class="form-control">
                                        @error('description')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" placeholder="Quantity" name="quantity[]" class="form-control">
                                        @error('quantity')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" placeholder="Unit Cost" class="form-control" name="unit_cost[]">
                                        @error('unit_cost')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </td>
                                    <td><input type="text" name="total[]" readonly style="width: 120px;"></td>
                                    <td>
                                        <i class="ti-trash text-danger remove-line" style="cursor: pointer;"></i>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <button class="btn btn-mini btn-primary add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                                    </td>
                                </tr>
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
                                <th>Sub Total :</th>
                                <td class="sub-total">0.00</td>
                            </tr>
                            <tr>
                                <th>Taxes (%) :</th>
                                <td>
                                    <input type="number" placeholder="Tax Rate" class="form-control" id="tax_rate">
                                </td>
                            </tr>
                            <tr>
                                <th>Inclusive of Tax?</th>
                                <td>
                                    <div class="checkbox-fade fade-in-primary float-left">
                                        <label>
                                            <input type="checkbox" value="" >
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>Yes</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Discount (%) :</th>
                                <td>
                                    <input type="number" placeholder="Discount Rate" class="form-control" id="discount_rate">
                                </td>
                            </tr>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Total :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary total">0.00</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h6>Terms And Condition :</h6>
                    <p>{!! Auth::user()->tenant->receipt_terms !!}</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <input type="hidden" name="clientId" value="{{$client->id}}">
                    <input type="hidden" name="receiptNo" value="{{$receipt_no}}">
                    <input type="hidden" name="receiptTotal" value="3400" id="receiptTotal">
                    <input type="hidden" name="receiptSubtotal" value="340" id="receiptSubtotal">
                    <input type="hidden" name="taxValue" value="340" id="taxValue">
                    <input type="hidden" name="discountValue" value="340" id="discountValue">
                    <input type="hidden" name="taxRate" value="3" id="taxRate">
                    <input type="hidden" name="discountRate" value="2" id="discountRate">
                    <button type="submit" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-control-shuffle"></i> Convert {{$client->first_name ?? ''}} to Deal</button>
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
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>

<script>
    $(document).ready(function(){
        var grand_total = 0;
        $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());

        $(document).on('click', '.add-line', function(e){
            e.preventDefault();
            const $lastRow = $('.item:last');
            const $newRow = $lastRow.clone();

            $newRow.find('input').val('');
            $newRow.find('td:nth-last-child(2) input[type=text]').text('0.00');
            $newRow.insertAfter($lastRow);

            $newRow.find('input:first').focus();
        });

        //Remove line
        $(document).on('click', '.remove-line', function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
            calculateTotals();
        });

        //calculate totals
        function calculateTotals(){
            const subTotals = $('.item').map((idx, val)=> calculateSubTotal(val)).get();
            const total = subTotals.reduce((a, v)=> a + Number(v), 0);
            grand_total = total;
            $('.sub-total').text(formatAsCurrency(grand_total));
            $('.total').text(formatAsCurrency(total));
        }

        //calculate subtotals
        function calculateSubTotal(row){
            const $row = $(row);
            const inputs = $row.find('input');
            const subtotal = inputs[1].value * inputs[2].value;
           // $row.find('td:nth-last-child(3)').text(formatAsCurrency(subtotal));
            $row.find('td:nth-last-child(2) input[type=text]').val(subtotal);
            return subtotal;
        }
        //subtotal
        function subTotal(){

        }

        //calculate tax
        $(document).on('blur', '#tax_rate', function(e){
            e.preventDefault();
            var tax_rate = $(this).val();
            var tax_value = (grand_total * tax_rate)/100;
            $('.sub-total').text(formatAsCurrency(grand_total - tax_value));
        });
        //format as currency
        function formatAsCurrency(amount){
            return "₦"+Number(amount).toFixed(2);
        }
    });
</script>
@endsection
