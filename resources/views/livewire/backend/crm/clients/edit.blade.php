<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="btn-group mt-3 btn-group d-flex justify-content-end mr-3" >
                <a href="{{route('clients')}}" class="btn btn-primary btn-mini waves-effect waves-light">
                    <i class="ti-user"></i>All Clients
                </a>
            </div>
            <div class="card-header">
                <h5 class="sub-title">Add New Client</h5>
                <span>Let's get to it. All fields marked with <sup class="text-danger">*</sup> are compulsory.</span>
            </div>
            <div class="card-block">
                <form action="" wire:submit.prevent="saveClientChanges">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Title <sup class="text-danger">*</sup> </label>
                                <select name="" id="" class="form-control" wire:model="title">
                                    <option value="1">Mr.</option>
                                    <option value="2">Mrs.</option>
                                </select>
                                @error('title')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">First Name <sup class="text-danger">*</sup> </label>
                                <input type="text" class="form-control" placeholder="First Name" wire:model="first_name">
                                @error('first_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Surname <sup class="text-danger">*</sup> </label>
                                <input type="text" class="form-control" placeholder="Surname" wire:model="surname">
                                @error('surname')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Suffix </label>
                                <input type="text" class="form-control" placeholder="Suffix" wire:model="suffix">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="">Mobile No. <sup class="text-danger">*</sup> </label>
                            <input type="text" class="form-control" placeholder="Mobile No." wire:model="mobile_no">
                            @error('mobile_no')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="">Email Address  <sup class="text-danger">*</sup> </label>
                            <input type="text" class="form-control" placeholder="Email Address " wire:model="email">
                            @error('email')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="">Website</label>
                            <input type="text" class="form-control" placeholder="Website" wire:model="website">
                        </div>
                    </div>
                    <h4 class="sub-title mt-3">Address</h4>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="">Street 1 <sup class="text-danger">*</sup> </label>
                            <input type="street_1" class="form-control" placeholder="Street 1" wire:model="street_1">
                            @error('street_1')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="">Street 2</label>
                            <input type="text" class="form-control" placeholder="Street 2" wire:model="street_2">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="">Country  <sup class="text-danger">*</sup> </label> <br>
                            <select name="" id="" class="form-control" wire:model="country">
                                <option value="1">Nigeria</option>
                                <option value="2">India</option>
                            </select>
                            @error('country')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="">State <sup class="text-danger">*</sup> </label>
                            <select name="" id="" class="form-control" wire:model="state">
                                <option value="1">FCT</option>
                                <option value="2">Abuja</option>
                            </select>
                            @error('state')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="">City  <sup class="text-danger">*</sup> </label> <br>
                            <input type="text" placeholder="City" class="form-control" wire:model="city">
                            @error('city')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="">Postal Code <sup class="text-danger">*</sup> </label>
                            <input type="text" class="form-control" placeholder="Postal Code" wire:model="postal_code">
                            @error('postal_code')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="">Note</label>
                            <textarea class="form-control" placeholder="Leave a Note" wire:model="note"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="btn-group d-flex justify-content-center">
                                <a href="{{url()->previous() }}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i> Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
