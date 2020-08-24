<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->

                <form class="md-float-material form-material" wire:submit.prevent="setNewPassword">
                    <div class="text-center">
                        <img src="/assets/images/logo.png" alt="logo.png" width="120" height="75">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-left sub-title">Set New Password</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if(session()->has('error'))
                                        <div class="alert alert-warning border-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled"></i>
                                            </button>
                                        
                                           {!! session('error') !!}  

                                        </div>
                                    @endif
                                    @if(session()->has('success'))
                                        <div class="alert alert-success border-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled"></i>
                                            </button>
                                        
                                           {!! session('success') !!}  

                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group form-primary">
                                <label for="">New Password</label>
                                <input wire:model.debounce.500ms="password" type="password"  class="form-control"  placeholder="New Password">
                                @error('password')
                                    <span class="mt-5">
                                        <i class="text-danger">{{ $message }}</i>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-primary">
                                <label for="">Re-type Password</label>
                                <input wire:model.debounce.500ms="password_confirmation" type="password"  class="form-control"  placeholder="Re-type Password">
                                                           </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn-sm btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Set New Password</button>
                                </div>
                                <div class="preloader3 loader-block" wire:loading wire.target="setNewPassword">
                                    <div class="circ1 loader-primary"></div>
                                    <div class="circ2 loader-primary"></div>
                                    <div class="circ3 loader-primary"></div>
                                    <div class="circ4 loader-primary"></div>
                                </div>
                            </div>
                            <p class="f-w-600 text-right">Back to <a href="{{route('signin')}}">Sign in</a></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                                    <p class="text-inverse text-left"><a href="{{route('home')}}"><b class="f-w-600">Back to Homepage</b></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>