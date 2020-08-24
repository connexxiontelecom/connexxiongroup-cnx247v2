<div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.crm.common._slab-menu')
                </div>
            </div>
        </div>
   </div>

   <div class="row">
    <div class="col-lg-12 col-xl-12">
        <!-- Draggable Multiple List card start -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Clients</h5>
                <div class="btn-group float-right">
                    <a href="{{route('new-client')}}" class="btn btn-primary btn-mini"> <i class="ti-plus mr-2"></i> Add New Client</a>
                    <a href="" class="btn btn-danger btn-mini"> <i class="ti-import mr-2"></i> Import Clients</a>
                </div>
            </div>
            <div class="card-block p-b-0">
                <div class="row">
                    <div class="col-md-12" id="draggableMultiple">
                        <div class="row">
                            @if (count($clients) > 0)
                                @foreach ($clients as $client)
                                    <div class="col-md-6">
                                        <div class="sortable-moves" style="">
                                            <img class="img-fluid p-absolute" src="\assets\images\avatar-2.jpg" alt="">
                                                <table class="table m-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">Full Name</th>
                                                            <td>{{$client->first_name ?? ''}} {{$client->surname ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mobile</th>
                                                            <td>{{$client->mobile_no ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td>{{$client->email ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Website</th>
                                                            <td>{{$client->website ?? ''}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            <div class="row">
                                                <div class="col-md-12 d-flex justify-content-end">
                                                    <div class="btn-group mr-3">
                                                        <a href=""><i class="ti-pencil text-warning p-2"></i></a>
                                                        <a href=""><i class="ti-trash text-danger p-2"></i></a>
                                                        <a href="{{route('view-client', $client->slug)}}"><i class="ti-eye text-primary p-2"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <h4 class="text-center">No record found.</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Draggable Multiple List card end -->
    </div>
    <!-- Container-fluid ends -->
</div>
</div>
