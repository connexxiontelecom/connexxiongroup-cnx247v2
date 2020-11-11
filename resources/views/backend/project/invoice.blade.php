@extends('layouts.app')

@section('title')
    Project Invoice
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
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
   <form action="{{route('store-project-invoice')}}" method="post">
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
                <div class="col-md-4 col-sm-6">
                    <h6 class="m-b-20">Ref. No. <span>{{$project->id}}</span></h6>
                    <input type="hidden" name="ref_no" value="{{$project->id}}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table  invoice-detail-table">
                            <thead>
                                <tr class="thead-default">
                                    <th>Description</th>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th class="text-danger">Action</th>
                                </tr>
                            </thead>
                            <tbody id="products">
                                <tr class="item">
                                    <td>
                                        <div class="form-group">
                                            <textarea name="description[]" placeholder="Description" value="{{old('description[]')}}" style="resize: none;" class="select-product form-control"></textarea>
                                            @error('description')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select name="accounts[]" class="form-control js-example-basic-single" id="accounts">
                                                <option disabled selected>Select account</option>
                                                @foreach ($accounts as $item)
                                                    <option value="{{$item->glcode}}">{{$item->account_name ?? ''}} - ({{$item->glcode}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" placeholder="Amount" step="0.01" name="amount[]" class="form-control">
                                        @error('amount')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                        @enderror
                                    </td>
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
                    <button class="btn btn-mini btn-primary add-line" type="button"> <i class="ti-plus mr-2"></i> Add Line</button>
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
                                    <h5 class="text-primary"> <span>{{Auth::user()->tenant->currency->symbol ?? 'N'}}</span> <span class="total">0.00</span></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-12 invoice-btn-group text-center">
                    <button type="submit" class="btn btn-primary btn-mini btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20"> <i class="ti-control-shuffle"></i> Submit Invoice</button>
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
<script>
    $(document).ready(function(){
       /*  $(".select-product").select2({
            placeholder: "Add"
        }); */
        var grand_total = 0;
        $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());

        $(document).on('click', '.add-line', function(e){
            e.preventDefault();
            var new_selection = $('.item').first().clone();
            $('#products').append(new_selection);

/*             $(".select-product").select2({
                placeholder: "Select product or service"
            });
            $(".select-product").last().next().next().remove(); */
        });

        //Remove line
        $(document).on('click', '.remove-line', function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
            calculateTotals();
        });

        $('.aggregate').on('change', function(e){
            e.preventDefault();
            setTotal();
        });

    function setTotal(){
        var sum = 0;
        $(".payment").each(function(){
            sum += +$(this).val();
        });
            $(".total").text(sum);
    }
});
</script>
@endsection
