<div class="container">
    <form >
    <div class="row mb-3">
        <div class="col-md-12">
            <div id="dialer-screen">
                {{ $phone_number }}
            </div>
        </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button wire:click.prevent="addNumber('1')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">1</button>
            </div>
            <div class="col-md-4">
                <button wire:click="addNumber('2')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">2</button>
            </div>
            <div class="col-md-4">
                <button wire:click="addNumber('3')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">3</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button wire:click="addNumber('4')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">4</button>
            </div>
            <div class="col-md-4">
                <button wire:click="addNumber('5')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">5</button>
            </div>
            <div class="col-md-4">
                <button wire:click="addNumber('6')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">6</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button wire:click="addNumber('7')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">7</button>
            </div>
            <div class="col-md-4">
                <button wire:click="addNumber('8')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">8</button>
            </div>
            <div class="col-md-4">
                <button wire:click="addNumber('9')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">9</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button wire:click="addNumber('*')" disabled type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">*</button>
            </div>
            <div class="col-md-4">
                <button wire:click="addNumber('0')" type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">0</button>
            </div>
            <div class="col-md-4">
                <button wire:click="addNumber('#')" disabled type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">#</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button wire:click="addNumber('+')" disabled type="button" class="btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">+</button>
            </div>
            <div class="col-md-4">
                <button wire:click="makeCall" type="button" class="btn btn-primary btn-icon">{{$call_button}}</button>
            </div>
            <div class="col-md-4">
                <button wire:click="delete" type="button" class="btn btn-danger btn-icon"><i class="zmdi zmdi-long-arrow-left"></i></button>
            </div>
    </div>
    @if(session()->has('stage'))
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="label-main">
                    <label class="label label-inverse-info-border">{{ $call_progress }}</label>
                </div>
            </div>
        </div>
    @endif
</form>
</div>