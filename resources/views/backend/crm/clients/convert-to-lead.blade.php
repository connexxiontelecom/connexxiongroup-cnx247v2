@extends('layouts.app')

@section('title')
Convert to Lead
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
   <form action="{{route('raise-an-invoice')}}" method="post">
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
                    <h6 class="m-0">{{$client->title ?? ''}} {{$client->first_name ?? ''}} {{$client->surname ?? ''}}</h6>
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
                    <h6 class="m-b-20">Invoice Number <span>#INV{{$invoice_no}}</span></h6>
                    <h6 class="text-uppercase text-primary">Balance :
                        <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}</span> <span class="balance"></span>
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
                            <tbody id="products">
                                <tr class="item">
                                    <td>
                                        <div class="form-group">
                                            <select name="description[]" value="{{old('description[]')}}" class="js-example-basic-single select-product">
                                                <option selected disabled>Select service/product</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}" data-price="{{$product->price ?? 0}}">{{$product->product_name ?? ''}}</option>
                                                @endforeach
                                            </select>
                                            @error('description')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" placeholder="Quantity" name="quantity[]" class="form-control">
                                        @error('quantity')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" placeholder="Unit Cost" step="0.01" class="form-control" name="unit_cost[]">
                                        @error('unit_cost')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </td>
                                    <td><input type="text" class="form-control aggregate" name="total[]" readonly style="width: 120px;"></td>
                                    <td>
                                        <i class="ti-trash text-danger remove-line" style="cursor: pointer;"></i>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <button class="btn btn-mini btn-primary add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive invoice-table invoice-total">
                        <tbody>
                            <tr>
                                <th>Sub Total :</th>
                                <td>{{Auth::user()->tenant->currency->symbol ?? 'N'}} <span  class="sub-total">0.00</span> </td>
                            </tr>
                            <tr>
                                <th>Taxes (%) :</th>
                                <td>
                                    <input type="text" placeholder="Tax Rate" step="0.01" class="form-control" id="tax_rate" name="tax_rate">
                                </td>
                            </tr>
                            <tr>
                                <th>Tax amount</th>
                                <td>
                                    <input type="text" readonly placeholder="Tax Amount" class="form-control" id="tax_amount" name="tax_amount">
                                </td>
                            </tr>
                            <tr>
                                <th>Discount (%) :</th>
                                <td>
                                    <input type="text" placeholder="Discount Rate" class="form-control" id="discount_rate" name="discount_rate">
                                </td>
                            </tr>
                            <tr>
                                <th>Discounted amount :</th>
                                <td>
                                    <input type="text" readonly placeholder="Discount Amount" class="form-control" id="discounted_amount" name="discounted_amount">
                                </td>
                            </tr>
                            <tr>
                                <th>Cash :</th>
                                <td>
                                    <input type="text" placeholder="Cash Amount" class="form-control" id="cash_amount" name="cash_amount">
                                </td>
                            </tr>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Total :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary"> <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}</span> <span class="total">0.00</span></h5>
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="float-left pl-3">
                            <tr>
                                <th class="text-left"> <strong>Account Name:</strong> </th>
                                <td>{{Auth::user()->tenantBankDetails->account_name ?? ''}}</td>
                            </tr>
                            <tr>
                                <th class="text-left"><strong>Account Number:</strong> </th>
                                <td>{{Auth::user()->tenantBankDetails->account_number ?? ''}}</td>
                            </tr>
                            <tr>
                                <th class="text-left"><strong>Bank:</strong> </th>
                                <td>{{Auth::user()->tenantBankDetails->bank_name ?? ''}}</td>
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
                    <input type="hidden" name="clientId" value="{{$client->id}}">
                    <input type="hidden" name="invoiceNo" value="{{$invoice_no}}">

                    <input type="hidden" name="subTotal" id="subTotal"/>
                    <input type="hidden" name="totalAmount" id="totalAmount"/>

                    <input type="hidden" name="taxValue"  id="taxValue">
                    <input type="hidden" name="discountValue"  id="discountValue">

                    <input type="hidden" name="hiddenTaxRate"  id="hiddenTaxRate">
                    <input type="hidden" name="hiddenDiscountRate"  id="hiddenDiscountRate">
                    <button type="submit" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-control-shuffle"></i> Convert {{$client->first_name ?? ''}} to Lead</button>
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
        $(".select-product").select2({
            placeholder: "Select product/service"
        });
        var grand_total = 0;
        $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());

        $(document).on('click', '.add-line', function(e){
            e.preventDefault();
            var new_selection = $('.item').first().clone();
            $('#products').append(new_selection);

            $(".select-product").select2({
                placeholder: "Select product or service"
            });
            $(".select-product").last().next().next().remove();
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
            $('.sub-total').text(grand_total.toLocaleString());
            $('#subTotal').val(total);
            $('#totalAmount').val(grand_total);
            $('.total').text(total.toLocaleString());
            $('.balance').text(total);
        }

        //calculate subtotals
        function calculateSubTotal(row){
            const $row = $(row);
            const inputs = $row.find('input');
            const subtotal = inputs[0].value * inputs[1].value;
            $row.find('td:nth-last-child(2) input[type=text]').val(subtotal);
            return subtotal;
        }

        $('.aggregate').on('change', function(e){
            e.preventDefault();
            setTotal();
        });
        $('#tax_rate, #discount_rate, #cash_amount').on('change', function(e){
            e.preventDefault();
            var total = $('#totalAmount').val();
            var tax = 0;
            var discount = 0;
            var cash = 0;
            tax = (total*$('#tax_rate').val()/100);
            discount = (total*$('#discount_rate').val()/100);
            cash = $('#cash_amount').val();
            $('#tax_amount').val(tax);
            $('#discounted_amount').val(discount);
            $('.sub-total').text($('#subTotal').val());
            $('.total').text(((total-discount+tax)-cash));
            $('#totalAmount').val(((total-discount+tax)-cash));
            $('.balance').text(((total-discount+tax)-cash));

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
            $(".total").text(sum);
    }
</script>
@endsection
