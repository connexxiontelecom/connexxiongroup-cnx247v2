@extends('layouts.app')

@section('title')
    CNX247.Drive
@endsection

@section('extra-styles')
{{-- <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css"> --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-hard-disk bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">Space</span>
                    <h4>49/50GB</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>Get more space
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-ui-folder bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Folders</span>
                    <h4>{{number_format(count($directories))}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-pink f-16 feather icon-calendar m-r-10"></i>All time
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-ui-file bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Files</span>
                    <h4>{{number_format(count($files))}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-green f-16 feather icon-tag m-r-10"></i>All time
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-ui-lock bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Private</span>
                    <h4>+562</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-yellow f-16 feather icon-watch m-r-10"></i>Just update
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group float-right">
                        <button type="button" class=" btn btn-warning btn-mini waves-effect waves-light" data-toggle="modal" data-target="#new-folder"><i class="ti-plus mr-2"></i>New Folder</button>
                        <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" data-toggle="modal" data-target="#new-file"><i class="ti-plus mr-2"></i>New File</button>
                    </div>
                    <h5>Folders & Files</h5>
                </div>
                <div class="card-block">
                    @if (session()->has('error'))
                        <div class="alert alert-danger background-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="card-block tooltip-icon button-list">
                        @foreach ($directories as $directory)
                            <button type="button" style="cursor: pointer;" class="btn  btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title=".icofont-home">
                                <img src="/assets/uploads/formats/folder.png" alt="">
                            </button>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <ul>
                        <div class="card-block tooltip-icon button-list">
                            @foreach ($directories as $directory)
                                <button type="button" style="cursor: pointer;" class="btn  btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title=".icofont-home">
                                    <img src="/assets/uploads/formats/folder.png" alt="">
                                </button>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('dialog-section')
<div class="modal fade" id="new-folder" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">New Folder</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="">Folder Name</label>
                                <input type="text" id="folder_name" class="form-control form-control-normal" placeholder="Workgroup Name">
                                @error('folder_name')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="">Password <i>(Optional)</i> </label>
                                <input type="password" id="password" class="form-control form-control-normal" placeholder="Workgroup Name">
                                @error('password')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Close</button>
                <button type="button" id="createFolder" class="btn btn-primary waves-effect waves-light btn-sm">Create Folder</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="new-file" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('upload-file')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">Upload File</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label class="">Choose File</label>
                            <div class="col-sm-8">
                                <input type="file" name="attachment"  class="form-control-file">
                                @error('attachment')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-mini">Upload File</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script>
    $(document).ready(function(){
        //create folder button
        $(document).on('click', '#createFolder', function(e){
            e.preventDefault();
            if($('#folder_name').val() != ""){
                axios.post('/drive/make-directory', {folder_name:$('#folder_name').val()})
                .then(response=>{
                    console.log(response.data.message);
                });
            }else{
                return;
            }
        });
    });
</script>
@endsection
