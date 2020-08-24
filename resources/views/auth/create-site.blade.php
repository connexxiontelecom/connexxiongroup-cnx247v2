@extends('layouts.frontend-layout')

@section('title')
    Create Site
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
    <section class="bg-home d-flex align-items-center mt-100 mt-60 mb-5">
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-4">
                    <div class="section-title">
                        <h4 class="title mb-4">Chosen plan <br><span class="text-primary">{{$chosen_plan->planName->name}}</span></h4>
                        <p class="text-muted">{{$chosen_plan->description}}</p>
                        <p class="text-muted">
                            This plan gives you access to the following features of the application:
                        </p>
                        <ul class="list-unstyled text-muted">
                            @if (count($modules) > 0)
                                @foreach ($modules as $module)
                                    <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>{{$module->module_name}}</li>
                                @endforeach
                            @else
                                <li class="mb-0 text-danger">There're no modules for this plan</li>
                            @endif
                        </ul>
                        <p>
                            Price: <span class="badge badge-pill badge-outline-secondary mr-2 mt-2" style="cursor: pointer;">{{$chosen_plan->currency->symbol}}{{number_format($chosen_plan->price,2)}}</span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-8">
                    <div class="card login_page shadow rounded border-0">
                        <div class="card-body">
                            <h4 class="card-title text-center">Signup</h4>
                            <form class="login-form mt-4" method="post" action="{{route('register-site')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Choose site address <span class="text-danger">*</span></label>
                                            <i data-feather="globe" class="fea icon-sm icons"></i>
                                            <input type="text" name="site_address" id="site_address" value="{{old('site_address')}}" class="form-control pl-5" placeholder="Site address">
                                            <small>Your team will use it to sign in to {{config('app.name')}}. At least 3 characters</small>
                                            @error('site_address')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>First name <span class="text-danger">*</span></label>
                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="First Name" value="{{old('first_name')}}" name="first_name" id="first_name">
                                            @error('first_name')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>You work email <span class="text-danger">*</span></label>
                                            <i data-feather="mail" class="fea icon-sm icons"></i>
                                            <input type="text" class="form-control pl-5" placeholder="Your work email" name="email" id="email" value="{{old('email')}}">
                                            @error('email')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <i data-feather="key" class="fea icon-sm icons"></i>
                                            <input type="password" name="password"  id="password" class="form-control pl-5" placeholder="Password">
                                            @error('password')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Industry <span class="text-danger">*</span></label>
                                            <select name="industry" id="industry" class="form-control">
                                                @foreach ($industries as $industry)
                                                    <option value="{{$industry->id}}">{{$industry->industry}}</option>
                                                @endforeach
                                            </select>
                                            @error('industry')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Company Name <span class="text-danger">*</span></label>
                                            <input type="text" name="company_name" value="{{old('company_name')}}" id="company_name" class="form-control pl-5" placeholder="Company Name">
                                            @error('company_name')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Your Role <span class="text-danger">*</span></label>
                                            <select name="role" id="role" value="{{old('role')}}" class="form-control">
                                                <option value="1">CEO</option>
                                                <option value="2">Manager</option>
                                                <option value="3">Investor</option>
                                            </select>
                                            @error('role')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Use case <span class="text-danger">*</span></label>
                                            <select id="use_case" class="form-control" name="use_case" value="{{old('use_case')}}">
                                                <option value="1">Business</option>
                                                <option value="2">Marketing</option>
                                                <option value="3">Project</option>
                                            </select>
                                            @error('use_case')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <small class="ml-3 mr-2 d-flex">What do you plan to use {{config('app.name')}} mainly for?</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Team size <span class="text-danger">*</span></label>
                                            <input type="number" id="team_size" name="team_size" value="{{old('team_size')}}" placeholder="Team size (ex. 50)" class="form-control pl-5">
                                            @error('team_size')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group position-relative">
                                            <label>Phone number <span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" placeholder="Phone number" value="{{old('phone')}}" class="form-control pl-5">
                                            @error('phone')
                                                <span class="mt-3">
                                                    <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" checked name="terms" class="custom-control-input">
                                                <label class="custom-control-label" for="customCheck1">I Accept <a href="#" class="text-primary">Terms And Condition</a></label>
                                            </div>
                                            @error('terms')
                                            <span class="mt-3">
                                                <i class="text-danger">{{ $message }}</i>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="orderID" value="{{rand(100,999)}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="amount" value="{{ ($chosen_plan->price * 100)}}">
                                        <input type="hidden" name="currency" value="NGN">
                                        <input type="hidden" id="duration" value="{{$chosen_plan->duration}}">
                                        <input type="hidden" id="plan" value="{{$chosen_plan->plan_id}}">
                                        <input type="hidden" name="metadata[]" id="metadata">
                                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                        <button class="btn btn-primary btn-block" type="submit" id="proceedToPay">Proceed to make Payment</button>
                                    </div>
                                    <div class="mx-auto">
                                        <p class="mb-0 mt-3"><small class="text-dark mr-2">Already have an account ?</small> <a href="{{route('signin')}}" class="text-dark font-weight-bold">Sign in</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('extra-scripts')
<script>
    $(document).ready(function(){
       $(document).on('click', '#proceedToPay', function(){

            var metadata = $('#metadata').val();
            var site_address = $('#site_address').val();
            var phone = $('#phone').val();
            var use_case = $('#use_case').val();
            var role = $('#role').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var team_size = $('#team_size').val();
            var company_name = $('#company_name').val();
            var industry = $('#industry').val();
            var duration = $('#duration').val();
            var plan = $('#plan').val();
            var first_name = $('#first_name').val();
            var fid = {'company_name':company_name, 'industry':industry,
                        'site_address':site_address, 'phone': phone,
                        'use_case':use_case, 'role':role,
                        'email':email, 'password':password,
                        'team_size':team_size,
                        'duration':duration,
                        'plan':plan,
                        'first_name':first_name
                    };
            $('#metadata').val(JSON.stringify(fid));
       });
    });
</script>
@endsection
