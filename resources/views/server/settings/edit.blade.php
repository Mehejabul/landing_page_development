@extends('server.layout.layout')

@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/themes/semi-dark-layout.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_template/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline{
            height: 100px;
        }
    </style>
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success: </strong>{{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h5 class="content-header-title float-left pr-1 mb-0">Settings</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">settingss</a>
                        </li> --}}
                        <li class="breadcrumb-item active">Settings Update
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">

    {{-- Validation Error Message --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Basic Inputs start -->
    <section id="basic-input">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <form action="{{ route('settings.update',$settings->id) }}" method="post" enctype="multipart/form-data"> @csrf @method('put')
                            {{-- {{ dd($settings) }} --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="text-primary">Project Settings</h3>
                                        <fieldset class="mt-2">
                                            <h5>Page Title <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" name="page_title" value="{{ old('page_title',$settings->page_title) }}" >
                                            </div>
                                        </fieldset>
                                        <fieldset class="mt-2">
                                            <h5>Company Name <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('company_name',$settings->company_name) }}" name="company_name">
                                            </div>
                                        </fieldset>
                                        <fieldset class="mt-2">
                                            <h5>Logo</h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-image"></i></span>
                                                </div>
                                                <input type="file" class="form-control" aria-describedby="basic-Createon1" name="logo" id="logo" onchange="loadFile(event)">
                                            </div>
                                        </fieldset>
                                        @if($settings->logo != null)
                                        <img src="{{ asset('frontend/images/settings/'.$settings->logo) }}" id="logo" alt="logo" width="150px" height="150px" class="mt-2 mx-1">
                                        @endif

                                        <fieldset class="mt-2">
                                            <h5>favicon</h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-image"></i></span>
                                                </div>
                                                <input type="file" class="form-control" aria-describedby="basic-Createon1" name="favicon" id="favicon" onchange="loadFile(event)">
                                            </div>
                                        </fieldset>
                                        @if($settings->favicon != null)
                                        <img src="{{ asset('frontend/images/settings/'.$settings->favicon) }}" id="favicon" alt="favicon" width="150px" height="150px" class="mt-2 mx-1">
                                        @endif

                                        <fieldset class="mt-2">
                                            <h5>Size Guide</h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-image"></i></span>
                                                </div>
                                                <input type="file" class="form-control" aria-describedby="basic-Createon1" name="size_guide" id="size_guide" onchange="loadFile(event)">
                                            </div>
                                        </fieldset>
                                        @if($settings->size_guide != null)
                                        <img src="{{ asset('frontend/images/settings/'.$settings->size_guide) }}" id="size_guide" alt="size_guide" width="150px" height="150px" class="mt-2 mx-1">
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="text-primary">Intro Settings</h3>
                                        <fieldset class="mt-2">
                                            <h5>Title <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('title',$settings->title) }}" name="title">
                                            </div>
                                        </fieldset>
                                        {{-- <fieldset class="mt-2">
                                            <h5>Sub Title <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('sub_title',$settings->sub_title) }}" name="sub_title">
                                            </div>
                                        </fieldset> --}}
                                        {{-- <fieldset class="mt-2">
                                            <h5>Description <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('description',$settings->description) }}" name="description">
                                            </div>
                                        </fieldset> --}}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <h3 class="text-primary">Action Button</h3>
                                        <fieldset class="mt-2">
                                            <h5>Title <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('call_to_action',$settings->call_to_action) }}" name="call_to_action">
                                            </div>
                                        </fieldset>
                                        <fieldset class="mt-2">
                                            <h5>Phone <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('phone',$settings->phone) }}" name="phone">
                                            </div>
                                        </fieldset>
                                        {{-- <fieldset class="mt-2">
                                            <h5>What's App <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('whats_app',$settings->whats_app) }}" name="whats_app">
                                            </div>
                                        </fieldset> --}}
                                        {{-- <fieldset class="mt-2">
                                            <h5>Messenger <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('messenger',$settings->messenger) }}" name="messenger">
                                            </div>
                                        </fieldset> --}}
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="text-primary">Price Settings</h3>
                                        <fieldset class="mt-2">
                                            <h5>Product Old Price <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-barcode"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="150" aria-describedby="basic-Createon1" value="{{ old('old_price',$settings->old_price)}}" name="old_price">
                                            </div>
                                        </fieldset>
                                        <fieldset class="mt-2">
                                            <h5>Product Offer Price <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-barcode"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="150" aria-describedby="basic-Createon1" value="{{ old('new_price',$settings->new_price)}}" name="new_price">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <h3 class="text-primary">Order Form</h3>
                                        <fieldset class="mt-2">
                                            <h5>Title <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('order_title',$settings->order_title) }}" name="order_title">
                                            </div>
                                        </fieldset>
                                        <fieldset class="mt-2">
                                            <h5>Sub Title <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('order_sub_title',$settings->order_sub_title) }}" name="order_sub_title">
                                            </div>
                                        </fieldset>
                                        <fieldset class="mt-2">
                                            <h5>Under Sub Title <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('order_sub_sub_title',$settings->order_sub_sub_title) }}" name="order_sub_sub_title">
                                            </div>
                                        </fieldset>
                                        <fieldset class="mt-2">
                                            <h5>Order Message <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-file"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="e.g: XYZ" aria-describedby="basic-Createon1" value="{{ old('order_message',$settings->order_message) }}" name="order_message">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="text-primary">Delivery Settings</h3>
                                        <fieldset class="mt-2">
                                            <h5>Free Delivery <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-Createon1"><i class="bx bx-barcode"></i></span>
                                                </div>
                                                {{-- <input type="text" class="form-control" placeholder="150" aria-describedby="basic-Createon1" value="{{ old('old_price',$settings->old_price)}}" name="old_price"> --}}
                                                <select name="free" id="free" class="form-control">
                                                    <option value="0" @if($settings->free == 0) selected @endif>False</option>
                                                    <option value="1" @if($settings->free == 1) selected @endif>True</option>
                                                </select>
                                            </div>
                                        </fieldset>
                                        <div id="delivery_rate">

                                            <fieldset class="mt-2">
                                                <h5>Inside Dhaka<span class="text-danger">*</span></h5>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-Createon1"><i class="bx bx-barcode"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="150" aria-describedby="basic-Createon1" value="{{ old('inside_dhaka',$settings->inside_dhaka)}}" name="inside_dhaka">
                                                </div>
                                            </fieldset>
                                            <fieldset class="mt-2">
                                                <h5>Inside Dhaka<span class="text-danger">*</span></h5>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-Createon1"><i class="bx bx-barcode"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="150" aria-describedby="basic-Createon1" value="{{ old('outside_dhaka',$settings->outside_dhaka)}}" name="outside_dhaka">
                                                </div>
                                            </fieldset>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-2 btn-lg mx-1">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Inputs end -->

</div>
@endsection

@section('js')
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin_template/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/pickers/daterange/moment.min.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin_template/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/js/core/app.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/js/scripts/components.js')}}"></script>
    <script src="{{ asset('admin_template/app-assets/js/scripts/footer.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin_template/app-assets/js/scripts/pages/table-extended.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('logo');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('favicon');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('size_guide');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    {{-- <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script> --}}
    {{-- <script>
        var loadGuide = function(event) {
            var output = document.getElementById('guide');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script> --}}
@endsection
