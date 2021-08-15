@extends('admin.layout.base')

@section('title', 'Carousel')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/dropzone/min/dropzone.min.css') }}"/>
<style>
.img-holder {position: relative;} 
.img-holder 
.link {position: absolute; top: 10px;right: 20px; cursor: pointer;}
.attach-link{position: absolute; top: 30px;right: 20px; cursor: pointer;}</style>
@endsection

@section('content')
{{-- The Master doesn't talk, he acts. --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Image Slider</h1>
</div>
@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
@if (Session::has('errors'))
<span class="text-danger">{{ Session::get('errors') }}</span>
@endif
{{-- In work, do what you enjoy. --}}
<div class="row user">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="tile p-0">
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#pc" data-toggle="tab">Slider PC</a></li>
                        <li class="nav-item"><a class="nav-link" href="#mobile" data-toggle="tab">Slider Mobile/Tab</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            {{-- This is pc --}}
            <div class="tab-pane active" id="pc">
                <div class="card shadow-sm" style="min-height: 300px;">
                    <div class="card-body">
                        <div class="tile">
                            <h3 class="tile-title">Upload Image</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="button" id="uploadButton">
                                            <i class="fa fa-fw fa-lg fa-upload"></i>Upload Images
                                        </button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="row mt-2">
                                        @foreach($carouselPc as $slider)
                                        <div class="col-md-3 col-6 img-holder">
                                            <img class="img-fluid my-2 contenedor-img" src="{{ asset('storage/'.$slider->images) }}">
                                            <a href="{{ route('admin.slider-image-delete', $slider->id) }}" class="link text-danger"><i class="fas fa-times-circle fa-1x"></i></a>
                                            <a class="attach-link text-danger" id="{{ $slider->id }}" data-toggle="modal" data-target=".bd-example-modal-lg" data-backdrop="static" data-keyboard="false" onClick="reply_click(this.id)"><i class="fas fa-link"></i></a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- This is Mobile --}}
            <div class="tab-pane fade" id="mobile">
                This is mobile
            </div>
        </div>
    </div>
</div>
{{-- Attach link with image --}}
<div class="modal bd-example-modal-lg" id="IDModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row justify-content-center p-4">
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            <div class="tile">
                                @livewire('admin.url-generatior')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('admin/dropzone/min/dropzone.min.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;

    $( document ).ready(function() {

        let myDropzone = new Dropzone("#dropzone", {
            paramName: "image",
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            maxFilesize: 1,
            parallelUploads: 12,
            uploadMultiple: false,
            url: "{{ route('admin.slider-image-upload') }}",
            autoProcessQueue: false,
        });
        myDropzone.on("queuecomplete", function (file) {
            window.location.reload();
            $(".general").removeClass("active");
            $(".image").addClass("active");
            showNotification('Completed', 'All product images uploaded', 'success', 'fa-check');
        });
        $('#uploadButton').click(function(){
            if (myDropzone.files.length === 0) {
                showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
            } else {
                myDropzone.processQueue();
            }
        });
    });
</script>
<script type="text/javascript">
    function reply_click(clicked_id)
    {
        document.getElementById('carousel-id').value = clicked_id;
    }
  </script>
@endsection