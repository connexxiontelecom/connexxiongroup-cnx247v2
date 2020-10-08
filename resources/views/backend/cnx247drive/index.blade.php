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
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                        @break
                                    @case('pdf')
                                    <div class="col-md-1 mb-4">
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                            <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break

                                    @case('csv')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/csv.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('xls')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('xlsx')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('doc')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('doc')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('docx')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('jpeg')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/jpeg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('jpg')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    @break
                                    @case('png')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/png.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('gif')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/gif.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('ppt')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('txt')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/txt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('css')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/css.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('mp3')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/mp3.png" height="64" width="64" alt=""><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('mp4')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/mp4.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('svg')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/svg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('xml')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xml.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('zip')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/zip.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <h5 class="sub-title">Shared Files</h5>
                    <p class="text-muted">These are files shared with you by someone else.</p>
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
                            @foreach ($sharedFiles as $share)
                                @foreach ($share->originalFile as $file)
                                    @switch(pathinfo($file->filename, PATHINFO_EXTENSION))
                                        @case('pptx')
                                        <div class="col-md-1">
                                            <a href="button" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                                <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>

                                            @break
                                        @case('pdf')
                                        <div class="col-md-1 mb-4">
                                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                                <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break

                                        @case('csv')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/csv.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('xls')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('xlsx')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('doc')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('doc')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('docx')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('jpeg')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/jpeg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('jpg')
                                            <div class="col-md-1">
                                                <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                    <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                        <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                        @case('png')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/png.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('gif')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/gif.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('ppt')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('txt')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/txt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('css')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/css.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('mp3')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/mp3.png" height="64" width="64" alt=""><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('mp4')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/mp4.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('svg')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/svg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('xml')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/xml.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('zip')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/zip.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a class="dropdown-item waves-light waves-effect downloadFile" data-directory="{{$file->filename}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-download text-success mr-2"></i> Download</a>
                                                    <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @endswitch
                                @endforeach
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
    <style>
        .context-menu{
            width: 200px;
            height: auto;
            box-shadow: 0 0 20px 0 #ccc;
            position: absolute;
            display: none;
            z-index: 999;
            background: #fff;
        }
        .context-menu ul{
            list-style: none;
            padding: 5px 0px 5px 0px;
        }
        .context-menu ul li:not(.separator){
            padding: 10px 5px;
            border-left: 2px solid transparent;
            cursor: pointer;
        }
        .context-menu ul li:hover{
            background: #eee;
            border-left: 4px solid #A8CF45;
        }
        .separator{
            height: 1px;
            background: #ddd;
            margin: 2px 0px;
        }
    </style>

<div class="modal fade" id="shareFileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title"> <i class="ti-share text-white mr-2"></i> Share File</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Share <strong id="fileToShare"></strong> with...</p>
                            <hr>
                            <div class="form-group">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="32" name="all_employee" id="all_employee">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>All employees</span>
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                @foreach ($employees as $employee)
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="{{$employee->id}}" name="employee" id="employee[]">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Cancel</button>
                    <button type="button" id="shareFileBtn" class="btn btn-primary waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i>Share File</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteFileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title"> <i class="ti-trash text-white mr-2"></i> Are you sure?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>This action cannot be undone. Are you sure you want to delete <strong id="fileToDelete"></strong> ?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Cancel</button>
                    <button type="button" id="deleteFileBtn" class="btn btn-danger waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i>Delete File</button>
                </div>
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
        var all_employee = null;
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

        $(document).on('click', '.downloadFile', function(e){
            e.preventDefault();
            var directory = $(this).data('directory');
            var extension = directory.substr(directory.indexOf(".") + 1);
            var id = $(this).data('unique');
            axios.post("/cnx247-drive/download",{
                attachment:directory,
                extension:extension,
                id:id
            })
            .then(response=>{

            })
            .catch(error=>{

            });
        });
        $(document).on('change','#all_employee', function(e){
            e.preventDefault();
            if ($("#all_employee").is(':checked'))
                all_employee = 32; //all employees
            else {
                all_employee = null;
            }
        });
        $(document).on('click', '.shareFile', function(e){
            var name = $(this).data('file');
            var id = $(this).data('unique');
            $('#fileToShare').text(name);
            $(document).on('click', '#shareFileBtn', function(event){
                var employees = []
                $("input:checkbox[name=employee]:checked").each(
                    function(){employees.push($(this).val());
                    });
                axios.post('/cnx247-drive/share',{
                    employees:employees,
                    id:id,
                    all:all_employee
                })
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#shareFileModal').modal('hide');
                })
                .catch(error=>{
                    $.notify(error.response.data.error, 'error');
                });
            });
        });
        $(document).on('click', '.deleteFile', function(e){
            var name = $(this).data('file');
            var directory = $(this).data('directory');
            var id = $(this).data('unique');
            $('#fileToDelete').text(name);
            $(document).on('click', '#deleteFileBtn', function(event){
                axios.post('/cnx247-drive/delete',{
                    id:id,
                    directory:directory
                })
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#deleteFileModal').modal('hide');
                    location.reload();
                })
                .catch(error=>{
                    $.notify(error.response.data.error, 'error');
                });
            });
        });
    });
</script>
@endsection
