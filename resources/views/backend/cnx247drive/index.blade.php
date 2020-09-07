@extends('layouts.app')

@section('title')
    CNX247.Drive
@endsection

@section('extra-styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-hard-disk bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">Space</span>
                    <h4><sup class="text-danger">{{number_format(ceil($size/1000))}}MB</sup>/50GB</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>Used storage
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-ui-folder bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Shared</span>
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
                    <h4>{{number_format(count($myFiles))}}</h4>
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
                    <h4>{{count($myFiles) - 0}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-yellow f-16 ti-user m-r-10"></i>Restricted
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
                        {{-- <button type="button" class=" btn btn-warning btn-mini waves-effect waves-light" data-toggle="modal" data-target="#new-folder"><i class="ti-plus mr-2"></i>New Folder</button> --}}
                        <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" data-toggle="modal" data-target="#new-file"><i class="ti-plus mr-2"></i>New File</button>
                    </div>
                </div>
                <div class="card-block">
                    <h5 class="sub-title">My Files</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="card-block " id="fileDirectory">
                        <div class="row">
                            @foreach ($myFiles as $file)
                                @switch(pathinfo($file->filename, PATHINFO_EXTENSION))
                                    @case('pptx')
                                    <div class="col-md-1">
                                        <a href="button" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                            <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>

                                        @break
                                    @case('pdf')
                                    <div class="col-md-1">
                                        <a href="button" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                            <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break

                                    @case('csv')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/csv.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('xls')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('xlsx')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('doc')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('doc')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('docx')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('jpeg')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/jpeg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('jpg')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                        </div>
                                    @break
                                    @case('png')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/png.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('gif')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/gif.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('ppt')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('txt')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/txt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('css')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/css.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('mp3')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/mp3.png" height="64" width="64" alt=""><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('mp4')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/mp4.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('svg')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/svg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('xml')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xml.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                    @case('zip')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/zip.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                    </div>
                                    @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                </div>
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
                <div class="modal-header bg-primary">
                    <h6 class="modal-title"><i class="ti-upload mr-2"></i> Upload File</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form id="fileUploadForm">
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label class="">File Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="filename"  id="filename" class="form-control" placeholder="File name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">Choose File</label>
                            <div class="col-sm-8">
                                <input type="file" name="uploadAttachment"  id="uploadAttachment" class="form-control-file">
                                @error('uploadAttachment')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="btn-group d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i>Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-mini" id="uploadAttachmentBtn"><i class="ti-check mr-2"></i>Upload File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script>
    $(document).ready(function(){
        var file_data = null;
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

        $(document).on('change', '#uploadAttachment', function(e){
            e.preventDefault();
            var extension = $('#uploadAttachment').val().split('.').pop().toLowerCase();
            var formats = ['csv', 'xls', 'xlsx', 'pdf',
                        'doc', 'docx', 'jpeg', 'jpg',
                        'png', 'gif', 'ppt', 'pptx','zip',
                        'txt', 'css','mp3', 'mp4', 'svg','xml'
                    ];
            if ($.inArray(extension, formats) == -1) {
                $.notify('Error! Please upload a valid file', 'error');
            }else{
               file_data = $('#uploadAttachment').prop('files')[0];
            }

        });
        $(document).on('submit','#fileUploadForm', function(e){
            e.preventDefault();
            var config = {
                onUploadProgress: function(progressEvent) {
                var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };

               var form_data = new FormData();
                form_data.append('attachment',file_data);
                form_data.append('filename',$('#filename').val());
                 axios.post('/upload-attachment', form_data, config)
                .then(response=>{
                    $('#new-file').modal('hide');
                    $("#fileDirectory").load(location.href + " #fileDirectory");
                    $.notify(response.message, "success");
                })
                .catch(error=>{
                    $.notify(error.response.data.error, "error");
                });


        });
    });
</script>
@endsection
