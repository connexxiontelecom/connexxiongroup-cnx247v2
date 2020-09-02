<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Add New Emergency Contact</h5>
                <form wire:submit.prevent="addNewEducation">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" class="form-control" placeholder="Full Name" wire:model.debounce.900000ms="full_name">
                        @error('full_name')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email address</label>
                        <input type="text" class="form-control" placeholder="Email Address" wire:model.debounce.900000ms="email">
                        @error('email')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mobile No.</label>
                        <input type="text" class="form-control" placeholder="Mobile No." wire:model.debounce.900000ms="mobile_no">
                        @error('mobile_no')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Relationship</label>
                            <input class="form-control col-md-12" placeholder="Relationship" wire:model.debounce.90000ms="relationship">
                            @error('relationship')
                                <i>{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label>Notify contact via email?</label>
                            <select class="form-control col-md-6" wire:model.debounce.90000ms="notify">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('notify')
                                <i>{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button class="btn btn-mini btn-danger" wire:click="cancelEdit" type="button"> <i class="ti-close"></i> Cancel</button>
                            <button class="btn btn-mini btn-primary" type="submit"> <i class="ti-check"></i> {{$btn_text}}</button>
                            <div class="preloader3 loader-block" wire:loading wire.target="addNewEducation">
                                <div class="circ1 loader-primary"></div>
                                <div class="circ2 loader-primary"></div>
                                <div class="circ3 loader-primary"></div>
                                <div class="circ4 loader-primary"></div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Emergency Contacts</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


